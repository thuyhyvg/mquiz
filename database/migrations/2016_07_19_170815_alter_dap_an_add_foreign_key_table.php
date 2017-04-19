<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDapAnAddForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dap_an', function ($table) {
            $table->foreign('cau_hoi_id')
                ->references('id')->on('cau_hoi')
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
        Schema::table('dap_an', function($table){
            $table->dropForeign('dap_an_cau_hoi_id_foreign');
        });
    }
}
