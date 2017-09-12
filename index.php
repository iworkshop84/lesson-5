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
    $log = new ErrorLog();
    $log->assign($err);
    $log->write();

    $view = new View();
    $view->error = $err->getMessage();
    $view->code = $err->getCode();
    switch($view->code){
        case 1:
           header('HTTP/1.1 404 Not Found');
           break;
        case 2:
            header('HTTP/1.1 403 Not Found');
            break;
    }
    $view->display('news/error.php');
}
