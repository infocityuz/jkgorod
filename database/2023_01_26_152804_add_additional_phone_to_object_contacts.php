<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalPhoneToObjectContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('object_contacts', function (Blueprint $table) {
            $table->string('additional_phone', 191)->nullable();
            $table->string('last_name', 191)->nullable();
            $table->string('first_name', 191)->nullable();
            $table->string('surename', 191)->nullable();
            $table->dropColumn('user_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('object_contacts', function (Blueprint $table) {
            $table->dropColumn('additional_phone');
            $table->dropColumn('last_name');
            $table->dropColumn('first_name');
            $table->dropColumn('surename');
            $table->string('user_info', 191)->nullable();
        });
    }
}