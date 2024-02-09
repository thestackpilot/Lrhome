<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('footer_id');
            $table->foreign('footer_id')->references('id')->on('footers');
            $table->string('meta_key')->nullable();
            $table->string('meta_value')->nullable();
            $table->boolean('is_active')->default('1');
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
        Schema::dropIfExists('footer_meta');
    }
}
