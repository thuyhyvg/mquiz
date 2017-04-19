<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBaiThiAddForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bai_thi', function ($table) {
            $table->foreign('mon_hoc_id')
                ->references('id')->on('mon_hoc')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::table('bai_thi', function($table){
            $table->dropForeign('bai_thi_mon_hoc_id_foreign');
            $table->dropForeign('bai_thi_user_id_foreign');
        });
    }
}
