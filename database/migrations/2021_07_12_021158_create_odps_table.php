<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('core_id')->nullable();
            $table->integer('core_splited_id')->nullable();
            $table->tinyInteger('no_odp')->nullable();
            $table->string('nama_frame_odp')->nullable();
            $table->string('nama_odp')->nullable();
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('odps');
    }
}
