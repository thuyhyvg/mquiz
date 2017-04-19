<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThiLaiToHocVienBaiThi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hoc_vien_bai_thi', function (Blueprint $table) {
            $table->tinyInteger('thi_lai')->after('ket_thuc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hoc_vien_bai_thi', function($table){
            $table->dropColumn('thi_lai');
        });
    }
}
