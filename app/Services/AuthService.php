<?php

namespace App\Services;

use App\Interfaces\AuthInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AuthRepository;

class AuthService implements AuthInterface
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $request)
    {
        if(Auth::attempt($request->all()))
        {
            return $request->user()->createToken('token')->plainTextToken;
        }

        return false;
    }

    public function register(RegisterRequest $request)
    {
        $this->authRepository->create($request);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
    }
}
