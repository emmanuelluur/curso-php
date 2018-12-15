<?php
namespace App\Model;

class BaseElement Implements Printable
{
    private $title;
    public $description;
    public $visible = true;
    public $meses;
    public function __construct($title, $description)
    {
        $this->setTitle($title);
        $this->description = $description;
    }
    public function setTitle($title)
    {
        if ($title == "") {
            $this->title = "N/A";
        } else {
            $this->title = $title;
        }
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function ListMeses()
    {
        $year = floor($this->meses / 12);
        $mes = $this->meses % 12;
        if ($year == 0) {
            //  retorna solo los meses
            return "<p>{$mes} meses</p>";
        } elseif ($mes == 0) {
            //  retorna solo el año
            return "<p>$year años</p>";
        } else {
            // retorna años y meses
            return "<p>$year años {$mes} meses</p>";
        }
    }
    public function getDescription(){
        return $this->description;
    }
}