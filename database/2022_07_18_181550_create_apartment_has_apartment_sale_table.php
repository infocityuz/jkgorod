<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentHasApartmentSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_has_apartment_sale', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('apartment_sale_id')->unsigned()->index();
            $table->bigInteger('apartment_has_id')->unsigned()->index();

            $table->foreign('apartment_sale_id')->references('id')->on('apartment_sale')
                ->onDelete('cascade');
            $table->foreign('apartment_has_id')->references('id')->on('apartment_has')
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
        Schema::dropIfExists('apartment_has');
    }
}
