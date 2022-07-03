<?php

namespace App\Services\user;

interface UserServiceInterface
{
    public function create($userInputs);
    public function update($userInputs);
    public function delete($userInputs);
    public function getUserById($userInputs);
    public function createUserDTO($userInputs);
}