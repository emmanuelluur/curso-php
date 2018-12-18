<?php
namespace App\Controller;

use App\Model\Project;
use Respect\Validation\Validator;

class ProjectController extends BaseController
{
    public function getProject($request)
    {
        //  var_dump($request->getParsedBody()); show data from views
        $responseMessage = null;
        $cssClass = null;

        if ($request->getMethod() == 'POST') {
            $projectValidator = Validator::key('title', Validator::stringType()->notEmpty())
                ->key('description', Validator::stringType()->notEmpty());
            try {
                //code...
                $projectValidator->assert($request->getParsedBody());
                $project = new Project;
                $project->title = $request->getParsedBody()['title'];
                $project->description = $request->getParsedBody()['description'];
                $project->visible = true;
                $project->save();

                $responseMessage = "Saved";
                $cssClass = 'alert alert-success';
            } catch (\Exception $e) {
                //throw $th;
                $cssClass = 'alert alert-danger';
                $responseMessage = $e->getMessage();
            }

        }
        //  include_once "../views/addProjects.php";
        return $this->RenderHtml('addProjects.twig',[
            'responseMessage'=>$responseMessage,
            'cssClass' => $cssClass
        ]);
    }
}
