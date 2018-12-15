<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
    crossorigin="anonymous">
    <title>Agrega trabajo</title>
</head>
<body>
    <div class  = "container">
        <p>
            <h1>ADD JOB</h1>
        </p>
        <form action="addJobs.php" method = 'post'>
            <div class = "form-group">
                <label for="title">Titulo</label>
                <input type="text" class = 'form-control' name="title" id="title">
            </div>
            <div class = "form-group">
                <label for="title">Descripción</label>
                <input type="text" class = 'form-control' name="description" id="description">
            </div>
            <button type="submit" class = 'btn btn-success' name = 'saveJob' id = 'saveJob'>Registrar</button>
        </form>
    
    </div>
</body>
</html>
<?php
require_once "vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Model\Job;
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

if(!empty($_POST) && isset($_POST['saveJob'])){
    $job = new Job;
    $job->title = $_POST['title'];
    $job->description = $_POST['description'];
    $job->visible = true;
    $job->save();
}

?>