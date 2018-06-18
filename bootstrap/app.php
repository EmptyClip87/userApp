<?php

require_once '../vendor/autoload.php';

use app\Helpers\HttpRequest;
use app\Databases\Database;

HttpRequest::prepare();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r)
{
    $r->addRoute('GET', '/', 'UserController@index');
    $r->addRoute('GET', '/register', 'UserController@getRegisterForm');
    $r->addRoute('POST', '/register', 'UserController@register');
});

$db = Database::getInstance();
$db->connect();