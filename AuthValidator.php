<?php
spl_autoload_register();

use App\Models\user\UserDTO;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthValidator
{
    private string $key = "sl45df345jj45sd32rfn#$%TaeSDF34T%W#FSfsdgsdfgaSDF#$%@$#%$%^$#sfasfdfasdf";

    public function createToken(UserDTO $userDTO): array
    {
        $iat = time();
        $exp = $iat + 60 * 60; // Expiration 1 hour
        $payload = [
            'iss' => 'http://localhost:8090/api-goals-app/', //API
            'aud' => 'http://localhost:3000/', //Front End
            'iat' => $iat, //Issued time
            'exp' => $exp,
            'id' => $userDTO->getId(),
            'username' => $userDTO->getUsername(),
            'email' => $userDTO->getEmail(),
            'role' => $userDTO->getRole(),
        ];
        $jwt = JWT::encode($payload,$this->key,'HS256');

        return [
            'token' => $jwt,
            'expires' => $exp,
            'id' => $userDTO->getId(),
            'username' => $userDTO->getUsername(),
            'email' => $userDTO->getEmail(),
            'role' => $userDTO->getRole()
        ];
    }

    private function decode($token): stdClass
    {
        return JWT::decode($token,new Key($this->key,'HS256'));
    }

    public function verifyToken($token)
    {

    }
}