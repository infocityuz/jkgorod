<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToObject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('object', function (Blueprint $table) {
            $table->dropColumn('object_region_id');
            $table->dropColumn('district_id');
            $table->dropColumn('street_id');
            $table->string('region', 191);
            $table->string('town', 191);
            $table->string('area', 191);
            $table->string('street', 191);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('object', function (Blueprint $table) {
            $table->bigInteger('object_region_id');
            $table->bigInteger('district_id');
            $table->bigInteger('street_id');
            $table->dropColumn('region');
            $table->dropColumn('town');
            $table->dropColumn('area');
            $table->dropColumn('street');
        });
    }
}