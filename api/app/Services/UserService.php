<?php

namespace App\Services;

use App\Exceptions\UserHasBeenTakenException;
use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update(int $id, array $data)
    {
        $user = $this->findById($id);

        if (!empty($data['email'] && $this->emailExists($data['email'], $user))) {
            throw new UserHasBeenTakenException();
        }
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $this->repository->update($id, $data);
    }

    public function emailExists(string $email, User $user): bool
    {
        return User::where('email', $email)->where('email', '!=', $user->email)->exists();
    }

    public function findById(int $id): User
    {
        return User::find($id);
    }
}
