<?php

namespace Modules\Ingredient\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\RawMaterialPurchase\Models\RawMaterialPurchase;

class BaseMaterialIngredient extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'base_material_ingredients';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Ingredient\database\factories\BaseMaterialIngredientsFactory::new();
    }

    // Define the relationship to RawMaterialPurchase
    public function rawMaterialPurchases()
    {
        return $this->hasOne(RawMaterialPurchase::class, 'id', 'IngredientID');
    }

    // Listen for saved event to update related RawMaterialPurchases
    protected static function boot()
    {
        parent::boot();

        static::created(function ($baseMaterialIngredient) {
            // Update Ingredient QuantityInStock when a new purchase is created
            $rawMaterialPurchases = $baseMaterialIngredient->rawMaterialPurchases;
            if ($rawMaterialPurchases) {
                $rawMaterialPurchases->QuantityUsed += $baseMaterialIngredient->QuantityUsed;
                $rawMaterialPurchases->save();
            }
        });

        static::updated(function ($baseMaterialIngredient) {
            // Update Ingredient QuantityInStock when a purchase is updated
            $originalPurchase = $baseMaterialIngredient->getOriginal();
            $rawMaterialPurchases = $baseMaterialIngredient->rawMaterialPurchases;
            if ($rawMaterialPurchases) {
                // Adjust QuantityInStock based on the change in QuantityPurchased
                $rawMaterialPurchases->QuantityUsed += $baseMaterialIngredient->QuantityUsed - $originalPurchase['QuantityUsed'];
                $rawMaterialPurchases->save();
            }
        });
    }
}
