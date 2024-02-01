<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnWhatsappNumberOnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'whatsapp_number')) {
            Schema::table('users', function (Blueprint $table){
                $table->string('whatsapp_number',  '20')->nullable();
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
        if (Schema::hasColumn('users', 'whatsapp_number')) {
            Schema::table('users', function (Blueprint $table){
                $table->dropColumn('whatsapp_number');
            });
        }
    }
}
