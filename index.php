<?php
require_once __DIR__ . '/autoload.php';

$ctrl = isset($_GET['ctrl']) ? $_GET['ctrl'] : 'News';
$act = isset($_GET['act']) ? $_GET['act'] : 'All';


$controllerClassName = $ctrl . 'Controller';


try
{
    $controller = new $controllerClassName;
    $method = 'action' . $act;
    $controller->$method();
}
catch (ModelException $err)
{
    $view = new View();
    $view->error = $err->getMessage();
    header('HTTP/1.1 404 Not Found');
    $view->display('news/error.php');
}
catch (PDOException $err)
{
    $view = new View();
    $view->error = $err->getMessage();
    header('HTTP/1.1 403 Not Found');
    $view->display('news/error.php');
}
