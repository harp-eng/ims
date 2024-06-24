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
        Schema::create('basematerials', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);

            $table->string('SKU', 50)->unique(); // Unique identifier
            $table->string('Barcode', 50)->nullable();
            $table->double('QuantityInStock', 15, 2)->nullable(); // Unit price of the product or raw material
            $table->integer('LeadTimeDays')->nullable();
            $table->date('ExpiryDate')->nullable();
            $table->boolean('IsPerishable')->default(false);
            $table->boolean('IsHazardous')->default(false);
            $table->boolean('IsQualityCheck')->default(false);
            $table->unsignedInteger('UserID'); // Foreign key to users table
            $table->unsignedInteger('LocationID'); // Foreign key to users table
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
        Schema::dropIfExists('basematerials');
    }
};
