<?php
namespace App\Models\DocumentTypes;

use Carbon\Carbon;

/**
 * Interface TypesContract
 * @package App\Models\DocumentTypes
 */
interface TypesContract
{

    /**
     * Возвращает объект работника
     *
     * @return \App\Models\Employee
     */
    public function getEmployee();

    /**
     * Возвращает объект документа-родителя
     *
     * @return \App\Models\Document
     */
    public function getDocument();

    /**
     * Возвращает дату создания документа (добавления работника)
     * @return Carbon
     */
    public function getDate();
    
    
}