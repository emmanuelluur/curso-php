<?php
namespace App\Controller;

use App\Model\User;
use Zend\Diactoros\Response\RedirectResponse;

//    psr7 messages http

class AuthController extends BaseController
{
    public function getLogin($request)
    {
        return $this->RenderHtml('login.twig');
    }

    public function postLogin($request)
    {
        $responseMessage = null;
        $cssClass = null;

        $data = $request->getParsedBody();
        $user = User::where('mail', $data['mail'])->first();
        if ($user) {
            if (password_verify($data['password'], $user->password)) {
                $_SESSION['userId'] = $user->id;
                return new RedirectResponse('/Platzi-Curso/application/admin');
            } else {
                //  muestra mensaje error si password invalido
                $responseMessage = 'Datos incorrectos';
                $cssClass = 'alert alert-danger';
                return $this->RenderHtml('login.twig', [
                    'cssClass' => $cssClass,
                    'responseMessage' => $responseMessage,
                ]);
            }
        } else {
            //  muestra mensaje si usuario invalido
            $responseMessage = 'Datos incorrectos';
            $cssClass = 'alert alert-danger';
        }
        return $this->RenderHtml('login.twig', [
            'cssClass' => $cssClass,
            'responseMessage' => $responseMessage,
        ]);
    }
    public function logOut()
    {

        session_destroy();
        return $this->RenderHtml('login.twig', [
            'cssClass' => 'alert alert-info',
            'responseMessage' => 'Log Out',
        ]);
    }
}
