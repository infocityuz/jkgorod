<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThereIsNearbyApartmentSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('there_is_nearby_apartment_sale', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('apartment_sale_id')->unsigned()->index();
            $table->bigInteger('there_is_nearby_id')->unsigned()->index();
            $table->foreign('apartment_sale_id')->references('id')->on('apartment_sale')->onDelete('cascade');
            $table->foreign('there_is_nearby_id')->references('id')->on('there_is_nearby')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('there_is_nearby_apartment_sale');
    }
}
