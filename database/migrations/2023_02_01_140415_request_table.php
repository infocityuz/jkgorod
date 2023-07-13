<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_table', function (Blueprint $table) {
            $table->id();
            $table->json('type')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('landmark')->nullable();
            $table->decimal('total_area',10,2)->nullable();
            $table->decimal('living_space',10,2)->nullable();
            $table->decimal('kitchen_area',10,2)->nullable();
            $table->integer('floor')->nullable();
            $table->integer('floors_of_house')->nullable();
            $table->integer('number_of_rooms')->nullable();
            $table->decimal('ceiling_height',10,2)->nullable();
            $table->date('year_construction')->nullable();
            $table->decimal('price', 15,2)->nullable();
            $table->tinyInteger('currency')->nullable();
            $table->boolean('is_exchange')->default(false);
            $table->boolean('is_furnished')->default(false);
            $table->boolean('is_commission')->default(false);
            $table->string('is_commission_percent')->nullable();
            $table->string('is_commission_number')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('repair')->nullable();
            $table->string('layout')->nullable(); //layout table bajraish kerak
            $table->string('bathroom')->nullable();//bathroom table bajraish kerak
            $table->string('building_type')->nullable();//building_type table bajraish kerak
            $table->string('housing_type')->nullable();//housing_type table bajraish kerak
            $table->string('phone_number')->nullable();
            $table->string('organization')->nullable();
            $table->string('distance_to_metro')->nullable();
            $table->string('metro')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_table');
    }
}
