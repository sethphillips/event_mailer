<?php

namespace App\Console\Commands;

use App\Contact;
use App\Email;
use Illuminate\Console\Command;

class CheckBounces extends Command
{
    private $count = 0;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:bounced';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check contacts for bounces';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        

        $username = "api";
        $password = config('services.mailgun.secret');
        $domain = config('services.mailgun.domain');
        $remote_url = "https://api.mailgun.net/v3/$domain/bounces?limit=20000";

        $process = curl_init($remote_url);
        curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($process, CURLOPT_RETURNTRANSFER,true);
        $return = curl_exec($process);
        curl_close($process);
        $bounces = json_decode($return);

        if(isset($bounces->items))
        {
     
            if(count($bounces->items))
            {
                $this->processBounces($bounces->items);
            }
        }

        

        $this->info("$this->count emails bounced");
    }

    private function processBounces($bounces)
    {
        foreach ($bounces as $bounce) {
            $email = $bounce->address;
            $contact = Contact::where('email','=',$email)->where('bounced','=',0)->first();
            if($contact)
            {
                $contact->bounced = true;
                $contact->save();
                $this->count += 1;
            }
        }
    }
}
