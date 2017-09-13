<?php



require_once __DIR__ . '/autoload.php';


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode('/', $path);

$ctrl = !empty($pathParts[1]) ? $pathParts[1] : 'News';
$act = !empty($pathParts[2]) ? $pathParts[2] : 'All';
$id = !empty($pathParts[3]) ? $pathParts[3] : null;

$controllerClassName = $ctrl . 'Controller';

try
{
    $controller = new $controllerClassName;
    $method = 'action' . $act;

    if(!empty($id))
    {
        $controller->$method($id);
    }else{
        $controller->$method();
    }
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
