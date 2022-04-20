<?php

namespace App\Interfaces;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

interface AuthInterface
{
    public function login(LoginRequest $request);
    public function register(RegisterRequest $request);
    public function logout();
}
