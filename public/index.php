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
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'platzi_curso',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$map->get('index', '/Platzi-curso/Proyecto/','../index.php');
$map->get('addJobs', '/Platzi-curso/Proyecto/jobs/add','../addJobs.php');
$map->get('addProjects', '/Platzi-curso/Proyecto/projects/add','../addProjects.php');
$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

if(!$route){
    echo "404";
}else{
    require_once $route->handler;
}
// var_dump();
/*
$route = $_GET['route'] ?? '/'; //  si esta definido route 

if($route == '/'){
    require_once "../index.php";
}else{
    require_once "../{$route}.php";
}
*/