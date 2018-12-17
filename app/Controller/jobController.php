<?php
namespace App\Controller;
use App\Model\Job;
class JobController
{
    function getJob()
    {
        if(!empty($_POST) && isset($_POST['saveJob'])){
            $job = new Job;
            $job->title = $_POST['title'];
            $job->description = $_POST['description'];
            $job->visible = true;
            $job->save();
        }
        include_once "../views/addJobs.php";
    }
}
