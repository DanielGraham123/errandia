<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordResetExpireAtColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('password_resets', 'expire_at')) {
            Schema::table('password_resets', function (Blueprint $table) {
                $table->timestamp('expire_at');
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
        Schema::table('password_resets', function(Blueprint $table){
            $table->dropColumn('expire_at');
        });
    }
}
