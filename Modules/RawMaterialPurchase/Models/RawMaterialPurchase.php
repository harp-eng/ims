<?php

namespace Modules\RawMaterialPurchase\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Location\Models\Location;
use Modules\Supplier\Models\Supplier;
use Modules\Ingredient\Models\Ingredient;


class RawMaterialPurchase extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'raw_material_purchases';

    protected static function boot()
    {
        parent::boot();

        static::created(function ($purchase) {
            // Update Ingredient QuantityInStock when a new purchase is created
            $ingredient = $purchase->ingredient;
            $ingredient->QuantityInStock += $purchase->QuantityPurchased;
            $ingredient->save();
        });

        static::updated(function ($purchase) {
            // Update Ingredient QuantityInStock when a purchase is updated
            $originalPurchase = $purchase->getOriginal();
            $ingredient = $purchase->ingredient;

            // Adjust QuantityInStock based on the change in QuantityPurchased
            $ingredient->QuantityInStock += ($purchase->QuantityPurchased - $originalPurchase['QuantityPurchased']);
            $ingredient->save();
        });
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\RawMaterialPurchase\database\factories\RawMaterialPurchaseFactory::new();
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class,'IngredientID');
    }

    /**
     * Get the user that created the base material.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID');
    }

    /**
     * Get the location associated with the base material.
     */
    public function location()
    {
        return $this->belongsTo(Location::class,'LocationID');
    }
}
