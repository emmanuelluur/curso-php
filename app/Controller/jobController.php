<?php
namespace App\Controller;

use App\Model\Job;
use Respect\Validation\Validator;

class JobController extends BaseController
{
    public function getJob($request)
    {
        //  var_dump($request->getParsedBody()); show data from views
        $responseMessage = null;
        $cssClass = null;

        if ($request->getMethod() == 'POST') {
            $jobValidator = Validator::key('title', Validator::stringType()->notEmpty())
                ->key('description', Validator::stringType()->notEmpty());
            try {
                //code...
                $jobValidator->assert($request->getParsedBody()); // valida datos de entrada
                $job = new Job;
                $job->title = $request->getParsedBody()['title'];
                $job->description = $request->getParsedBody()['description'];
                $job->visible = true;
                $job->save();
                $responseMessage = "Saved";
                $cssClass = 'alert alert-success';
            } catch (\Exception $e) {
                //throw $th;
                $cssClass = 'alert alert-danger';
                $responseMessage = $e->getMessage();
            }
            

        }
        //  include_once "../views/addJobs.php";
        return $this->RenderHtml('addJobs.twig',[
            'responseMessage'=>$responseMessage,
            'cssClass' => $cssClass
        ]);
    }
}
