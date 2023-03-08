<?php

namespace Core;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function get($path, $fn): void
    {
        $this->getRoutes[$path] = $fn;
    }

    public function post($path, $fn): void
    {
        $this->postRoutes[$path] = $fn;
    }

    public function run(): void
    {
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
        if (str_contains($currentUrl, '?')) {
            $currentUrl = substr($currentUrl, 0, strpos($currentUrl, '?'));
        }
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;// /news /users
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }
        if ($fn) {
            call_user_func($fn, $this);
        } else {
            header("Location: /news");
        }
    }

    public function view($view, $params = [], $api = false): void // news/index
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__ . "/../app/Views/$view.php";
        $content = ob_get_clean();

        if ($api) {
            //iaşlsdjhak
            include_once __DIR__ . "/../app/Views/api_layout.php";
        } else {
            include_once __DIR__ . "/../app/Views/header.php";
        }
    }
}