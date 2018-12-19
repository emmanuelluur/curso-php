<?php
require_once "../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
//  Muestra errores php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);
//  ***

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'platzi_curso',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();


$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

$map->get('index', '/Platzi-Curso/application/', [
    'controller' => 'App\Controller\IndexController',
    'action' => 'getIndex'
]);


$map->get('addJobs', '/Platzi-Curso/application/jobs/add', [
    'controller' => 'App\Controller\JobController',
    'action' => 'getJob'
]);

$map->post('saveJobs', '/Platzi-Curso/application/jobs/add', [
    'controller' => 'App\Controller\JobController',
    'action' => 'getJob'
]);

$map->get('addProjects', '/Platzi-Curso/application/projects/add', [
    'controller' => "App\Controller\ProjectController",
    'action' => "getProject"
]);

$map->post('saveProjects', '/Platzi-Curso/application/projects/add', [
    'controller' => "App\Controller\ProjectController",
    'action' => "getProject"
]);

$map->get('addUsers', '/Platzi-Curso/application/users/add', [
    'controller' => "App\Controller\UserController",
    'action' => "getUser"
]);
$map->post('saveUsers', '/Platzi-Curso/application/users/add', [
    'controller' => "App\Controller\UserController",
    'action' => "getUser"
]);

$matcher = $routerContainer->getMatcher();

$route = $matcher->match($request);



if (!$route) {
    echo "404";
} else {
    $handlerData = $route->handler;

    $controllerName = $handlerData['controller'];

    $actionName = $handlerData['action'];

    $controller = new $controllerName;

    $response = $controller->$actionName($request);
    echo $response->getBody();
}

