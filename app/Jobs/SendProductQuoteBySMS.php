<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\Utility\Services\UtilityService;

class SendProductQuoteBySMS implements ShouldQueue
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
        $utilityService->sendSMS($this->quoteNotification['message'], $this->quoteNotification['contacts']);
    }
}
