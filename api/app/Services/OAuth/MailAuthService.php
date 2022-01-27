<?php

namespace App\Services\OAuth;

use App\Contracts\OAuthContract;
use App\Exceptions\LoginInvalidException;
use Illuminate\Support\Str;

class MailAuthService implements OAuthContract
{
    public function auth($data): array
    {
        if (!$token = auth()->attempt($data)) {
            throw new LoginInvalidException();
        }

        return $this->getAuthenticatedUser($token);
    }

    public function create(array $data): array
    {
        $data['password'] = bcrypt($data['password'] ?? Str::random(10));
        return $data;
    }

    public function getAuthenticatedUser(string $token): array
    {
        $user = auth()->user();
        return [
            'user' => [
                'id' => (int)$user->id,
                'first_name' => (string)$user->first_name,
                'last_name' => (string)$user->last_name,
                'email' => (string)$user->email,
                'created_at' => (string)$user->created_at,
            ],
            'access_token' => $token,
            'token_type'   => 'Bearer'
        ];
    }
}
