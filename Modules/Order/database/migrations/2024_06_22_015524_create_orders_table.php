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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id'); // Primary key

            $table->text('description')->nullable();
            $table->enum('status', ['Pending','Processing','Ready To Ship','Shipped','Delivered','Cancelled'])->default('Pending');

            $table->unsignedInteger('CustomerID'); // Foreign key
            $table->date('OrderDate')->nullable();
            $table->date('ShipDate')->nullable();
            $table->decimal('TotalAmount', 10, 2);
            $table->text('ShippingAddressID')->nullable();
            $table->text('BillingAddressID')->nullable();
            $table->text('Notes')->nullable();

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id'); // Primary key
            $table->unsignedInteger('OrderID'); // Foreign key
            $table->unsignedInteger('ProductID'); // Foreign key
            $table->integer('Quantity');
            $table->decimal('UnitPrice', 10, 2);
            $table->decimal('TotalPrice', 10, 2);
            $table->text('Notes')->nullable();
            $table->enum('status', ['Pending','Processing','Ready To Ship','Shipped','Delivered','Cancelled'])->default('Pending');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->change(); // Ensuring the ID is an unsignedBigInteger
            $table->enum('status', ['Pending','Processing','Ready To Ship','Shipped','Delivered','Cancelled'])->default('Pending');
        });

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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('addresses');
    }
};
