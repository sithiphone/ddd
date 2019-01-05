<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bills', function (Blueprint $table){
            $table->text('ship_place');
            $table->integer('warranty');
            $table->dateTime('ship_date');
            $table->dateTime('pay_date');
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
            $table->dropColumn('ship_place');
            $table->dropColumn('warranty');
            $table->dropColumn('ship_date');
            $table->dropColumn('pay_date');
        });
    }
}
