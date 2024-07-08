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
        Schema::create('ordersheets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('order_item_id')->nullable();
            $table->enum('status', ['pending', 'filled', 'labelled', 'packed'])->default('pending');
            $table->unsignedBigInteger('worker_id')->nullable();
            $table->unsignedBigInteger('helper_id')->nullable();
            $table->integer('items_covered')->nullable();
            $table->unsignedBigInteger('base_material_id')->nullable();
            $table->double('quantity_used')->nullable();
            $table->text('description')->nullable();
        
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
        
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('order_item_id')->references('id')->on('order_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordersheets');
    }
};
