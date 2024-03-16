<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTablePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table){
                $table->id();
                $table->integer('subscription_id');
                $table->integer('user_id');
                $table->string('payment_ref')->unique();
                $table->string('request_id')->nullable();
                $table->string('phone_number');
                $table->integer('amount');
                $table->string('status')->default('PENDING');
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
        if(Schema::hasTable('payments')) {
           Schema::dropIfExists('payments');
        }
    }
}
