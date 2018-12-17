<?php
namespace App\Controller;
use App\Model\{Job,Project};
class IndexController extends BaseController
{
    public function getIndex()
    {
        //  Trabajos
        $jobs = Job::get();
        // Limite de meses a mostar
        $mesesLimite = 240;
        //  Projectos
        $projects = Project::get();
        
        $name = "Emmanuel Lucio Urbina";
        //  include_once "../views/index.php";
        return $this->RenderHtml('index.twig',[
            'name' => $name,
            'jobs' => $jobs,
            'projects' => $projects
        ]);
    }
}
