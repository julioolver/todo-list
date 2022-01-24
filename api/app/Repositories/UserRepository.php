<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function update(int $id, array $data): bool
    {
        return $this->model->whereId($id)->update($data);
    }

    public function findById(int $id): User
    {
        return $this->model->find($id);
    }
}
