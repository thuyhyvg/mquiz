<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBaiThiCauHoiAddForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bai_thi_cau_hoi', function ($table) {
            $table->foreign('cau_hoi_id')
                ->references('id')->on('cau_hoi')
                ->onDelete('cascade');
            $table->foreign('bai_thi_id')
                ->references('id')->on('bai_thi')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bai_thi_cau_hoi', function($table){
            $table->dropForeign('bai_thi_cau_hoi_cau_hoi_id_foreign');
            $table->dropForeign('bai_thi_cau_hoi_bai_thi_id_foreign');
        });
    }
}
