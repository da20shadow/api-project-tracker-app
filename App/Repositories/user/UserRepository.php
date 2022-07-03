<?php

namespace App\Repositories\user;

use App\Models\user\UserDTO;
use Database\DBConnector;
use Database\PDODatabase;
use PDOException;

class UserRepository implements UserRepositoryInterface
{
    private PDODatabase $db;

    public function __construct()
    {
        $this->db = DBConnector::create();
    }

    /** ------------------ CREATE ------------------- */
    public function insert(UserDTO $userDTO)
    {
        // TODO: Implement insert() method.
    }

    /** ------------------UPDATE ------------------- */
    public function update(UserDTO $userDTO)
    {
        // TODO: Implement update() method.
    }

    /** ------------------ GET ------------------ */
    public function login(UserDTO $userDTO)
    {
        try {
            return $this->db->query("
                SELECT id,
                       username,
                       email,
                       password,
                       role,
                       first_name AS firstName,
                       last_name AS lastName
                FROM users
                WHERE username = :username AND password = :password
            ")->execute(array(
                ':username' => $userDTO->getUsername(),
                ':password' => $userDTO->getPassword()
            ))->fetch(UserDTO::class)
                ->current();
        }catch (PDOException $e){
            return 'Error! ' . $e->getMessage();
        }
    }

    public function getUserById($user_id)
    {
        try {
            return $this->db->query("
                SELECT id,
                       username,
                       email,
                       password,
                       role,
                       first_name AS firstName,
                       last_name AS lastName
                FROM users
                WHERE id = :user_id
            ")->execute(array(
                ":user_id" => $user_id
            ))->fetch(UserDTO::class)
                ->current();
        }catch (PDOException $e){
            return 'Error! ' . $e->getMessage();
        }
    }

    public function getUserByUsername($username)
    {
        // TODO: Implement getUserByUsername() method.
    }

    public function getUserByEmail($email)
    {
        // TODO: Implement getUserByEmail() method.
    }

    /** --------------------DELETE------------------- */
    public function delete(UserDTO $userDTO)
    {
        // TODO: Implement delete() method.
    }
}