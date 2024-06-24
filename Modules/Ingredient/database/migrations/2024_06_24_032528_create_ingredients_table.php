<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);

            $table->integer('QuantityInStock')->default(0);
            $table->decimal('UnitPrice', 10, 2);
            $table->integer('ReorderLevel')->nullable();
            $table->integer('ReorderQuantity')->nullable();
            $table->string('StorageLocation', 100)->nullable();
            $table->integer('LeadTimeDays')->nullable();
            $table->string('UnitOfMeasure', 50)->nullable();
            $table->date('LastOrderDate')->nullable();
            $table->date('ExpiryDate')->nullable();
            $table->integer('MinOrderQuantity')->nullable();
            $table->integer('MaxOrderQuantity')->nullable();
            $table->integer('SafetyStockLevel')->nullable();
            $table->boolean('IsPerishable')->default(false);
            $table->boolean('IsHazardous')->default(false);
            $table->integer('AverageLeadTimeDays')->nullable();
            $table->integer('OrderFrequencyDays')->nullable();
            $table->date('LastReceivedDate')->nullable();
            $table->text('Notes')->nullable();
            
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('raw_material_purchases', function (Blueprint $table) {
            $table->increments('id');

            $table->tinyInteger('status')->default(1);

            $table->unsignedInteger('IngredientID');
            $table->unsignedInteger('SupplierID');
            $table->date('PurchaseDate');
            $table->integer('QuantityPurchased');
            $table->decimal('UnitPrice', 10, 2);
            $table->decimal('TotalPrice', 10, 2);
            $table->date('DeliveryDate')->nullable();
            $table->text('Notes')->nullable();
            
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('base_material_ingredients', function (Blueprint $table) {
            $table->increments('id'); // Primary key

            $table->unsignedInteger('BaseMaterialID'); // Foreign key to base_materials table
            $table->unsignedInteger('IngredientID'); // Foreign key to ingredients table
            $table->decimal('QuantityUsed', 10, 2); // Quantity of ingredient used
            $table->string('UnitOfMeasure', 50); // Unit of measure for the quantity used

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('base_material_ingredients');
        Schema::dropIfExists('raw_material_purchases');
        Schema::dropIfExists('ingredients');
    }
};
