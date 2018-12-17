<?php
namespace App\Controller;
/**
 * load view templates
 *  \ = entorno global, Twig no usa namespaces
 */
use \Twig_Loader_Filesystem,\Twig_Environment;
use Zend\Diactoros\Response\HtmlResponse;
class BaseController
{
    protected $templeteEngine;
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem("../views/");
        $this->templeteEngine = new Twig_Environment($loader, array(
            'debug' => true,
            'cache' => false,
        ));
    }

    public function RenderHtml($fileName, $data = [])
    {
        return new HtmlResponse($this->templeteEngine->render($fileName, $data));
    }
}
