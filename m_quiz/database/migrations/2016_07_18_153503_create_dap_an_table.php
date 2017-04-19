<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDapAnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dap_an', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cau_hoi_id')->unsigned();
            $table->text('noi_dung_dap_an');
            $table->tinyInteger('dung_sai');
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
        Schema::drop('dap_an');
    }
}
