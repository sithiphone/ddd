<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop2columnsFromQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotations', function (Blueprint $table){
           $table->dropColumn('item');
           $table->dropColumn('descript');
           $table->dropColumn('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotations', function (Blueprint $table){
           $table->addColumn('string','item');
           $table->addColumn('text','descript');
           $table->addColumn('integer', 'price');
        });
    }
}
