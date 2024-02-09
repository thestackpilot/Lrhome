<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weavings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image_name')->nullable();
            $table->string('weaving_id')->nullable();
            $table->string('design_id')->nullable();
            $table->string('size_id')->nullable();
            $table->string('color_id')->nullable();
            $table->string('shape_id')->nullable();
            $table->string('material_id')->nullable();
            $table->string('collection_id')->nullable();
            $table->string('main_collection_id')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('weavings');
    }
}
