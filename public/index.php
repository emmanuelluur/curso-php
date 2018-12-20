<?php
require_once "../vendor/autoload.php";
require_once "../config.php";
use Aura\Router\RouterContainer;
use Illuminate\Database\Capsule\Manager as Capsule;

//  Muestra errores php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);
//  ***
session_start();
$capsule = new Capsule;
//  configuracion de conexion, los datos son un arreglo ver config.php 
$capsule->addConnection($config);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
//  peticiones http 
$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);
//  mapeo de rutas get y post, los controladores se deben llamar igual que las clases-- lo mismo con los modelos, estandar psr4 y psr7
$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();
//  index prinicpal
$map->get('index', '/Platzi-Curso/application/', [
    'controller' => 'App\Controller\IndexController',
    'action' => 'getIndex',
]);
//  jobs map
$map->get('addJobs', '/Platzi-Curso/application/jobs/add', [
    'controller' => 'App\Controller\JobController',
    'action' => 'getJob',
    'auth' => true,
]);

$map->post('saveJobs', '/Platzi-Curso/application/jobs/add', [
    'controller' => 'App\Controller\JobController',
    'action' => 'getJob',
]);
// projects map
$map->get('addProjects', '/Platzi-Curso/application/projects/add', [
    'controller' => "App\Controller\ProjectController",
    'action' => "getProject",
    'auth' => true,
]);

$map->post('saveProjects', '/Platzi-Curso/application/projects/add', [
    'controller' => "App\Controller\ProjectController",
    'action' => "getProject",
]);
// users map
$map->get('addUsers', '/Platzi-Curso/application/users/add', [
    'controller' => "App\Controller\UserController",
    'action' => "getUser",
    'auth' => true,
]);
$map->post('saveUsers', '/Platzi-Curso/application/users/save', [
    'controller' => "App\Controller\UserController",
    'action' => "postSaveUser",
]);

//  Login

$map->get('login', '/Platzi-Curso/application/login', [
    'controller' => "App\Controller\AuthController",
    'action' => "getLogin",
]);

$map->post('auth', '/Platzi-Curso/application/auth', [
    'controller' => "App\Controller\AuthController",
    'action' => "postLogin",
]);

$map->get('logout', '/Platzi-Curso/application/logout', [
    'controller' => "App\Controller\AuthController",
    'action' => "logOut",
]);

// admin index
$map->get('admin', '/Platzi-Curso/application/admin', [
    'controller' => "App\Controller\AdminController",
    'action' => "getIndex",
    'auth' => true,
]);



$matcher = $routerContainer->getMatcher();

$route = $matcher->match($request);

if (!$route) {
    echo "404";
} else {
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];
    $needsAuth = $handlerData['auth'] ?? false; //  si no esta definido pasa false
    $sesionId = $_SESSION['userId'] ?? false;
    if ($needsAuth && !$sesionId) {
        //  si la ruta esta protegida y no hay id de session muestra login
       $controllerName = "App\Controller\AuthController";
       $actionName = "getLogin";
    }
    $controller = new $controllerName;
    $response = $controller->$actionName($request);
    foreach ($response->getHeaders() as $name => $values) {
        # recorre cabeceras
        foreach ($values as $value) {
            header(sprintf('%s: %s', $name, $value), false);
        }
    }
    http_response_code($response->getStatusCode());
    echo $response->getBody();
}
