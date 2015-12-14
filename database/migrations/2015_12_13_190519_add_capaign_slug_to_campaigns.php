<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCapaignSlugToCampaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns', function($table) {
            $table->string('title_slug')->unique();
            $table->string('reply_to');
            $table->string('template');
        });

        Schema::table('emails', function($table) {
            $table->string('salted_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaigns', function($table) {
            $table->dropColumn('title_slug');
            $table->dropColumn('reply_to');
            $table->dropColumn('template');
        });

        Schema::table('emails', function($table) {
            $table->dropColumn('salted_id');
        });
    }
}
