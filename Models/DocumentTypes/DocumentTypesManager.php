<?php
namespace App\Models\DocumentTypes;

class DocumentTypesManager
{
    /**
     * Получить объект типа документа
     * 
     * @param $type_id
     * @return mixed
     * @throws \Exception
     */
    public function create($type_id) {
        if (!isset($this->getTypeModels()[$type_id])) {
            throw new \Exception('Class must be an instance of Illuminate\Database\Eloquent\Model');
        }
        $object = ucfirst($this->getTypeModels()[$type_id]);
        $class = __NAMESPACE__ . '\\' . $object;
        if (class_exists($class)) {
            $model = app()->make($class);
            if (!$model instanceof TypesAbstract) {
                throw new \Exception("Class must be an instance of TypesAbstract");
            }

            return $model;
        }
        throw new \Exception('Class must be an instance of Illuminate\Database\Eloquent\Model');
    }

    /**
     * Список моделей документов
     * 
     * @return array
     */
    private function getTypeModels()
    {
        return [
            1 => 'Hourly',
            3 => 'Deal',
        ];
    }
}