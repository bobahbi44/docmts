<?php
namespace App\Models;

use App\Models\DocumentTypes\DocumentTypesManager;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    const SHIFT_NIGHT = 1;
    const SHIFT_DAY = 2;

    public static function shifts()
    {
        return [
            self::SHIFT_DAY => 'Дневная',
            self::SHIFT_NIGHT => 'Ночная',
        ];
    }

    /** Relationships */

    /**
     * Пользователь
     *
     * @return User
     */
    public function user() {

        return $this->hasOne(User::class, 'userid', 'user_id');
    }

    /**
     * Подразделение
     *
     * @return Subdivision
     */
    public function subdivision() {

        return $this->hasOne(Subdivision::class);
    }

    /**
     * Тип документа
     *
     * @return Illuminate\Support\Collection
     */
    public function category()
    {
        return $this->hasOne(\App\Models\DirDocumentCategory::class, 'id', 'document_category');
    }

    /**
     * Возвращает список работников в документе
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getDocuments() {
        $model = App(DocumentTypesManager::class)->create($this->document_category);

        return $this->hasMany(get_class($model), 'document_id', 'id');
    }

    /**
     * Активность документа.
     * отключен или активен
     *
     * @param $model
     * @param $value
     * @return mixed
     */
    public function scopeActive($model, $value) {
        return $model->where('active', $value);
    }

    /**
     * Проверка на наличие дубликатов документов ранее добавленных
     *
     * @param $attributes
     * @return bool
     */
    public static function existsDuplicate($attributes)
    {
        $where = [];
        foreach ($attributes as $name => $value) {
            if (in_array($name, ['date', 'document_category', 'shift', 'user_id', 'subdivision_id'])) {
                $where[$name] = $value;
            }
        }
        return self::where($where)->exists();
    }
}
