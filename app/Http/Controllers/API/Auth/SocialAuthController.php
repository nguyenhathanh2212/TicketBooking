<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\Services\SocialAccountService;
use App\Http\Controllers\API\BaseController;
use Exception;

class SocialAuthController extends BaseController
{
    protected $socialAccountService;

    public function __construct(SocialAccountService $socialAccountService)
    {
        $this->socialAccountService = $socialAccountService;
    }

    public function redirect($social)
    {
        return Socialite::driver($social)->stateless()->redirect();
    }

    public function callback($social)
    {
        try {
            $user = $this->socialAccountService->findOrCreate(Socialite::driver($social)->stateless()->user(), $social);
            auth()->login($user);

            $token = $user->createToken('Password Token')->accessToken;
            $data = [
                'status' => 'success',
                'data' => [
                    'access_token' => $token,
                    'user' => $user,
                ],
            ];

            return view('app', compact('data'));
        } catch (Exception $e) {
            report($e);
        }
    }

    public function handleProviderCallback(Request $request)
    {
        try {
            $userSocial = Socialite::driver($request->provider)->userFromToken($request->access_token);
            $user = $this->socialAccountService->findOrCreate($userSocial, $request->provider);
            auth()->login($user);
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
}
