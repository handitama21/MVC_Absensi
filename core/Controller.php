<?php

class Controller
{
    /**
     * Load Model
     */
    public function model($model)
    {
        $file = __DIR__ . "/../app/models/" . $model . ".php";

        if (!file_exists($file)) {
            die("Model <b>$model</b> tidak ditemukan.");
        }

        require_once $file;

        return new $model();
    }

    /**
     * Load View
     */
    public function view($view, $data = [])
    {
        $file = __DIR__ . "/../app/views/" . $view . ".php";

        if (!file_exists($file)) {
            die("View <b>$view</b> tidak ditemukan.");
        }

        extract($data);

        require_once $file;
    }

    /**
     * Redirect
     */
    public function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }

    /**
     * JSON Response (AJAX)
     */
    public function json($data = [])
    {
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }

    /**
     * Cek request POST
     */
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Cek request GET
     */
    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
}