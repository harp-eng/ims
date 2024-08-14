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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);

            $table->string('ContactName', 100)->nullable();
            $table->string('ContactEmail', 100)->nullable();
            $table->string('ContactPhone', 20)->nullable();
            $table->string('Address', 255)->nullable();
            $table->string('City', 100)->nullable();
            $table->string('State', 100)->nullable();
            $table->string('ZipCode', 20)->nullable();
            $table->string('Country', 100)->nullable();

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        // CREATE TABLE Suppliers (
        //     SupplierID INT PRIMARY KEY AUTO_INCREMENT,         -- Unique identifier for each supplier
        //     SupplierName VARCHAR(100) NOT NULL,                -- Name of the supplier
        //     ContactName VARCHAR(100),                          -- Name of the contact person
        //     ContactEmail VARCHAR(100),                         -- Email of the contact person
        //     ContactPhone VARCHAR(20),                          -- Phone number of the contact person
        //     Address VARCHAR(255),                              -- Address of the supplier
        //     City VARCHAR(100),                                 -- City of the supplier
        //     State VARCHAR(100),                                -- State of the supplier
        //     ZipCode VARCHAR(20),                               -- ZIP code of the supplier
        //     Country VARCHAR(100)                               -- Country of the supplier
        // );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
};
