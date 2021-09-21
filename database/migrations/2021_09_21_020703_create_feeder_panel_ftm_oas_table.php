<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeederPanelFtmOasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeder_panel_ftm_oas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('panel_ftm_oa_id');
            $table->integer('feeder_id');
            $table->integer('start_core');
            $table->integer('end_core');
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
        Schema::dropIfExists('feeder_panel_ftm_oas');
    }
}
