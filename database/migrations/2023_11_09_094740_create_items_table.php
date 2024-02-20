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
        if(!Schema::hasTable('items')) {
            Schema::create('items', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->integer('shop_id');
                $table->text('description');
                $table->integer('unit_price');
                $table->integer('slug');
                $table->boolean('is_service')->default(false);
                $table->text('search_index')->nullable();
                $table->text('tags')->nullable();
                $table->boolean('status')->default(0);
                $table->boolean('service')->default(false);
                $table->text('views');
                $table->string('featured_image');
                $table->integer('quantity')->nullable();

                // add category id and its reference
                $table->unsignedBigInteger('category_id')->nullable();
                $table->foreign('category_id')->references('id')->on('categories');

                // add user id and its reference
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users');

                // add reference to images

                $table->timestamps();
                $table->softdeletes();
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
        Schema::dropIfExists('items');
    }
}
