<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiemSanToBaiThi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bai_thi', function (Blueprint $table) {
            $table->tinyInteger('diem_san')->after('khoa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bai_thi', function($table){
            $table->dropColumn('diem_san');
        });
    }
}
