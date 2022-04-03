<?php

namespace App\Console\Commands;

use App\Services\MailService;

use Illuminate\Console\Command;

use Log;

class WeeklyClientLists extends Command
{
    protected $signature = 'clients:weekly';

    protected $description = 'Gets all the client lists weekly.';

    protected $mailService;

    public function __construct(MailService $mailService)
    {
        parent::__construct();

        $this->mailService = $mailService;
    }

    /**
     * Gets all the client lists and sends it via
     * email address.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->mailService->sendClientListsWeekly();
    }
}
