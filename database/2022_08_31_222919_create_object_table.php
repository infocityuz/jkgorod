<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object', function (Blueprint $table) {
            $table->id();
            $table->string('object_category'); #done
            $table->bigInteger('object_parent_element')->nullable();  #done
            $table->string('title');
            $table->tinyInteger('currency')->default(1);
            $table->decimal('price', 12,2);
            $table->decimal('service_fee', 12,2);
            $table->tinyInteger('site');
            $table->text('description');
            $table->string('address');
            $table->bigInteger('object_region_id')->unsigned()->index(); #done
            $table->bigInteger('district_id')->unsigned()->index();  #done
            $table->bigInteger('street_id')->unsigned()->index(); #done
            $table->integer('house_number');
            $table->string('village_name')->nullable();
            $table->string('village_lastname')->nullable();
            $table->string('build_year')->nullable();
            $table->decimal('build_area',10,2)->nullable();
            $table->integer('yard_count')->nullable();
            $table->integer('house_count')->nullable()->nullable();
            $table->decimal('house_area_min',10,2)->nullable();
            $table->decimal('house_area_max',10,2)->nullable();
            $table->decimal('yard_area_min',10,2)->nullable();
            $table->decimal('yard_area_max',10,2)->nullable();
            $table->string('external_infrastructure')->nullable();
            $table->string('internal_infrastructure')->nullable();
            $table->string('object_security')->nullable();      #done
            $table->string('repair')->nullable();               #done
            $table->string('building_name')->nullable();
            $table->string('building_section')->nullable();
            $table->string('building_state')->nullable();
            $table->integer('ready_quarter')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('floor_count')->nullable();
            $table->string('material')->nullable();     #done
            $table->string('building_class')->nullable();       #done
            $table->string('legal_address')->nullable();
            $table->string('access')->nullable();   #done
            $table->string('parking')->nullable();
            $table->integer('parking_price')->nullable();
            $table->string('internet')->nullable();
            $table->string('internet_type')->nullable();
            $table->string('work_plan')->nullable();
            $table->string('lift')->nullable();
            $table->integer('lift_person_count')->nullable();
            $table->string('work_type')->nullable();
            $table->decimal('ceiling_height',10,2)->nullable();
            $table->decimal('cost_of_legal_address',10,2)->nullable();
            $table->integer('user_id');
            $table->string('ads')->nullable();
            $table->string('body')->nullable();

            $table->foreign('district_id')->references('id')->on('district')
                ->onDelete('cascade');

            $table->foreign('street_id')->references('id')->on('street')
                ->onDelete('cascade');

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
        Schema::dropIfExists('object');
    }
}
