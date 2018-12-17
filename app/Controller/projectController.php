<?php
namespace App\Controller;

use App\Model\Project;

class ProjectController
{
    public function getProject($request)
    {
        if ($request->getMethod() == 'POST') {
            $datos = $request->getParsedBody();
            $project = new Project;
            $project->title = $datos['title'];
            $project->description = $datos['description'];
            $project->visible = true;
            $project->save();
        }
        include_once "../views/addProjects.php";
    }
}
