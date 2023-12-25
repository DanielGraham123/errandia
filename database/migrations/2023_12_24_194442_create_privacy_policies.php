<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivacyPolicies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('privacy_policies')) {
            Schema::create('privacy_policies', function (Blueprint $table) {
                $table->id();
                $table->string('title', 254);
                $table->string('slug', 200);
                $table->mediumText('content');
                $table->timestamps();
                $table->unique(['title', 'slug']);
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
        if (Schema::hasTable('privacy_policies')) {
            Schema::dropIfExists('privacy_policies');
        }
    }
}
