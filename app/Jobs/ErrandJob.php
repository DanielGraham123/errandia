<?php

namespace App\Jobs;

use App\Repositories\ProductRepository;
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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($documents)
    {
        $this->documents = $documents;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logger()->info("this errand found  " . count($this->documents) . ' item(s)');
        $product_repository = new ProductRepository();
        foreach ($this->documents as $document) {
            $item_id = $document['_source']['id'];
            $item = $product_repository->load_item($item_id);
            if ($item) {
                logger()->info($item->shop->user->id);
                if($item->shop->user && !$item->shop->user->has_active_subscription()) {
                    logger()->warning('user with name '. $item->shop->user->name . ' does not have an active subscription');
                }
            }
        }
    }
}
