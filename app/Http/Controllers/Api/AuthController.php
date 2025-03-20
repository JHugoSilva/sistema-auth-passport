<?php

namespace App\Http\Controllers\Api;

use App\Services\AuthService;
use App\Http\Requests\AuthRegister;
use App\Http\Requests\AuthLogin;
use App\Http\Controllers\Controller;
use App\Helper\ApiResponse;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function register(AuthRegister $request){
        try {
            $response = $this->authService->authRegister($request);

            if ($response) {
                return ApiResponse::success(self::SUCCESS_STATUS, self::SUCCESS_MESSAGE, $response, self::CREATED);
            } else {
                return ApiResponse::error(self::ERROR_STATUS, self::FAILED_MESSAGE, self::VALIDATION_ERROR);
            }
        } catch (Exception $e) {
            Log::error("Exception Register Error:".$e->getMessage());
            return ApiResponse::success(self::ERROR_STATUS, self::EXCEPTION_MESSAGE, '', self::VALIDATION_ERROR);
        }
    }

    public function login(AuthLogin $request){
        try {
            $loginResponse =  $this->authService->authLogin($request);
            if ($loginResponse) {
                return ApiResponse::success(self::SUCCESS_STATUS, self::SUCCESS_MESSAGE, $loginResponse, self::SUCCESS);
            } else {
                return ApiResponse::error(self::ERROR_STATUS, self::FAILED_MESSAGE, self::VALIDATION_ERROR);
            }
        } catch (Exception $e) {
            Log::error("Exception Login Error:".$e->getMessage());
            return ApiResponse::success(self::ERROR_STATUS, self::EXCEPTION_MESSAGE, '', self::VALIDATION_ERROR);
        }
    }

    public function profile(){
        try {
            $profileResponse =  $this->authService->userProfile();
            if ($profileResponse) {
                return ApiResponse::success(self::SUCCESS_STATUS, self::SUCCESS_MESSAGE, $profileResponse, self::SUCCESS);
            } else {
                return ApiResponse::error(self::ERROR_STATUS, self::NOT_FOUND_MESSAGE, self::VALIDATION_NOT_FOUND);
            }
        } catch (Exception $e) {
            Log::error("Exception Profile Error:".$e->getMessage());
            return ApiResponse::success(self::ERROR_STATUS, self::EXCEPTION_MESSAGE, '', self::VALIDATION_ERROR);
        }
    }

    public function logout(){
        try {
            $logoutResponse =  $this->authService->userLogout();
            if ($logoutResponse) {
                return ApiResponse::success(self::SUCCESS, self::USER_LOGGED_OUT, $logoutResponse, self::SUCCESS);
            } else {
                return ApiResponse::error(self::SUCCESS, self::NOT_FOUND_MESSAGE, '', self::VALIDATION_NOT_FOUND);
            }
        } catch (Exception $e) {
            Log::error("Exception Profile Error:".$e->getMessage());
            return ApiResponse::success(self::ERROR_STATUS, self::EXCEPTION_MESSAGE, '', self::VALIDATION_ERROR);
        }
    }
}
