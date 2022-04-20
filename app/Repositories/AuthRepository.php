<?php

namespace App\Repositories;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

class AuthRepository extends BaseRepository
{
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function create($request)
    {
        User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email
        ]);
    }
}
