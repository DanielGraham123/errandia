<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('shop_id');
            $table->integer('description');
            $table->integer('unit_price');
            $table->integer('slug');
            $table->boolean('is_service')->default(false);
            $table->bigInteger('views')->nullable();
            $table->text('search_index')->nullable();
            $table->boolean('status')->default(0);
            $table->string('featured_image');
            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('items');
    }
}
