<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentSaleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_sale_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('apartment_sale_id')->unsigned()->index();
            $table->string('name');
            $table->string('guid');
            $table->string('ext')->length(20);
            $table->string('size');
            $table->boolean('main_image')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('apartment_sale_id')->references('id')->on('apartment_sale')
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
        Schema::dropIfExists('apartment_sale_images');
    }
}
