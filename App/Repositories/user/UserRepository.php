<?php

namespace App\Repositories\user;

use App\Models\user\UserDTO;

class UserRepository implements UserRepositoryInterface
{

    private $db;

    public function insert(UserDTO $userDTO)
    {
        // TODO: Implement insert() method.
    }

    public function update(UserDTO $userDTO)
    {
        // TODO: Implement update() method.
    }

    public function getUserById($user_id)
    {
        // TODO: Implement getUserById() method.
    }

    public function getUserByUsername($username)
    {
        // TODO: Implement getUserByUsername() method.
    }

    public function getUserByEmail($email)
    {
        // TODO: Implement getUserByEmail() method.
    }

    public function delete(UserDTO $userDTO)
    {
        // TODO: Implement delete() method.
    }
}