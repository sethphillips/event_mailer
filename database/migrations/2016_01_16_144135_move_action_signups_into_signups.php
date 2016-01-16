<?php

use App\Action;
use App\Signup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MoveActionSignupsIntoSignups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $actions = Action::where('action','signed up')->get();

        foreach ($actions as $action) {
            Signup::firstOrCreate([
                'campaign_id' => $action->campaign_id,
                'contact_id' => $action->contact_id,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
