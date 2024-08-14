<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_performances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worker_id');
            $table->string('task_name');
            $table->integer('task_time_taken');
            $table->integer('quality_of_work');
            $table->integer('quantity');
            $table->double('efficiency', 15, 2)->default(0)->nullable();
            $table->timestamps();

            // Foreign key constraint (Assuming there is a 'workers' table)
            $table->foreign('worker_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker_performances');
    }
}
