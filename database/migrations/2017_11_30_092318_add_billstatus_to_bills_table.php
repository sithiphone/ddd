<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBillstatusToBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bills', function (Blueprint $table){
            $table->addColumn('integer','status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('bill_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bills', function (Blueprint $table){
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });
    }
}
