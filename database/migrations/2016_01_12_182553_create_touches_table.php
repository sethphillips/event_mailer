<?php

use App\Campaign;
use App\Email;
use App\Touch;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTouchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touches',function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->integer('campaign_id')->unsigned();
            $table->string('template');
            $table->string('title_slug');
            $table->string('subject');
            $table->dateTime('send_on');
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('touches');
    }
}
