<?php

namespace Modules\Ingredient\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Supplier\Models\Supplier;
use Modules\Location\Models\Location;
use Modules\Ingredient\Models\BaseMaterialIngredient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
    /**
     * Get the user that created the base material.
     */
    public function useHistory()
    {
        return $this->hasmany(BaseMaterialIngredient::class, 'IngredientID');
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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($ingredient) {
            // Calculate and update QuantityInStock on create without triggering events
            $newQuantityInStock = $ingredient->QuantityPurchased - $ingredient->QuantityUsed;
            $totalPrice=$ingredient->QuantityPurchased*$ingredient->UnitPrice;
            $sku='ING-' . Str::padLeft(rand(1, 99999), 5, '0');
            DB::table('ingredients')
                ->where('id', $ingredient->id)
                ->update(['QuantityInStock' => $newQuantityInStock,'SKU'=>$sku,'TotalPrice'=>$totalPrice]);
        });

        static::updated(function ($ingredient) {
            // Calculate and update QuantityInStock on update without triggering events
            $newQuantityInStock = $ingredient->QuantityPurchased - $ingredient->QuantityUsed;
            DB::table('ingredients')
                ->where('id', $ingredient->id)
                ->update(['QuantityInStock' => $newQuantityInStock]);
        });
    }
}
