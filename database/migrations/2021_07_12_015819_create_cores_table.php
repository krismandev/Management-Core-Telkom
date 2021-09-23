<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('feeder_id');
            $table->integer('olt_id')->nullable();
            $table->integer('slot_olt_id')->nullable();
            $table->integer('port_olt')->nullable();
            $table->integer('panel')->nullable();
            $table->integer('odc_id')->nullable();
            $table->integer('no_core_feeder');
            $table->integer('panel_odc_in')->nullable();
            $table->integer('core_odc_in')->nullable();
            $table->integer('spliter')->nullable();
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
        Schema::dropIfExists('cores');
    }
}
