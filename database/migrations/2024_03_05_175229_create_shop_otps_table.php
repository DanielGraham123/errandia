<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopOtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if (!Schema::hasTable('shop_otps')) {
            Schema::create('shop_otps', function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->string('code');
                $table->integer('shop_id');
                $table->boolean('verified')->default(false);
                $table->timestamp('expired_date');
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
        Schema::table('shop_otps', function (Blueprint $table) {
            Schema::dropIfExists('shop_otps');
        });
    }
}
