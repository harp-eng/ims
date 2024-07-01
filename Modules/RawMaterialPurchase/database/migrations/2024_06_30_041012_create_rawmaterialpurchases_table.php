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
        Schema::create('raw_material_purchases', function (Blueprint $table) {
            $table->increments('id');

            $table->tinyInteger('status')->default(1);

            $table->unsignedInteger('IngredientID');
            $table->string('SKU', 50)->unique()->nullable(); // Unique identifier
            $table->unsignedInteger('SupplierID');
            $table->unsignedInteger('LocationID');
            $table->date('ExpiryDate')->nullable();
            $table->date('PurchaseDate');
            $table->double('QuantityPurchased');
            $table->double('QuantityUsed')->default(0);
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_material_purchases');
    }
};
