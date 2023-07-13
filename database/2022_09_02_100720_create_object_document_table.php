<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_document', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('object_id')->unsigned()->index()->nullable();
            $table->string('name')->nullable();
            $table->string('guid')->nullable();
            $table->string('ext')->length(20)->nullable();
            $table->string('size')->nullable();
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
        Schema::dropIfExists('object_document');
    }
}
