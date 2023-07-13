<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentSaleContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_sale_contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('apartment_sale_id')->unsigned();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('additional_phone_number')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('apartment_sale_contacts');
    }
}
