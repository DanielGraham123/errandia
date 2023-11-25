<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_quotes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('street_id');
            $table->integer('town_id');
            $table->integer('region_id');
            $table->integer('country_id');
            $table->string('title');
            $table->string('description');
            $table->string('slug');
            $table->bigInteger('street_id')->unsigned();
            $table->string('sub_categories');
            $table->boolean('read_status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_quotes');
    }
}
