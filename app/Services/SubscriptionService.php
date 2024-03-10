<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;

class SubscriptionService{
    private SubscriptionRepository $subscriptionRepository;


    public function __construct(SubscriptionRepository $subscriptionRepository){
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function find_all_by_user($user_id)
    {
        return $this->subscriptionRepository->find_all_by_user($user_id);
    }

    public function save($data)
    {
    }

    public function get_current($user_id)
    {
        return $this->subscriptionRepository->get_current($user_id);
    }

    public function mark_as_expired($id)
    {
        $this->subscriptionRepository->set_as_expired($id);
    }

}