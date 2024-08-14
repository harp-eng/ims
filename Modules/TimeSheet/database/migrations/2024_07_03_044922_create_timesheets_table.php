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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('employee_id'); // Ensure this matches the type of `id` in `users`
            $table->timestamp('sign_in_time')->nullable();
            $table->timestamp('sign_out_time')->nullable();
            $table->date('date');
            $table->time('duration')->nullable();
            $table->text('notes')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');

            // Index for performance
            $table->index('employee_id');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timesheets');
    }
};
