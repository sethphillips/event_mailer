<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReplyToToTouchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('touches', function($table) {
            $table->string('reply_to_email');
            $table->string('reply_to_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('touches', function($table) {
            $table->dropColumn('reply_to_email');
            $table->dropColumn('reply_to_name');
        });
    }
}
