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
        $routeLogo = null;
        if ($request->getMethod() == 'POST') {
            $jobValidator = Validator::key('title', Validator::stringType()->notEmpty())
                ->key('description', Validator::stringType()->notEmpty());
            try {
                //code...
                $jobValidator->assert($request->getParsedBody()); // valida datos de entrada

                $files = $request->getUploadedFiles(); //   Obtiene archivos en post
                $logo = $files['logo'];

                if($logo->getError() == UPLOAD_ERR_OK)
                {
                    //  SE OBTIENE NOMBRE DE ARCHIVO
                    $fileName = $logo->getClientFileName();
                    // RUTA LA USAMOS AL GUARDAR LA RUTA DE LA IMAGEN, PARA USARLA EN LA VISTA 
                    $routeLogo = "../../uploads-platzi/{$fileName}";
                    //  MUEVE ARCHIVO
                    $logo->moveTo($routeLogo);
                }
                // Guarda datos eloquent ORM
                $job = new Job;
                $job->title = $request->getParsedBody()['title'];
                $job->description = $request->getParsedBody()['description'];
                $job->logo = $routeLogo;
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
