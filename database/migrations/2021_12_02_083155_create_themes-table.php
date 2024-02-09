<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('theme_name')->nullable();
            $table->string('theme_slug')->nullable();
            $table->string('theme_prefix')->nullable();
            $table->string('theme_abrv')->nullable();
            $table->string('theme_api_slug')->nullable();
            $table->string('theme_api_base_url')->nullable();
            $table->string('theme_api_key')->nullable();
            $table->string('theme_api_company')->nullable();
            $table->boolean('is_active')->default(0);
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
        Schema::drop('themes');
    }
}
