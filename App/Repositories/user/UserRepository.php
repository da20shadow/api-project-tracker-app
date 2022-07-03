<?php

namespace App\Repositories\user;

use App\Models\user\UserDTO;
use Database\DBConnector;
use Database\PDODatabase;
use Exception;
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

    public function login(UserDTO $userDTO): ?UserDTO
    {
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
        } catch (PDOException $e) {
            return 'Error! ' . $e->getMessage();
        }
    }

    public function getUserByUsername($username)
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
                WHERE username = :username
            ")->execute(array(
                ":username" => $username
            ))->fetch(UserDTO::class)
                ->current();
        } catch (PDOException $e) {
            return 'Error! ' . $e->getMessage();
        }
    }

    public function getUserByEmail($email)
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
                WHERE email = :email
            ")->execute(array(
                ":email" => $email
            ))->fetch(UserDTO::class)
                ->current();
        } catch (PDOException $e) {
            return 'Error! ' . $e->getMessage();
        }
    }

    /** --------------------DELETE------------------- */
    public function delete(UserDTO $userDTO)
    {
        // TODO: Implement delete() method.
    }
}