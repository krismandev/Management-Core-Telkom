<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sto_id');
            $table->integer('ftm_oa_id');
            // $table->integer('panel_ftm_oa_id_start');
            // $table->integer('panel_ftm_oa_id_end');
            $table->string('nama_feeder');
            $table->integer('kapasitas');
            $table->tinyInteger('assign')->nullable();
            $table->tinyInteger('unassign')->nullable();
            $table->tinyInteger('core_used')->nullable();
            $table->tinyInteger('core_avaliable')->nullable();
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
        Schema::dropIfExists('feeders');
    }
}
