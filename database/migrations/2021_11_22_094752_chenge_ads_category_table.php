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
            $table->foreign('ads_id')->references('id')->on('ads')->onDelete('cascade');
            
            
            $table->integer('category_id')->unsigned()->default(1);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
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
