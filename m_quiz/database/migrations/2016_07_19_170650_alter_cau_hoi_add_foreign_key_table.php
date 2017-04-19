<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCauHoiAddForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cau_hoi', function ($table) {
            $table->foreign('mon_hoc_id')
                ->references('id')->on('mon_hoc')
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
        Schema::table('cau_hoi', function($table){
            $table->dropForeign('cau_hoi_mon_hoc_id_foreign');
        });
    }
}
