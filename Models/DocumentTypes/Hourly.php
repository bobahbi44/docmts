<?php
namespace App\Models\DocumentTypes;

class Hourly extends TypesAbstract
{

    public function getDate()
    {
        return $this->date;
    }
}