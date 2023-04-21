<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Twilio\Rest\Client;

class AppointmentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:boot {to} {message}';
    protected $description = 'This command send messages in whatsApp';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $to = $this->argument('to');
        $message = 'ENVIANDO UN MENSAJE CON TAREAS PROGRAMADAS';
        $twilio = new Client($accountSid, $authToken);
        $message = $twilio->messages
        ->create(
            "+525513351820", // to
            array(
                "from" => "+16205539462",
                "body" => $message
            )
        );

            $this->info("WhatsApp message sent to $to");
    }
}
