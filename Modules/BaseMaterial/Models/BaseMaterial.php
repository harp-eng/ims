<?php

namespace Modules\BaseMaterial\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseMaterial extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'basematerials';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\BaseMaterial\database\factories\BaseMaterialFactory::new();
    }
}
