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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);

            $table->unsignedInteger('CategoryID')->nullable(); // Foreign key
            $table->string('SKU', 50)->unique(); // Unique identifier
            $table->string('Barcode', 50)->nullable();
            $table->integer('QuantityInStock')->default(0);
            $table->decimal('UnitPrice', 10, 2);
            $table->decimal('CostPrice', 10, 2)->nullable();
            $table->integer('ReorderLevel')->nullable();
            $table->integer('ReorderQuantity')->nullable();
            $table->string('StorageLocation', 100)->nullable();
            $table->unsignedInteger('SupplierID')->nullable(); // Foreign key
            $table->integer('LeadTimeDays')->nullable();
            $table->date('ExpiryDate')->nullable();
            $table->integer('MinOrderQuantity')->nullable();
            $table->integer('MaxOrderQuantity')->nullable();
            $table->integer('SafetyStockLevel')->nullable();
            $table->boolean('IsPerishable')->default(false);
            $table->boolean('IsHazardous')->default(false);
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
        Schema::dropIfExists('products');
    }
};
