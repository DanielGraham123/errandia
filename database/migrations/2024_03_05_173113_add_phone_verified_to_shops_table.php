<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneVerifiedToShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->boolean('phone_verified')->default(0)->after('street');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn('phone_verified');
        });
    }
}
