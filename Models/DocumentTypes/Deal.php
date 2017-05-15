<?php
namespace App\Models\DocumentTypes;

class Deal extends TypesAbstract
{

    public function getDate()
    {
        return $this->created_at;
    }
}