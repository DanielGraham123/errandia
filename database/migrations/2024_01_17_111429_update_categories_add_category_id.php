<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCategoriesAddCategoryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasColumn('categories', 'category_id')){
            Schema::table('categories', function(Blueprint $table){
                $table->integer('category_id')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('categories', 'category_id')){
            Schema::table('categories', function(Blueprint $table){
                $table->dropColumn('category_id');
            });
        }
    }
}
