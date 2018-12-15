<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
   protected $table = "jobs";
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
}