<?php
require_once "../vendor/autoload.php";
use Aura\Router\RouterContainer;
use Illuminate\Database\Capsule\Manager as Capsule;

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

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);
//
function ListElements($itm)
{
    // if ($jobs->visible == false):
    //     //  si es falso brinca a la siguiente iteracion
    //     return;
    // endif;
    echo "<li class = 'work-position'>";
    echo "<h5>{$itm->title}</h5>";
    echo "<p>{$itm->description}</p>";
    echo $itm->ListMeses();
    echo "
    <strong>Achievements:</strong>
    <ul>
      <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
      <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
      <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
    </ul>";
    echo "</li>";
}
//

$map->get('index', '/platzi-php-curso/', [
    'controller' => 'App\Controller\IndexController',
    'action' => 'getIndex'
]);


$map->get('addJobs', '/platzi-php-curso/jobs/add', [
    'controller' => 'App\Controller\JobController',
    'action' => 'getJob'
]);
$map->get('addProjects', '/platzi-php-curso/projects/add', [
    'controller' => "App\Controller\ProjectController",
    'action' => "getProject"
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

    $controller->$actionName();
}

