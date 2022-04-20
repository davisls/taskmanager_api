<?php

namespace App\Services;

use App\Interfaces\UserInterface;
use App\Repositories\UserRepository;

class UserService implements UserInterface
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getMe()
    {
        return auth()->user();
    }
}
