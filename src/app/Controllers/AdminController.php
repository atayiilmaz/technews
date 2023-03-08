<?php

namespace App\Controllers;

use Core\Controller;
use Core\Router;

class AdminController extends Controller


{
    public static function index(Router $router)
    {
        $router->view('admin/index', [
        ]);

    }

    public static function manageNews(Router $router)
    {
        $search = $_GET['search'] ?? '';

        if ($search) {
            $search = htmlspecialchars($search);
        }

        $news = $router->db->getNews($search, true);
        $count = count($router->db->getNews("", true));

        $router->view('admin/news', [
            'news' => $news,
            'search' => $search,
            'count' => $count,
        ]);

    }

    public static function users(Router $router)
    {
        $search = $_GET['search'] ?? "";

        if ($search) {
            $search = htmlspecialchars($search);
        }

        $users = $router->db->getUsers($search);
        $users_count = count($router->db->getUsers());

        $router->view('admin/users', [
            'users' => $users,
            'search' => $search,
            'count' => $users_count
        ]);
    }

    public static function deleteUser(Router $router)
    {

        $id = $_GET['id'];

        if ($id) {
            $id = htmlspecialchars($id);
        }

        $users = $router->db->getUsersById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['delete']) {
                $router->db->deleteUsers($id);
            }
        }

        $router->view('admin/delete_user', [
            'id' => $id,
            'users' => $users
        ]);
    }

    public static function deleteUserAction(Router $router)
    {
        $id = $_GET['id'];
        $uid = $_GET['uid'];

        $users = $router->db->deleteUserAction($id, $uid);

    }

}