<?php
namespace App\Models\DocumentTypes;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypesAbstract
 * @package App\Models\DocumentTypes
 */
abstract class TypesAbstract extends Model implements TypesContract
{

    /**
     * Пользователь
     *
     * @return \App\Models\Employee
     */
    public function getEmployee()
    {
        return $this->belongsTo(\App\Models\Employee::class);
    }

    /**
     * Документ
     *
     * @return \App\Models\Document
     */
    public function getDocument()
    {
        return $this->belongsTo(\App\Models\Document::class);
    }
}