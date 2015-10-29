<?php

use App\Campaign;
use App\Client;
use App\Contact;
use App\Email;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(CampaignSeeder::class);
        // $this->call(ContactSeeder::class);
        // $this->call(EmailSeeder::class);

        Model::reguard();
    }
}


class UserTableSeeder extends Seeder{


    public function run()
    {

        $client = Client::create([
            'name'=>'Exhibit Partners',
            'address' => '7700 68th Ave N',
            'city' => 'Minneapolis',
            'state' => 'MN',
            'zip' => '55428',
            ]);

        User::create([
            'name' => 'Bill Gench',
            'email' =>  'bill@exhibitpartners.com',
            'client_id' => $client->id,
            'password' => bcrypt('trms'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Seth Phillips',
            'email' =>  'seth.phillips@trms.com',
            'client_id' => $client->id,
            'password' => bcrypt('trms'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Debs Holloway',
            'email' =>  'DebS@exhibitpartners.com',
            'client_id' => $client->id,
            'password' => bcrypt('trms'),
            'is_admin' => true,
        ]);
    }
}

class CampaignSeeder extends Seeder{

    public function run()
    {
        $client = Client::where('name','=','Exhibit Partners')->first();

        Campaign::create([
            'name' => 'Halloween Video',
            'event_date' => Carbon::parse('October 31st 2015'),
            'client_id' => $client->id,
        ]);
    }
}

class ContactSeeder extends Seeder{

    public function run()
    {
        $client = Client::where('name','=','Exhibit Partners')->first();

        Contact::create([
            'first_name' => 'Seth Cindra',

            'email' => 'info@cindra.net',
            'client_id' => $client->id,
        ]);

        Contact::create([
            'first_name' => 'Seth TRMS',
            'email' => 'seth.phillips@trms.com',
            'client_id' => $client->id,
        ]);

        Contact::create([
            'first_name' => 'Seth BlackKat',
            'email' => 'black_kat_recording@yahoo.com',
            'client_id' => $client->id,
        ]);

        Contact::create([
            'first_name' => 'Dane Giles',
            'email' => 'dane@exhibitpartners.com',
            'client_id' => $client->id,
        ]);

        Contact::create([
            'first_name' => 'Bill Gench',
            'email' => 'bill@exhibitpartners.com',
            'client_id' => $client->id,
        ]);

        Contact::create([
            'name' => 'Debs Holloway',
            'email' => 'DebS@exhibitpartners.com',
            'client_id' => $client->id,
        ]);

    }
}


class EmailSeeder extends Seeder{

    public function run()
    {

        $contacts = Contact::all();
        $campaign = Campaign::where('name','=','Halloween Video')->first();

        foreach ($contacts as $contact) {
            Email::create([
                'send_on' => Carbon::now()->addMinutes(5),
                'template' => 'emails.halloween',
                'subject' => 'Happy Halloween!',
                'draft' => false,
                'campaign_id' => $campaign->id,
                'contact_id' => $contact->id,
            ]);
        }
    }
}



