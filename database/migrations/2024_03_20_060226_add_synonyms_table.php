<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSynonymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if(!Schema::hasTable('synonyms')) {
            Schema::create('synonyms', function (Blueprint $table){
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('values');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if(Schema::hasTable('synonyms')) {
            Schema::dropIfExists('synonyms');
        }
    }
}
