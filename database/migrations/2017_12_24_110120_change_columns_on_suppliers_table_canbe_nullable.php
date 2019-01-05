<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsOnSuppliersTableCanbeNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table){
           $table->string('mobile2')->nullable()->change();
           $table->string('email')->nullable()->change();
           $table->text('address')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table){
            $table->string('mobile2')->change();
            $table->string('email')->change();
            $table->text('address')->change();
        });
    }
}
