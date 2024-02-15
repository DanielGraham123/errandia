<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationFieldsToShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id')->nullable()->after('slug');
            $table->unsignedBigInteger('town_id')->nullable()->after('region_id');
            $table->unsignedBigInteger('street_id')->nullable()->after('town_id');

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('set null');
            $table->foreign('town_id')->references('id')->on('towns')->onDelete('set null');
            $table->foreign('street_id')->references('id')->on('streets')->onDelete('set null');
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
            $table->dropForeign(['region_id']);
            $table->dropForeign(['town_id']);
            $table->dropForeign(['street_id']);
            $table->dropColumn('region_id');
            $table->dropColumn('town_id');
            $table->dropColumn('street_id');
        });
    }
}
