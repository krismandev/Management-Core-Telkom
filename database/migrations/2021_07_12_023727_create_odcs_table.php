<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odcs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('feeder_id');
            $table->string('nama_odc');
            $table->integer('start_core');
            $table->integer('end_core');
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
            $table->integer('kapasitas')->nullable();
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('odcs');
    }
}
