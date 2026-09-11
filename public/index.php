<?php

/*
|--------------------------------------------------------------------------
| Core
|--------------------------------------------------------------------------
*/

require_once "../config/Database.php";
require_once "../core/Model.php";
require_once "../core/Controller.php";

/*
|--------------------------------------------------------------------------
| Controller
|--------------------------------------------------------------------------
*/

require_once "../app/controllers/AbsensiController.php";

$controller = new AbsensiController();

/*
|--------------------------------------------------------------------------
| Routing
|--------------------------------------------------------------------------
*/

$action = $_GET['action'] ?? '';

switch($action){

    case "simpan":

        $controller->simpan();

        break;

    default:

        $controller->index();

        break;

}