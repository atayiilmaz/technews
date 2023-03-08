<?php

namespace App\Models;

use App;
use App\Helpers\Helper;
use Core\Authentication;
use Core\Database;

class User
{

    public ?int $id = null;
    public ?string $userGroup = null;
    public ?string $username = null;
    public ?string $password = null;
    public ?string $password_confirm = null;


    public function load($data): void
    {
        $this->id = $data['id'] ?? null;
        $this->userGroup = $data['userGroup'] ?? null;
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->password_confirm = $data['password_confirm'];
    }

    public function loadLoginInfo($data): void
    {
        $this->username = $data['username'];
        $this->password = $data['password'];
    }

    public function save(): array
    {
        $helper = new Helper;
        $db = Database::$db;
        $errors = [];
        if (!$this->username || !$this->password || !$this->password_confirm) {
            $errors[] = 'Kayıt olmak için tüm alanları doldurunuz!';
        }
        if ($this->username && !$helper->lengthValidation($this->username, 3, 40)) {
            $errors[] = "Kullanıcı adı 40 karakterden uzun olamaz!";
        }
        if ($this->password && !$helper->lengthValidation($this->password, 1, 200)) {
            $errors[] = "Şifre 200 karakterden fazla olamaz!";
        }
        if ($this->password != $this->password_confirm) {
            $errors[] = "Şifreler Uyuşmuyor";
        }
        if ($db->isExist('users', 'username', $this->username)) {
            $errors[] = "Kullanıcı adı kullanılmış!";
        }
        if (empty($errors)) {
            $db->createUser($this);
        }

        return $errors;

    }

    public function saveLoginInfo(): array
    {
        $db = Database::$db;
        $errors = [];
        if (!$this->username || !$this->password) {
            $errors[] = 'Giriş Yapmak için tüm alanları doldurunuz!';
        }
        if (!$db->loginCheck($this->username, $this->password)) {
            $errors[] = "Kullanıcı adı veya şifre yanlış!";
        }
        if (empty($errors)) {
            $this->id = $db->getData('users', 'username', $this->username, 'id');
            $this->userGroup = $db->getData('users', 'username', $this->username, 'userGroup');

            $authentication = new Authentication;
            $authentication->setUserSession($this->username, $this->id, $this->userGroup);
        }

        return $errors;
    }


}