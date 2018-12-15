<?php
namespace App\Model;

class Project extends BaseElement 
{
    public function ListMeses()
    {
        $duration = parent::ListMeses(); // Llama metodo del padre;
        return "Trabajo Duracion: {$duration}";
    }
   
}