<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHocVienBaiThiAddForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hoc_vien_bai_thi', function ($table) {
            $table->foreign('mon_hoc_id')
                ->references('id')->on('mon_hoc')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::table('hoc_vien_bai_thi', function($table){
            $table->dropForeign('hoc_vien_bai_thi_mon_hoc_id_foreign');
            $table->dropForeign('hoc_vien_bai_thi_user_id_foreign');
            $table->dropForeign('hoc_vien_bai_thi_bai_thi_id_foreign');
        });
    }
}
