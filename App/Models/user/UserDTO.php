<?php

namespace App\Models\user;

use Exception;

class UserDTO
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $firstName;
    private string $lastName;
    private string $role;

    /**
     * @throws Exception
     */
    public static function create($id, $username, $email, $password, $firstName, $lastName, $role): UserDTO
    {
        return (new UserDTO())
            ->setId($id)
            ->setUsername($username)
            ->setEmail($email)
            ->setPassword($password)
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setRole($role);
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setUsername($username): static
    {

        if (!isset($username)){
            throw new Exception('Username can not be empty!');
        }

        $username = $this->validateInput($username);

        if (strlen($username) < 3 || strlen($username) > 45){
            throw new Exception('Username must be between 3 - 45 characters!');
        }

        if (!preg_match("/^[\w]+$/",$username)){
            throw new Exception('Invalid chars in username! Allowed (a-zA-Z0-9_)');
        }

        $this->username = $username;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setEmail(string $email): static
    {

        if (!isset($email)){
            throw new Exception('Email can not be empty!');
        }

        $email = $this->validateInput($email);

        if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            throw new Exception('Invalid Email!');
        }

        if (strlen($email) < 5 || strlen($email) > 245){
            throw new Exception('Invalid Email!');
        }

        $this->email = $email;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setPassword(string $password): static
    {

        if (!isset($password)){
            throw new Exception('Password can not be empty!');
        }

        $password = $this->validateInput($password);

        if (strlen($password) < 8 || strlen($password) > 245){
            throw new Exception('Password must be between 8 and 45 characters!');
        }

        $this->password = $password;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setFirstName(string $firstName): static
    {

        if (!isset($firstName)){
            $firstName = 'Firstname';
        }

        $firstName = $this->validateInput($firstName);

        if (strlen($firstName) < 2 || strlen($firstName) > 75){
            throw new Exception('Name must be between 2 and 75 characters!');
        }

        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setLastName(string $lastName): static
    {
        if (!isset($lastName)){
            $lastName = 'Lastname';
        }

        $lastName = $this->validateInput($lastName);

        if (strlen($lastName) < 2 || strlen($lastName) > 75){
            throw new Exception('Name must be between 2 and 75 characters!');
        }

        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setRole(int $role): static
    {
        if (!isset($role)){
            $role = 3;
        }

        if (!is_numeric($role)){
            throw new Exception('Invalid User Role!');
        }

        $this->role = $role;
        return $this;
    }

    private function validateInput($input): string
    {
        $input = trim($input);
        $input = htmlspecialchars($input);
        return stripcslashes($input);
    }

}