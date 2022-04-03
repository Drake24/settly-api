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

        try {
            Mail::send('emails.client-lists', ["clients" => $clients], function ($message) {
                // temporarily set my email for testing
                $message->to('paolo.nunal24@gmail.com', 'Weekly Client Lists')->subject('Weekly Client Lists');
                $message->from('settly-test@settly.com', 'No Reply');
            });
        } catch (Exception $e) {
            Log::info('There is something wrong sending email.' . $e);
        }
    }
}
