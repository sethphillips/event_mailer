<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventInfoToCampaign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns', function($table) {
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('venue');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumn('campaigns', function($table) {
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('venue');
        });
    }
}
