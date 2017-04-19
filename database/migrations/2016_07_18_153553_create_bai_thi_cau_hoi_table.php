<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaiThiCauHoiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bai_thi_cau_hoi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bai_thi_id')->unsigned();
            $table->integer('cau_hoi_id')->unsigned();
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
        Schema::drop('bai_thi_cau_hoi');
    }
}
