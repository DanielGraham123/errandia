<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Utility\Services\UtilityService;

class SendProductQuoteByEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $quoteNotification;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $notification)
    {
        $this->quoteNotification = $notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UtilityService $utilityService)
    {
        $utilityService->bulkSendEmailsProductCustomQuote($this->quoteNotification['quote'], $this->quoteNotification['emails']);
    }
}
