<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('subscriptions')) {
            Schema::table('subscriptions', function (Blueprint $table) {
                if (Schema::hasColumns('subscriptions', ['status','description','duration','name'])) {
                    $table->dropColumn('description');
                    $table->dropColumn('duration');
                    $table->dropColumn('name');
                }

                $table->integer('plan_id');
                $table->integer('user_id');
                $table->string('status')->default('PENDING')->change();
                $table->timestamp('expired_at')->nullable()->change();
                $table->integer('amount')->default(0)->change();
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
        if(Schema::hasTable('subscriptions')) {
            Schema::table('subscriptions', function (Blueprint $table) {
                if (Schema::hasColumns('subscriptions', ['plan_id','user_id'])) {
                    $table->dropColumn('user_id');
                    $table->dropColumn('plan_id');
                }
            });
        }
    }
}
