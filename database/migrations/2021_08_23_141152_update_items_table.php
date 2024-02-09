<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('item_id')->nullable()->after('id');
            $table->string('name')->nullable()->after('item_id');
            $table->string('design_id')->nullable()->after('name');
            $table->string('size_id')->nullable()->after('design_id');
            $table->string('color_id')->nullable()->after('size_id');
            $table->string('fiber_content')->nullable()->after('color_id');
            $table->string('construction')->nullable()->after('fiber_content');
            $table->string('country')->nullable()->after('construction');
            $table->string('style')->nullable()->after('country');
            $table->string('description')->nullable()->after('style');
            $table->integer('qty_available')->nullable()->after('description');
            $table->string('weight')->nullable()->after('qty-available');
            $table->string('dimensions')->nullable()->after('weight');
            $table->integer('basePrice')->nullable()->after('dimensions');
            $table->string('product_type')->nullable()->after('basePrice');
            $table->string('image')->nullable()->after('product_type');
            $table->text('UDF_fields')->nullable()->after('image');
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
