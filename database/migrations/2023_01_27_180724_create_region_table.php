<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region', function (Blueprint $table) {
            $table->id();
            $table->string('name_uz', 60)->nullable();
            $table->string('name_oz', 60)->nullable();
            $table->string('name', 60)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('town', function (Blueprint $table) {
            $table->id();
            $table->integer('region_id')->nullable();
            $table->string('name_uz', 120)->nullable();
            $table->string('name_oz', 120)->nullable();
            $table->string('name', 120)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('area', function (Blueprint $table) {
            $table->id();
            $table->integer('town_id');
            $table->string('name_uz', 120)->nullable();
            $table->string('name_oz', 120)->nullable();
            $table->string('name', 120)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

//        Schema::table('object', function (Blueprint $table) {
//            $table->integer('region_id');
//            $table->integer('town_id');
//            $table->integer('area_id');
//            $table->dropColumn('region');
//            $table->dropColumn('town');
//            $table->dropColumn('area');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region');
        Schema::dropIfExists('town');
        Schema::dropIfExists('area');

        Schema::table('object', function (Blueprint $table) {
            $table->dropColumn('region_id');
            $table->dropColumn('town_id');
            $table->dropColumn('area_id');
            $table->string('region', 191);
            $table->string('town', 191);
            $table->string('area', 191);
        });
    }
}