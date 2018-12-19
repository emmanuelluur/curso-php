<?php
namespace App\Controller;

use App\Model\User;

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
                echo "Valido";
            } else {
                //  muestra mensaje error si password invalido
                $responseMessage = 'Password invalido';
                $cssClass = 'alert alert-danger';
                return $this->RenderHtml('login.twig', [
                    'cssClass' => $cssClass,
                    'responseMessage' => $responseMessage,
                ]);
            }
        } else {
            //  muestra mensaje si usuario invalido
            $responseMessage = 'Usuario No Encontrado';
            $cssClass = 'alert alert-danger';
            return $this->RenderHtml('login.twig', [
                'cssClass' => $cssClass,
                'responseMessage' => $responseMessage,
            ]);
        }

    }

}
