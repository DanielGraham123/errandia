<?php

namespace App\Console\Commands;

use App\Http\Services\MomoService;
use App\Models\ShopSubscription;
use Illuminate\Console\Command;

class SubscriptionPaymentFollower extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription_payment_follower';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Follow payment status of subscription payment requests using the payment_id(transaction_id) of the saved subscription';
    
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
     * @return int
     */
    public function handle()
    {
        ShopSubscription::whereStatus(0)->each(function($record){
            try {
                //code...
                $payment_status = MomoService::getTransactionStatus($record->payment_id);
                if($payment_status['status'] == 'SUCCESSFUL'){
                    $record->update(['status'=>1]);
                }elseif($payment_status['status'] == 'FAILED'){
                    $record->delete();
                }
            } catch (\Throwable $th) {
                return;
            }
        });
        return 0;
    }
}
