<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Auth;
use Lcobucci\JWT\Parser;
use App\Services\UserService;
use Exception;

class AuthController extends Controller
{
    protected $successStatus = 200;
    protected $unauthorized = 401;
    protected $notFound = 404;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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

    public function register(LoginRequest $request)
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
}
