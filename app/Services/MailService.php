<?php

namespace App\Services;

use App\Services\ClientService;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

use Log;
use Mail;
use Exception;

class MailService extends Mailable
{
    use Queueable, SerializesModels;

    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Sends client lists weekly.
     *
     * @return void
     */
    public function sendClientListsWeekly(): void
    {
        $clients = $this->clientService->getClientsList();
        Log::info('mailable');
        // Mail is sent through the Mailgun driver. Additional details
        // of configuration is in the .env.example file.
        try {
            Mail::send('emails.client-lists', ["clients" => $clients], function ($message) {
                // temporarily set my email for testing
                // however, changing email will prompt error as this is the only email in the
                // configured in the sandbox.
                $message->to('drakandriel24@gmail.com', 'Weekly Client Lists')->subject('Weekly Client Lists');
                $message->from('settly-test@settly.com', 'No Reply');
            });
            // Sending clients...
            Log::info($clients);
        } catch (Exception $e) {
            Log::info('There is something wrong sending email.' . $e);
        }
    }
}
