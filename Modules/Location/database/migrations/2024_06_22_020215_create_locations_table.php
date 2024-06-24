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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);


            $table->string('Zone', 50)->nullable(); // Zone within the warehouse
            $table->string('Aisle', 50)->nullable(); // Aisle number or identifier
            $table->string('Rack', 50)->nullable(); // Rack number or identifier
            $table->string('Shelf', 50)->nullable(); // Shelf number or identifier
            $table->string('Bin', 50)->nullable(); // Bin number or identifier
            $table->integer('Capacity')->nullable(); // Maximum capacity of the location
            $table->integer('CurrentOccupancy')->nullable(); // Current occupancy of the location
            $table->string('Type', 50)->nullable(); // Type of location (Storage, Picking, Packing)
            
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
        Schema::dropIfExists('locations');
    }
};
