<?php

namespace Core;

use Firebase\JWT\JWT;

class Authentication
{

    public function setUserSession($username, $id, $userGroup): void
    {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        $_SESSION['userGroup'] = $userGroup;
    }

    public static function getUserSessionInfo($value)
    {
        return $_SESSION[$value];
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['username'])) {
            return true;
        } else {
            return false;
        }
    }

    public function logOut(): void
    {
        if (isset($_SESSION['username'])) {
            unset($_SESSION['username']);
            unset($_SESSION['id']);
            unset($_SESSION['userGroup']);
            session_destroy();
        }
    }

    public static function setToken()
    {
        $key = 'private_key';
        $iat = time();
        $exp = $iat + (60 * 60);
        $payload = [
            'iss' => 'http://localhost/api/news',
            'aud' => 'http://localhost/news',
            'iat' => $iat,
            'nbf' => $exp
        ];

        if (isset($_SESSION['username'])) {
            $jwt = JWT::encode($payload, $key, 'HS256');
            return array(
                'token' => $jwt,
                'expires' => $exp
            );
        }
    }

}