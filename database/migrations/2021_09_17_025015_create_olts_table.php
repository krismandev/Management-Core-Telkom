<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOltsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('olts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hostname');
            $table->string('ip');
            $table->integer('sto_id');
            $table->string('merk');
            $table->string('type');
            $table->integer('no_frame');
            $table->integer('jumlah_slot');
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
        Schema::dropIfExists('olts');
    }
}
