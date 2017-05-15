<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;


/**
 * App\Models\DocumentCategory
 *
 * @property integer $id
 * @property string $name
 * @mixin \Eloquent
 */
class DocumentCategory extends Model
{
    use Rememberable;

    protected $fillable = ['name'];
    public $timestamps = false;
}