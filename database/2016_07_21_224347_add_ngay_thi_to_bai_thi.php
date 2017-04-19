<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotAddNgayThiToBaiThi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//         Schema::table('bai_thi', function (Blueprint $table) {
//             $table->dateTime('ngay_thi')->after('ten_bai_thi');
//         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//         Schema::table('bai_thi', function($table){
//             $table->dropColumn('ngay_thi');
//         });
    }
}
