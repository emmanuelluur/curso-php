<?php
namespace App\Controller;

use App\Model\Project;

class ProjectController
{
    public function getProject()
    {

        if (!empty($_POST) && isset($_POST['saveProject'])) {
            $project = new Project;
            $project->title = $_POST['title'];
            $project->description = $_POST['description'];
            $project->visible = true;
            $project->save();
        }
        include_once "../Views/addProjects.php";
    }
}
