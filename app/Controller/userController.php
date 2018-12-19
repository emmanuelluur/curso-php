<?php
namespace App\Controller;

use App\Model\User;
use Respect\Validation\Validator;

class UserController extends BaseController
{
    
    public function getUser($request)
    {
        return $this->RenderHtml('addUser.twig');
    }

    public function postSaveUser($request)
    {
        $responseMessage = null;
        $cssClass = null;
        $routeSave = null;
        if ($request->getMethod() == "POST") {
            //  Valida los campos vacios y tipo cadena
            $userValidator = Validator::key('mail', Validator::stringType()->notEmpty())
                ->key('password', Validator::stringType()->notEmpty());
            try {
                $userValidator->assert($request->getParsedBody()); // valida datos de entrada
                $files = $request->getUploadedFiles(); //   Obtiene archivos en post
                $image = $files['profile'];
                if ($image->getError() == UPLOAD_ERR_OK) {
                    //  SE OBTIENE NOMBRE DE ARCHIVO
                    $fileName = $image->getClientFileName();
                    // RUTA LA USAMOS AL GUARDAR LA RUTA DE LA IMAGEN, PARA USARLA EN LA VISTA

                    $routeUpload = "../../uploads-platzi/{$fileName}"; //   ruta a subir archivo
                    $routeSave = "../uploads-platzi/{$fileName}"; //  ruta a guardar en BD
                    //  MUEVE ARCHIVO
                    $image->moveTo($routeUpload);
                }
                // guarda datos

                $opciones = [ // coste pasword hash
                    'cost' => 12,
                ];
                $user = new User;
                $user->mail = $request->getParsedBody()['mail'];
                $user->password = password_hash($request->getParsedBody()['password'], PASSWORD_BCRYPT, $opciones);
                $user->image = $routeSave;
                $user->save();

                $responseMessage = "Saved";
                $cssClass = 'alert alert-success';
            } catch (\Exception $e) {
                //throw $th;
                $cssClass = 'alert alert-danger';
                $responseMessage = $e->getMessage();
            }
        }
        return $this->RenderHtml('addUser.twig', [
            'responseMessage' => $responseMessage,
            'cssClass' => $cssClass,
        ]);
    }
}
