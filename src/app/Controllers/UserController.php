<?php

namespace App\Controllers;

use App;
use Core\Authentication;
use App\Models\User;
use Core\Router;
use Core\Controller;
use JetBrains\PhpStorm\NoReturn;


class UserController extends Controller
{

    public static function index(Router $router)
    {
        $id = Authentication::getUserSessionInfo('id');
        $user = $router->db->getUsersById($id);
        $token = Authentication::setToken();

        $router->view('users/index', [
            'user' => $user,
            'token' => $token
        ]);
    }

    public static function create(Router $router)
    {
        $errors = [];
        $userData = [
            'username' => "",
            'password' => "",
            'password_confirm' => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData['username'] = htmlspecialchars(trim($_POST['username']));
            $userData['password'] = $_POST['password'];
            $userData['password_confirm'] = $_POST['password_confirm'];

            $user = new User();
            $user->load($userData);
            $errors = $user->save();
            if (empty($errors)) {
                header('Location: /users/login');
                exit;
            }
        }
        $router->view('users/register', [
            'user' => $userData,
            'errors' => $errors
        ]);
    }

    public static function login(Router $router)
    {
        $errors = [];
        $userData = [
            'username' => "",
            'password' => "",
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData['username'] = htmlspecialchars($_POST['username']);
            $userData['password'] = $_POST['password'];

            $user = new User();
            $user->loadLoginInfo($userData);
            $errors = $user->saveLoginInfo();
            if (empty($errors)) {
                header('Location: /users');
                exit;
            }
        }
        $router->view('users/login', [
            'user' => $userData,
            'errors' => $errors
        ]);
    }

    #[NoReturn] public static function logout()
    {
        $authentication = new Authentication;
        $authentication->logout();
        header('Location: /');
        exit;
    }

    public static function getUserComments(Router $router)
    {
        $id = Authentication::getUserSessionInfo('id');
        $search = $_GET['search'] ?? '';
        if ($search) {
            $search = htmlspecialchars($search);
        }
        $warning = "";
        $comments = $router->db->getCommentsByUserId($id, $search);
        $comments_count = count($router->db->getCommentsByUserId($id));

        if (!$comments_count) {
            $warning = 1;
        }

        $router->view('users/comments', [
            'comments' => $comments,
            'comments_count' => $comments_count,
            'warning' => $warning,
            'search' => $search
        ]);
    }

    public static function deleteUser(Router $router)
    {
        if (isset($_POST['delete'])) {
            $auth = new Authentication;
            $id = $auth->getUserSessionInfo('id');
            $router->db->deleteUser($id);
            $auth->logOut();
            header("location: /");
        }
    }
}

