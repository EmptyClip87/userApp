<?php
require_once '../bootstrap/app.php';

use app\Enums\NamespacePaths;
use app\Exceptions\ErrorOutput;
use app\Exceptions\RoutingException;
use app\Helpers\HttpRequest;

$routeInfo = $dispatcher->dispatch(HttpRequest::getHttpMethod(), HttpRequest::getUri());

$uriInfo = explode('/', HttpRequest::getUri());
if(isset($uriInfo[2])) {
    $itemType = $uriInfo[2];
}

if(count($routeInfo) > 1) {
    $controllerInfo = explode('@', $routeInfo[1]);
    $controller = $controllerInfo[0];
    $method = $controllerInfo[1];
}


switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        ErrorOutput::say(new RoutingException('404 not found'));
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $controller;
        ErrorOutput::say(new RoutingException('405 Method Not Allowed'));
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = NamespacePaths::CONTROLLERS_PATH . $controller;
        $vars = $routeInfo[2];
        $keys = array_keys($vars);

        $obj = new $controller($db);
        $obj->$method();
        break;
}