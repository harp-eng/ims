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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id'); // Primary key

            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);

            
            $table->string('EntityType', 50); // Type of entity (Customer, Supplier, etc.)
            $table->unsignedInteger('EntityID'); // Foreign key to entity's table
            $table->timestamp('TransactionDate'); // Date and time of transaction
            $table->unsignedInteger('UserID'); // Foreign key to users table
            $table->text('Notes')->nullable(); // Additional notes or comments
            
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
        Schema::dropIfExists('transactions');
    }
};
