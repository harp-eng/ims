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
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id'); // Primary key
            $table->string('EntityType', 50); // Type of entity (Customer, Supplier, etc.)
            $table->unsignedInteger('EntityID'); // Foreign key to entity's table
            $table->string('AddressLine1', 255)->nullable();
            $table->string('AddressLine2', 255)->nullable();
            $table->string('City', 100)->nullable();
            $table->string('State', 100)->nullable();
            $table->string('ZipCode', 20)->nullable();
            $table->string('Country', 100)->nullable();
            $table->string('AddressType', 50)->nullable(); // Billing, Shipping, etc.
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Optional: Foreign key constraints can be added dynamically if necessary
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
