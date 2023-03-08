<?php
ob_start();
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/config.php';

use Core\Router;
use App\Controllers\NewsController;
use App\Controllers\UserController;
use App\Controllers\ApiController;
use App\Controllers\AdminController;
use Core\Authorization;

$router = new Router();
$auth = new Authorization();

$router->get('/', [NewsController::class, 'index']);
$router->get('/news', [NewsController::class, 'index']);
$router->get('/news/details', [NewsController::class, 'viewNewsDetails']);
$router->get('/api/news', [ApiController::class, 'api']);


if ($auth->isLoggedIn()) {
    $router->get('/api/news', [ApiController::class, 'api']);
    $router->get('/users', [UserController::class, 'index']);
    $router->post('/users', [UserController::class, 'deleteUser']);
    $router->get('/users/logout', [UserController::class, 'logout']);
    $router->post('/news/details', [NewsController::class, 'viewNewsDetails']);
    $router->get('/users/comments', [UserController::class, 'getUserComments']);

    if ($auth->getUserGroup() > 1) {
        $router->get('/admin', [AdminController::class, 'index']);
        $router->get('/admin/news', [AdminController::class, 'manageNews']);
        $router->get('/admin/users', [AdminController::class, 'users']);
        $router->get('/admin/delete_user', [AdminController::class, 'deleteUser']);
        $router->post('/admin/delete_user', [AdminController::class, 'deleteUser']);
        $router->get('/admin/editnews', [NewsController::class, 'editNews']);
        $router->post('/admin/editnews', [NewsController::class, 'editNews']);
        $router->get('/admin/createnews', [NewsController::class, 'createNews']);
        $router->post('/admin/createnews', [NewsController::class, 'createNews']);
    }
} else {
    $router->get('/users/register', [UserController::class, 'create']);
    $router->post('/users/register', [UserController::class, 'create']);
    $router->get('/users/login', [UserController::class, 'login']);
    $router->post('/users/login', [UserController::class, 'login']);
}
$router->run();
