<?php

namespace App\Services;

use App\Exceptions\UserHasBeenTakenException;
use App\Jobs\WelcomeUserMail;
use App\Models\User;
use App\Services\OAuth\MailAuthService;
use Exception;
use Illuminate\Support\Str;

class AuthService
{
    public function authenticate(array $request, string $provider)
    {
        $data = $request;

        $service = $this->getService($provider);

        $user = $service->auth($data);
        return $user;
    }

    public function register(array $data, string $provider): object
    {
        $userExists = $this->findUser($data['email']);

        if ($userExists) {
            throw new UserHasBeenTakenException();
        }

        $provider = $this->getService($provider);
        $userData = $provider->create($data);
        $user = User::create($userData);

        WelcomeUserMail::dispatch($user);

        return $user;
    }

    public function findUser(string $email): bool
    {
        $user = User::where('email', $email)->exists();
        return $user;
    }

    public function getService(string $provider)
    {
        // return match($provider) {
        //     'email' => new MailAuthService()
        // };

        switch ($provider) {
            case 'email':
                return new MailAuthService();
                break;

            default:
                return new MailAuthService();
                break;
        }
    }

    // private function findOrCreate(string $provider, array $providerUser)
    // {
    //     $payload = [
    //         $provider . '_username' => $providerUser['login'] ?? $providerUser['data'][0]['login'],
    //         "name" => $providerUser['name'] ?? $providerUser['data'][0]['display_name'],
    //         $provider . "_id" => $providerUser['id'] ?? $providerUser['data'][0]['id'],
    //         "email" => $providerUser['email'] ?? $providerUser['data'][0]['email'],
    //         'image' => $providerUser['avatar_url'] ?? $providerUser['data'][0]['profile_image_url']
    //     ];


    //     if ($user = User::where($provider . "_id", $payload[$provider . '_id'])->first()) {
    //         return $user;
    //     }

    //     if ($user = User::where('email', $payload['email'])->first()) {
    //         $user->update([
    //             $provider . "_id" => $payload[$provider . '_id'],
    //             $provider . "_username" => $payload[$provider . '_username']
    //         ]);

    //         return $user;
    //     }
    //     $imagePath = 'avatars/' . Uuid::uuid4()->toString() . '.png';
    //     Storage::put('public/' . $imagePath, file_get_contents($payload['image']));
    //     $payload['image_path'] = $imagePath;

    //     return User::create($payload);
    // }
}
