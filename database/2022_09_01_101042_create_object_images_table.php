<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('object_id')->unsigned()->index();
            $table->string('name');
            $table->string('guid');
            $table->string('ext')->length(20);
            $table->string('size');
            $table->boolean('main_image')->default(false);
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('object_images');
    }
}
