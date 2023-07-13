<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildTypeHasObject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('build_type_has_object', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('object_table_id')->unsigned()->index();
            $table->bigInteger('building_type_id')->unsigned()->index();

            $table->foreign('object_table_id')->references('id')->on('object')
                ->onDelete('cascade');
            $table->foreign('building_type_id')->references('id')->on('building_type')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('build_type_has_object');
    }
}
