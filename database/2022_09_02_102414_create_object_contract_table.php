<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_contract', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('object_id')->unsigned()->index()->nullable();
            $table->bigInteger('contract_admin_id')->unsigned()->index()->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->string('contract_number')->nullable();
            $table->string('contract_fee')->nullable();
            $table->foreign('contract_admin_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('object_id')->references('id')->on('object')
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
        Schema::dropIfExists('object_contract');
    }
}
