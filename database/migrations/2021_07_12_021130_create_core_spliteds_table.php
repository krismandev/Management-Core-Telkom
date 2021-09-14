<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreSplitedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_spliteds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->nullable();
            $table->integer('core_id');
            $table->integer('odc_id')->nullable();
            $table->integer('panel_odc_in')->nullable();
            $table->integer('core_odc_in')->nullable();
            $table->integer('spliter')->nullable();
            $table->integer('panel_odc_out')->nullable();
            $table->integer('port_odc_out')->nullable();
            $table->integer('dist_odc_out')->nullable();
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
        Schema::dropIfExists('core_spliteds');
    }
}
