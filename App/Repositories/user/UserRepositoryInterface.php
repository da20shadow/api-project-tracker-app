<?php

namespace App\Repositories\user;

use App\Models\user\UserDTO;

interface UserRepositoryInterface
{
    public function insert(UserDTO $userDTO);
    public function update(UserDTO $userDTO);
    public function getUserById($user_id);
    public function getUserByUsername($username);
    public function getUserByEmail($email);
    public function delete(UserDTO $userDTO);
}