<?php

require_once "vendor/autoload.php";
use App\Model\{Job, Project, Printable};

$name = "Emmanuel Lucio Urbina";
//  Trabajos
$job = new Job("PHP Developer","Awesome Job");
$job->meses = 28;
$jobs = array($job,);
// Limite de meses a mostar
$mesesLimite = 240;
//  Projectos
$project1 = new Project("Project 1", "Description Project 1");
$projects = array($project1);

//  trabajos
function ListElements(Printable $jobs)
{
    if ($jobs->visible == false):
        //  si es falso brinca a la siguiente iteracion
        return;
    endif;
    echo "<li class = 'work-position'>";
    echo "<h5>{$jobs->getTitle()}</h5>";
    echo "<p>{$jobs->getDescription()}</p>";
    echo $jobs->ListMeses();
    echo "
    <strong>Achievements:</strong>
    <ul>
      <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
      <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
      <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
    </ul>";
    echo "</li>";
}
