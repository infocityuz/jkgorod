<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRequestTableToThereIsNearbyApartmentSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('there_is_nearby_apartment_sale', function (Blueprint $table) {
            $table->integer('is_request')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('there_is_nearby_apartment_sale', function (Blueprint $table) {
            //
        });
    }
}
