<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeNewColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname')->nullable()->after('email');
            $table->string('lastname')->nullable()->after('firstname');
            $table->string('customer_id')->nullable()->after('lastname');
            $table->string('company')->nullable()->after('customer_id');
            $table->string('street_address')->nullable()->after('company');
            $table->string('postal_code')->nullable()->after('street_address');
            $table->string('city')->nullable()->after('postal_code');
            $table->string('country')->nullable()->after('city');
            $table->string('state')->nullable()->after('country');
            $table->string('phone')->nullable()->after('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
