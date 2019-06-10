<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\ImageService;
use Exception;
use DB;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfile;
use Auth;
Use App\Jobs\SendMailActiveUser;

class UserController extends Controller
{
    protected $userService;
    protected $imageService;

    public function __construct(
        UserService $userService,
        ImageService $imageService
    ) {
        $this->userService = $userService;
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $this->authorize('viewList', User::class);
            $params = $request->only([
                'size',
                'sort_field',
                'sort_type',
                'type_user',
                'keyword',
            ]);
            
            $listRoles = $this->userService->getListRoleStrs();
            $users = $this->userService->search($params);
            $statuses = $this->userService->getListStatuses();

            return view('admin.user.index', compact('users', 'listRoles', 'statuses'));
        } catch (Exception $e) {
            report($e);
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $statuses = $this->userService->getListStatuses();
            $listRoles = $this->userService->getListRoles();
            unset($statuses[0]);
            unset($listRoles[0]);

            return view('admin.user.create', compact('statuses', 'listRoles'));
        } catch (Exception $e) {
            report($e);
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        try {
            $data = $request->only([
                'first_name',
                'last_name',
                'email',
                'status',
                'role',
            ]);

            $data['password'] =  str_random(8);
            DB::beginTransaction();
            $user = $this->userService->createUser($data);
            DB::commit();
            $this->dispatch(new SendMailActiveUser($user, $data['password']));
            
            return redirect()->route('user.show', ['id' => $user->id])->with('messageSuccess', trans('message.create_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return back()->with('messageError', trans('message.create_fail'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $statuses = $this->userService->getListStatuses();
            $listRoles = $this->userService->getListRoles();
            unset($statuses[0]);
            unset($listRoles[0]);
            $user = $this->userService->getUser($id);

            return view('admin.user.show', compact('user', 'statuses', 'listRoles'));
        } catch (Exception $e) {
            report($e);
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->only([
                'first_name',
                'last_name',
                'status',
                'role',
            ]);
            DB::beginTransaction();
            $user = $this->userService->updateUser($id, $data);
            DB::commit();
            
            return redirect()->route('user.show', ['id' => $user->id])->with('messageSuccess', trans('message.update_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return back()->with('messageError', trans('message.update_fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }

        try {
            $params = $request->only([
                'keyword',
                'filter_id',
            ]);
            
            $result = true;

            $users = $this->userService->search($params);
            // $users = $users->where('social_accounts_count', 0);
        } catch (Exception $e) {
            $result = false;
            $users = [];
            report($e);
        }

        return response()->json([
            'success' => $result,
            'users' => $users,
        ]);
    }

    public function updateMultyStatus(Request $request)
    {
        try {
            $this->authorize('updateMulty', User::Class);
            $data = json_decode($request->data);
            DB::beginTransaction();

            foreach ($data as $item) {
                $this->userService->updateMultyStatus($item->id, $item->status);
            }
            
            DB::commit();

            return back()->with('messageSuccess', trans('message.change_status_success'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return back()->with('messageError', trans('message.change_status_fail'));
        }
    }

    public function deleteMulty(Request $request)
    {
        try {
            $this->authorize('deleteMulty', User::Class);
            $dataId = json_decode($request->data);
            DB::beginTransaction();
            foreach($dataId as $userId) {
                $user = $this->userService->getUser($userId)->userCompanies()->delete();
            }
            $this->userService->deleteMulty($dataId);
            
            DB::commit();

            return back()->with('messageSuccess', trans('message.delete_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return back()->with('messageError', trans('message.delete_fail'));
        }
    }

    public function profile() {
        try {
            $user = $this->userService->getUser(Auth::user()->id);

            return view('admin.user.profile', compact('user'));
        } catch (Exception $e) {
            report($e);
            abort(404);
        }
    }

    public function updateProfile(UpdateProfile $request) {
        try {
            $data = $request->only([
                'first_name',
                'last_name',
                'password',
                'avatar',
            ]);
            DB::beginTransaction();
            $user = $this->userService->updateUser(Auth::user()->id, $data);

            if ($request->hasFile('avatar')) {
                $this->imageService->deleteImageExcept($user);
                $this->imageService->createImage($user, $request->avatar);
            }
            DB::commit();
            
            return redirect()->route('admin.profile')->with('messageSuccess', trans('message.update_successfully'));
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            report($e);

            return back()->with('messageError', trans('message.update_fail'));
        }
    }
}
