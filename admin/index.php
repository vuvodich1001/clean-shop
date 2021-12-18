<?php
include '../core/Database.php';
include '../models/BaseModel.php';
include '../controllers/admin/BaseController.php';
$request = '';
isset($_REQUEST['controller']) ? $request = $_REQUEST['controller'] : $request = 'home';
$controllerName = ucfirst(strtolower($request) . 'Controller');
$actionName = $_REQUEST['action'] ?? 'index';
include "../controllers/admin/$controllerName.php";
session_start();
if (!isset($_SESSION['user']) && $actionName != 'adminLogin') {
    include "../controllers/admin/AuthController.php";
    $auth = new AuthController();
    $auth->redirectLogin();
    exit();
} else if ($actionName == 'adminLogin' || $actionName == 'adminLogout') {
    $controllerObject = new $controllerName;
    $controllerObject->$actionName();
} else {
    $userId = $_SESSION['user']['user_id'];
    $controllerObject = new $controllerName;
    $check = $controllerObject->getUserModel()->checkPrivilege($userId, strtolower($request));
    if ($check) {
        $controllerObject->$actionName();
    } else {
        header('location:../views/admin/error.php');
    }
}
