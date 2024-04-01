<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemQuotesSentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('item_quotes_sent')) {
            Schema::create('item_quotes_sent', function (Blueprint $table){
                $table->increments('id');
                $table->integer('item_quote_id');
                $table->integer('item_id');
                $table->timestamps();
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
        if(Schema::hasTable('item_quotes_sent')) {
            Schema::dropIfExists('item_quotes_sent');
        }
    }
}
