<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChengeAdsCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads_category', function (Blueprint $table) {
            //
            
            $table->integer('ads_id')->unsigned()->default(1);
            $table->foreign('ads_id')->references('id')->on('ads');
            
            
            $table->integer('category_id')->unsigned()->default(1);
            $table->foreign('category_id')->references('id')->on('categories');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads_category', function (Blueprint $table) {
            //
        });
    }
}
