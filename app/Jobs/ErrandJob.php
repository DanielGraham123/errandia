<?php

namespace App\Jobs;

use App\Models\Errand;
use App\Models\ErrandItem;
use App\Notifications\UserNotification;
use App\Repositories\ProductRepository;
use App\Repositories\UserDeviceRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ErrandJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $documents;
    private Errand $errand;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($documents, Errand $errand)
    {
        $this->documents = $documents;
        $this->errand = $errand;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $product_repository = new ProductRepository();
        $user_excluded = [];
        $users_to_notify = [];
        foreach ($this->documents as $document) {
            $item_id = $document['_source']['id'];
            $item = $product_repository->load_item($item_id);
            if ($item) {
                if(in_array($item->shop->user->id, $user_excluded) !== false) {
                    continue;
                }

                if($item->shop->user && $item->shop->user->has_active_subscription()) {
                    // No sent notifications to owners to businesses who create errands
                    // that match
                    if($item->shop->user->id != $this->errand->user->id) {
                        $errandItem = ErrandItem::where('item_quote_id', $this->errand->id)
                            ->where('item_id', $item_id)->first();
                        if(!$errandItem) {
                            ErrandItem::create([
                                'item_quote_id' => $this->errand->id,
                                'item_id' => $item_id
                            ]);
                            logger()->info("errand item record added");

                            if(in_array($item->shop->user->id, $users_to_notify) === false) {
                                $users_to_notify[] = $item->shop->user->id;
                            }
                        }
                    }
                } else {
                    $user_excluded [] = $item->shop->user->id;
                    logger()->debug("user id : " . $item->shop->user->id . ' does not have an active subscription');
                }
            }
        }

        if(!empty($users_to_notify)) {
            $this->send_notifications($users_to_notify);
        }
    }

    private function send_notifications($user_ids): void
    {
        // send push notifications to the business owner to let him
        // that somebody is looking for a products or services which
        // match with his criteria
        foreach ($user_ids as $user_id) {
            $user_device = UserDeviceRepository::getDevice($user_id);
            if($user_device) {
                $user_device->notify(new UserNotification(
                    'Errandia',
                    'A user created an errand which<br/>matches with your offers'
                ));
                logger()->info("A push notification sent to the business owner");
            }
        }

    }
}
