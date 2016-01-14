<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTouchIdToEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emails',function(Blueprint $table){
            $table->integer('touch_id')->unsigned();
        });

        Schema::table('actions',function(Blueprint $table){
            $table->integer('touch_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emails',function(Blueprint $table){
            $table->dropColumn('touch_id');
        });

        Schema::table('actions',function(Blueprint $table){
            $table->dropColumn('touch_id');
        });
    }
}
