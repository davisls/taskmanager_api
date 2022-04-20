<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\AuthInterface;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        try {
            $token = $this->authService->login($request);
            if($token)
                return response()->json([
                    'success' => true,
                    'message' => 'user loged succesfully',
                    'token' => $token
                ]);

            return response()->json([
                'success' => false,
                'message' => 'credentials dont match'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $this->authService->register($request);

            return response()->json([
                'success' => true,
                'message' => 'user registered succesfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function logout()
    {
        try {
            $this->authService->logout();

            return response()->json([
                'success' => true,
                'message' => 'user has logout succesfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }
}
