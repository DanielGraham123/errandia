<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnShowContactDetailsToStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('item_quotes_sent', 'show_contact_details')) {
            Schema::table('item_quotes_sent', function (Blueprint $table) {
                $table->renameColumn('show_contact_details', 'rejected');
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
        if(Schema::hasColumn('item_quotes_sent', 'rejected')) {
            Schema::table('item_quotes_sent', function (Blueprint $table) {
                $table->renameColumn('rejected', 'show_contact_details');
            });
        }
    }
}
