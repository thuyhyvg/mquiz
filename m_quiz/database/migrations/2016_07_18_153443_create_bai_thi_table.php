<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaiThiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bai_thi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mon_hoc_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('ten_bai_thi');
            $table->tinyInteger('thoi_gian');
            $table->integer('so_cau_hoi');
            $table->tinyInteger('khoa');
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
        Schema::drop('bai_thi');
    }
}
