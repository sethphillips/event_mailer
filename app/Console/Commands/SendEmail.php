<?php

namespace App\Console\Commands;

use App\Email;
use Illuminate\Console\Command;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Ready & Published Emails';

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
        $emails = Email::published()->unsent()->ready()->get();

        foreach ($emails as $email) {
            $email->send();
            $this->info("Sent email to ".$email->contact->name);
        }

        $this->info('Done Sending Emails');
    }
}
