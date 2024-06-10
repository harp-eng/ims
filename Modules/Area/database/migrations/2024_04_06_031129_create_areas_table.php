<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Area\Enums\AreaStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('polygon_coords')->nullable();
            $table->integer('vendor_id')->unsigned()->nullable();

            $table->tinyInteger('mon')->default(1);
            $table->tinyInteger('tue')->default(1);
            $table->tinyInteger('wed')->default(1);
            $table->tinyInteger('thu')->default(1);
            $table->tinyInteger('fri')->default(1);
            $table->tinyInteger('sat')->default(1);
            $table->tinyInteger('sun')->default(1);

            $table->string('status')->default(AreaStatus::Active->name);

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('postcodes', function (Blueprint $table) {
            $table->id();

            $table->integer('area_id')->unsigned()->nullable();
            $table->string('code')->nullable();
            $table->string('status')->default(AreaStatus::Active->name);
            
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
        Schema::dropIfExists('areas');
        Schema::dropIfExists('postcodes');
    }
};
