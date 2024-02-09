<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeltedAtColumnToAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('roles_permissions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('section_meta', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sliders', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('slider_images', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users_permissions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users_roles', function (Blueprint $table) {
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

    }
}
