<?php

namespace App\Services;

use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $authRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(AuthRepository $authRepository)
    {
       $this->authRepository = $authRepository;
    }

    public function authRegister($request){
        $request = $request->all();
        $request['password'] = Hash::make($request['password']);
        return $this->authRepository->registerUser($request);
    }

    public function authLogin($request){
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return false;
        }

        $authUser = Auth::user();
        $token = $authUser->createToken('token')->accessToken;

        return [
            'email' => $authUser->email,
            'token' => $token
        ];
    }

    public function userProfile(){
        return Auth::user();
    }

    public function userLogout(){
        $authUser = Auth::user();
        if ($authUser) {
            $authUser->token()->revoke();
            return true;
        } else {
            return false;
        }

    }
}
