<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;
use Auth;
use Lcobucci\JWT\Parser;
use App\Services\UserService;
use Exception;
use App\Services\ImageService;

class AuthController extends BaseController
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

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('Password Token')->accessToken;

                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'access_token' => $token,
                        'user' => $user,
                    ],
                ], $this->successStatus);
            } else{
                return $this->unauthorized();
            }
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->only([
                'email',
                'password',
            ]);

            $user = $this->userService->createUser($data);

            Auth::login($user);
            $token = $user->createToken('Password Token')->accessToken;

            return response()->json([
                'status' => 'success',
                'data' => [
                    'access_token' => $token,
                    'user' => $user,
                ],
            ], $this->successStatus);
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }

    public function getUser(Request $request) 
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => $this->notFound,
                    'messaage' => 'Not found'
                ], $this->successStatus);
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'user' => $user,
                ],
            ], $this->successStatus);
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }

    public function unauthorized()
    {
        return response()->json([
            'status' => 'error',
            'messaage' => 'Unauthorized'
        ], $this->unauthorized);
    }

    public function logout(Request $request)
    {
        try {
            $value = $request->bearerToken();

            if ($value) {
                $id = (new Parser())->parse($value)->getHeader('jti');
                $token = $request->user()->tokens->find($id);
                $token->revoke();
            }

            return response()->json([
                'status' => 'success',
                'messaage' => 'You are successfully logged out'
            ], 200);
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            $user = Auth::user();
            $data = $request->only([
                'first_name',
                'last_name',
                'password',
            ]);
            $user->update($data);
            
            if ($request->avatar) {
                $avatar = $request->avatar;  // your base64 encoded
                $avatar = str_replace('data:image/png;base64,', '', $avatar);
                $avatar = str_replace(' ', '+', $avatar);
                $this->imageService->createImage($user, [base64_decode($avatar)]);
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'user' => $user,
                ],
            ], $this->successStatus);
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }
}
