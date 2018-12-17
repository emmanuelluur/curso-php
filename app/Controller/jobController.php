<?php
namespace App\Controller;

use App\Model\Job;

class JobController
{
    public function getJob($request)
    {
        if ($request->getMethod() == 'POST') {
            $datos = $request->getParsedBody();
            $job = new Job;
            $job->title = $datos['title'];
            $job->description = $datos['description'];
            $job->visible = true;
            $job->save();
        }
        include_once "../views/addJobs.php";
    }
}
