<?php

namespace Modules\BaseMaterial\Models;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Location\Models\Location;
use Modules\Ingredient\Models\BaseMaterialIngredient;

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
    /**
     * Get the user that created the base material.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    /**
     * Get the location associated with the base material.
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'LocationID');
    }
    /**
     * Get the location associated with the base material.
     */
    // public function ingredientPurchase()
    // {
    //     return $this->belongsTo(RawMaterialPurchase::class,'LocationID');
    // }

    public function baseMaterialIngredients()
    {
        return $this->hasMany(BaseMaterialIngredient::class, 'BaseMaterialID', 'id');
    }

     
}
