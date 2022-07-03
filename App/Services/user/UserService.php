<?php

namespace App\Services\user;

use App\Models\user\UserDTO;
use App\Repositories\user\UserRepository;
use App\Services\encryption\EncryptionService;
use AuthValidator;
use Exception;

class UserService implements UserServiceInterface
{
    private UserRepository $userRepository;
    private EncryptionService $encryptionService;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->encryptionService = new EncryptionService();
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
        $password = $userInputs['password'];

        $userFromDb = $this->userRepository->getUserByUsername($userInputs['username']);

        if (null === $userFromDb){
            http_response_code(403);
            echo json_encode([
                'message' => 'Wrong Username or Password!'
            ],JSON_PRETTY_PRINT);
            return;
        }

        if (false === $this->encryptionService->verify($password,$userFromDb->getPassword())){

            http_response_code(403);
            echo json_encode([
                'message' => 'Wrong Username or Password!'
            ],JSON_PRETTY_PRINT);
            return;
        }

        try {
            $token = AuthValidator::createToken($userFromDb);

            http_response_code(200);
            echo json_encode($token,JSON_PRETTY_PRINT);

        } catch (Exception $e) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! ' . $e->getMessage()
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