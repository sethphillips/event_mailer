<?php

use App\Touch;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTemplateHtmlFieldToTouchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('touches', function($table) {
            $table->text('template_html');
            $table->text('template_text');
            $table->text('preview_text');
        });
        $touches = Touch::all();
        $touches->each(function($touch){
            $html = view("emails.$touch->template")
                        ->with([
                            'salted_id' => null,
                            'campaign' => $touch->campaign,
                            'email' => false
                        ]);
            $text = view("text_emails.$touch->template")->with('campaign',$touch->campaign);
            $touch->template_html = $html;
            $touch->template_text = $text;
            $touch->save();
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
            $table->dropColumn('template_html');
            $table->dropColumn('template_text');
            $table->dropColumn('preview_text');
        });
    }
}
