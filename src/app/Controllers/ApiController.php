<?php

namespace App\Controllers;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use Core\Controller;
use Core\Router;
use Exception;

class ApiController extends Controller
{

    public static function api(Router $router)
    {
        $id = $_GET['id'] ?? '';
        $api_key = $_GET['api_key'] ?? '';
        $news = [];

        try {
            if (!isset($_SESSION['username']) && !isset($api_key)) {
                throw new ForbiddenException();
            }
            if ($id && $api_key) {
                $news = $router->db->getSingleNews($id, false, true);
                if ($news) {
                    $news = json_encode($news, JSON_PRETTY_PRINT);
                } else {
                    throw new ForbiddenException();
                }
            } elseif ($api_key) {
                $news = $router->db->getNews("", false, true);
                if ($news) {
                    $news = json_encode($news, JSON_PRETTY_PRINT);
                } else {
                    throw new NotFoundException();
                }
            }
        } catch (Exception $e) {
            $message = array([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            echo json_encode($message);
        }

        $router->view('api/index', [
            'news' => $news,
        ], true);
    }


}