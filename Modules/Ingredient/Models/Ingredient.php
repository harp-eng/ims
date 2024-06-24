<?php

namespace Modules\Ingredient\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ingredients';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Ingredient\database\factories\IngredientFactory::new();
    }
}
