<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopRegistrationInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_registration_info', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id');
            $table->date('registration_date');
            $table->string('registration_number');
            $table->string('tax_payer_number');
            $table->string('tax_payer_doc_path');
            $table->string('years_of_existence');
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
        Schema::dropIfExists('shop_registration_info');
    }
}
