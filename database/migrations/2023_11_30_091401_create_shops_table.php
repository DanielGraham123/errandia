<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('shops') && Schema::hasTable('regions') && Schema::hasTable('towns') && Schema::hasTable('streets') && Schema::hasTable('users') && Schema::hasTable('categories')) {
            Schema::create('shops', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('description');
//            $table->integer('user_id');
//            $table->integer('category_id')->nullable();
                $table->string('image_path')->nullable();
                $table->boolean('status')->default(0);
                $table->boolean('is_branch')->default(0);
                $table->string('parent_slug')->nullable();
                $table->string('slug');
                $table->string('slogan')->nullable();
                $table->string("street")->nullable();

                $table->unsignedBigInteger('region_id')->nullable();
                $table->unsignedBigInteger('town_id')->nullable();
                $table->unsignedBigInteger('street_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('category_id')->nullable();

                $table->foreign('region_id')->references('id')->on('regions')->onDelete('set null');
                $table->foreign('town_id')->references('id')->on('towns')->onDelete('set null');

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

                $table->softDeletes();
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
        Schema::dropIfExists('shops');
    }
}
