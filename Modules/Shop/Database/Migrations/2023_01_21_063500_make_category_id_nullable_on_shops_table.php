<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeCategoryIdNullableOnShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('category_id_nullable_on_shops', function (Blueprint $table) {
//            $table->id();
//
//            $table->timestamps();
//        });
        Schema::table('shops', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('category_id_nullable_on_shops');
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->nullable(false)->change();
        });
    }
}
