<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(object $user): string
    {
        //dd($user->location);
        $user = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make($user->password),
            'location' => $user->location,
        ]);

        $token = $this->createToken($user);

        return $token;
    }

    public function getUser(string $email): User
    {
        $user = User::where('email', $email)->firstOrFail();

        $user->token = $this->createToken($user);

        return $user;
    }

    public function validateUser(string $email, string $password): bool
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        return $user || !Hash::check($password, $user->password);
    }

    protected function createToken(User $user): string
    {
        $token = $user->createToken('auth_token')->plainTextToken;

        return $token;
    }
}
