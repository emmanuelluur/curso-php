<?php
use App\Model\{Job, Project, Printable};

$name = "Emmanuel Lucio Urbina";
//  Trabajos
$jobs = Job::get();


// Limite de meses a mostar
$mesesLimite = 240;
//  Projectos
$projects = Project::get();


//  trabajos
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
