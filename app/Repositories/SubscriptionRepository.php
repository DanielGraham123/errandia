<?php
namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository {

    public function find_all_by_user($user_id)
    {
        return Subscription::where('user_id', $user_id)
            ->whereIn('status', ['SUCCESS', 'PENDING'])
            ->orderBy('created_at', 'desc')->paginate(15);
    }

    public function save($data)
    {
        $subscription = new Subscription();
        $subscription->plan_id = $data['plan_id'];
        $subscription->user_id = $data['user_id'];
        $subscription->amount  = $data['amount'];
        $subscription->save();
        logger()->info('subscription done');
        return $subscription;
    }

    public function get_current($user_id)
    {
        return Subscription::where(
            'user_id', $user_id
        )->where('status', 'SUCCESS')->orderBy('id', 'desc')->first();
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

    public function chnageStatus($subscription_id, $status, $expired_date = null)
    {
        Subscription::where('id', $subscription_id)->update(['status' => $status, 'expired_at' => $expired_date]);
    }

    public function find($id)
    {
        return Subscription::find($id);
    }
}