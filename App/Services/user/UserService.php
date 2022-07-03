<?php

namespace App\Services\user;

use App\Models\user\UserDTO;
use App\Repositories\user\UserRepository;
use Exception;

class UserService implements UserServiceInterface
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function create($userInputs)
    {
        // TODO: Implement create() method.
    }

    public function login($userInputs)
    {
        if (!isset($userInputs['username']) || !isset($userInputs['password'])){
            http_response_code(403);
            echo json_encode([
                'message' => 'Empty Username or Password!'
            ],JSON_PRETTY_PRINT);
        }

        if (!$this->userRepository->getUserByUsername($userInputs['username'])){
            http_response_code(403);
            echo json_encode([
                'message' => 'Such Username not Exist!'
            ],JSON_PRETTY_PRINT);
        }

        try {
            $user = new UserDTO();
            $user->setUsername($userInputs['username']);
            $user->setPassword($userInputs['password']);
            $this->userRepository->login($user);

            http_response_code(201);
            echo json_encode([
                'message' => 'Successfully Registered!'
            ],JSON_PRETTY_PRINT);

        } catch (Exception $e) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Wrong Username or Password ' . $e->getMessage()
            ],JSON_PRETTY_PRINT);
        }
    }

    public function update($userInputs)
    {
        // TODO: Implement update() method.
    }

    public function delete($userInputs)
    {
        // TODO: Implement delete() method.
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

    public function createUserDTO($userInputs)
    {
        // TODO: Implement createUserDTO() method.
    }
}