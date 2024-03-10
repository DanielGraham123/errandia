<?php
namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository {

    public function find_all_by_user($user_id)
    {
        return Subscription::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(15);
    }

    public function save($data)
    {
        $subscription = new Subscription();
        $subscription->plan_id = $data['plan_id'];
        $subscription->user_id = $data['user_id'];
        $subscription->status = true;
        $subscription->expired_at = $data['expired_at'];
        $subscription->save();
        logger()->info('subscription done');
    }

    public function get_current($user_id)
    {
        return Subscription::where(
            'user_id', $user_id
        )->where('status', true)->first();
    }

    public function set_as_expired($id)
    {
        $subscription = Subscription::find($id);
        if ($subscription) {
            $subscription->status = 0;
            $subscription->save();
            logger()->info("subscription marked as expired");
        }
    }
}