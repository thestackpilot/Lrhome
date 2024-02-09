<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFiltersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('colors', function (Blueprint $table) {
            $table->string('size_id')->nullable()->after('color_id');
            $table->string('shape_id')->nullable()->after('size_id');
            $table->string('material_id')->nullable()->after('shape_id');
            $table->string('weaving_id')->nullable()->after('material_id');
            $table->renameColumn('parent_id', 'main_collection_id');
        });
        Schema::table('shapes', function (Blueprint $table) {
            $table->string('size_id')->nullable()->after('shape_id');
            $table->string('color_id')->nullable()->after('size_id');
            $table->string('material_id')->nullable()->after('shape_id');
            $table->string('weaving_id')->nullable()->after('material_id');
            $table->renameColumn('parent_id', 'main_collection_id');
        });
        Schema::table('sizes', function (Blueprint $table) {
            $table->string('color_id')->nullable()->after('size_id');
            $table->string('shape_id')->nullable()->after('color_id');
            $table->string('material_id')->nullable()->after('shape_id');
            $table->string('weaving_id')->nullable()->after('material_id');
            $table->renameColumn('parent_id', 'main_collection_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
