<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanelFtmOasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel_ftm_oas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ftm_oa_id');
            $table->integer('no_panel');
            $table->integer('port_used')->nullable();
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
        Schema::dropIfExists('panel_ftm_oas');
    }
}
