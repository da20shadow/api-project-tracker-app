<?php
//TODO: CHANGE the ROOT Path before upload ot hosting
require_once ($_SERVER['DOCUMENT_ROOT'].'/api-goals-app/vendor/autoload.php');

use App\Models\user\UserDTO;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthValidator
{
    private static string $key = "sl45df345jj45sd32rfn#$%TaeSDF34T%W#FSfsdgsdfgaSDF#$%@$#%$%^$#sfasfdfasdf";

    /**
     * @throws Exception
     */
    public static function createToken(UserDTO $userDTO): array
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
        $jwt = JWT::encode($payload,self::$key,'HS256');

        return [
            'id' => $userDTO->getId(),
            'email' => $userDTO->getEmail(),
            'username' => $userDTO->getUsername(),
            'token' => $jwt,
            'expires' => $exp,
        ];
    }

    private function decode($token): stdClass
    {
        return JWT::decode($token,new Key(self::$key,'HS256'));
    }

    public function verifyToken($token)
    {

    }
}