<?php

namespace Modules\Ingredient\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\BaseMaterial\Models\BaseMaterial;
use Modules\Ingredient\Models\Ingredient;
use Illuminate\Support\Facades\DB;

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

    /**
     * Boot method to add model event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($baseMaterialIngredient) {
            // Update Ingredient QuantityInStock and leftQuantity when a new record is created
            $ingredient = $baseMaterialIngredient->ingredient;
            if ($ingredient) {
                $ingredient->QuantityUsed += $baseMaterialIngredient->QuantityUsed;

                // Calculate leftQuantity
                $leftQuantity = $ingredient->QuantityPurchased - $ingredient->QuantityUsed;

                $ingredient->QuantityInStock = $leftQuantity;
                $ingredient->save();
                
                DB::table('base_material_ingredients')
                ->where('id', $baseMaterialIngredient->id)
                ->update(['LeftQuantity' => $leftQuantity]);
            }
        });

        static::updated(function ($baseMaterialIngredient) {
            // Update Ingredient QuantityInStock and leftQuantity when a record is updated
            $original = $baseMaterialIngredient->getOriginal();
            $ingredient = $baseMaterialIngredient->ingredient;
            if ($ingredient) {
                // Ensure QuantityUsed exists in the original attributes
                $originalQuantityUsed = isset($original['QuantityUsed']) ? $original['QuantityUsed'] : 0;
                $st_used=$baseMaterialIngredient->QuantityUsed - $originalQuantityUsed;
                // Adjust QuantityUsed based on the change in QuantityUsed
                $ingredient->QuantityUsed += $st_used;

                // Calculate leftQuantity
                $leftQuantity = $ingredient->QuantityPurchased - $ingredient->QuantityUsed;

                $ingredient->QuantityInStock = $leftQuantity;
                $ingredient->save();

                DB::table('base_material_ingredients')
                ->where('id', $baseMaterialIngredient->id)
                ->update(['LeftQuantity' => $st_used]);
            }
        });
    }

    /**
     * Get the ingredient associated with the base material ingredient.
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'IngredientID');
    }

    /**
     * Get the base material associated with the base material ingredient.
     */
    public function baseMaterial()
    {
        return $this->belongsTo(BaseMaterial::class, 'BaseMaterialID');
    }
}
