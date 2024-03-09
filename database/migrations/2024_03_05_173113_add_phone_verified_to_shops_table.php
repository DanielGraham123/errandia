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
        if(!Schema::hasColumn('shops', 'street')) {
            Schema::table('shops', function (Blueprint $table) {
                $table->string('street')->nullable();
            });
        }

        if(!Schema::hasColumn('shops', 'phone_verified')) {
            Schema::table('shops', function (Blueprint $table) {
                $table->boolean('phone_verified')->default(0);
            });
        }

        if(Schema::hasColumn('shops', 'street_id')) {
            Schema::table('shops', function (Blueprint $table) {
                $table->dropForeign(['street_id']);
                $table->dropColumn(['street_id']);
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
        if(Schema::hasColumn('shops', 'street')) {
            Schema::table('shops', function (Blueprint $table) {
                $table->dropColumn('street');
            });
        }

        if(Schema::hasColumn('shops', 'phone_verified')) {
            Schema::table('shops', function (Blueprint $table) {
                $table->dropColumn('phone_verified');
            });
        }
    }
}
