<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpiredColumnOnSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('subscriptions', 'expired')) {
            Schema::table('subscriptions', function (Blueprint $table) {
                $table->boolean('expired')->default(false);
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
        if(Schema::hasColumn('subscriptions', 'expired')) {
            Schema::table('subscriptions', function (Blueprint $table) {
                $table->dropColumn('expired');
            });
        }
    }
}
