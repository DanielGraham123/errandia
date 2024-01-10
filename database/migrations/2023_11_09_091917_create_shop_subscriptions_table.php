<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('shops_subscriptions')){
            Schema::create('shops_subscriptions', function (Blueprint $table) {
                $table->id();
                $table->integer('shop_id');
                $table->integer('subscription_id');
                $table->date('subscription_date');
                $table->date('expiration_date');
                $table->boolean('status')->default(false);
                $table->string('payment_id');
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
        Schema::dropIfExists('shops_subscriptions');
    }
}
