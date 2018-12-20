<?php
namespace App\Controller;

class AdminController extends BaseController
{
    public function getIndex()
    {
        
        //  include_once "../views/index.php";
        return $this->RenderHtml('admin.twig');
    }
}
