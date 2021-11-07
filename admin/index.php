<?php
include '../core/Database.php';
include '../models/BaseModel.php';
include '../controllers/admin/BaseController.php';
$request = '';
isset($_REQUEST['controller']) ? $request = $_REQUEST['controller'] : $request = 'home';
$controllerName = ucfirst(strtolower($request) . 'Controller');
$actionName = $_REQUEST['action'] ?? 'index';
include "../controllers/admin/$controllerName.php";
$controllerObject = new $controllerName;
$controllerObject->$actionName();
