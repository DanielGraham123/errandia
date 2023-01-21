<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 2/10/2021
 * Time: 10:21 PM
 */

namespace Modules\Shop\Services;


use Modules\Shop\Repositories\ShopRepository;
use Modules\Utility\Services\ImageUploadService;
use function Psy\sh;

class ShopService
{
    protected $shopRepository;
    protected $imageUploadService;

    public function __construct(ShopRepository $shopRepository, ImageUploadService $imageUploadService)
    {
        $this->shopRepository = $shopRepository;
        $this->imageUploadService = $imageUploadService;
    }

    public function saveShop(array $shop)
    {
        //upload shop images
        $shop['image_path'] = $this->imageUploadService->uploadFile($shop, "image_path", "shops");
        return $this->shopRepository->create($shop);
    }

    public function findShopById($shop_id)
    {
        return $this->shopRepository->findById($shop_id);
    }

    public function findShopBySlug($slug)
    {
        return $this->shopRepository->findBySlug($slug);
    }

    public function updateShopInfo($shop_id, array $shop)
    {
        $shop_image = $shop['image_path'] === "" ? "" : $this->imageUploadService->uploadFile($shop, "image_path", "shops");
        if ($shop_image === "") {
            //unset the featured_image_path
            unset($shop['image_path']);
        } else {
            $shop['image_path'] = $shop_image;
            //delete previous file from filesystem
            $shop_image_path = $this->shopRepository->findById($shop_id)->image_path;
            $this->imageUploadService->deleteFile($shop_image_path);
        }
        return $this->shopRepository->update($shop_id, $shop);
    }

    public function deleteShop($shop_id)
    {
        return $this->shopRepository->delete($shop_id);
//        //check if shop has products already
//        $shopProductCount = collect($this->shopRepository->getProductsByShop($shop_id))->count();
//        //delete if no product exist
//        return $shopProductCount > 0 ? false : $this->shopRepository->delete($shop_id);
    }

    public function getProductsByShop($shop_id)
    {
        return $this->shopRepository->getProductsByShop($shop_id);
    }

    public function saveShopBusinessRegistrationInfo($shop_id, array $reg_info)
    {
        return $this->shopRepository->saveShopRegistrationInfo($shop_id, $reg_info);
    }
    public function getShopBusinessRegistrationInfo($shop_id)
    {
        return $this->shopRepository->getShopRegistrationInfo($shop_id);
    }

    public function saveShopBusinessProfile($shop_id, array $profile)
    {
        return $this->shopRepository->saveShopBusinessProfile($shop_id, $profile);
    }

    public function getShopBusinessProfile($shop_id)
    {
        return $this->shopRepository->getShopBusinessProfile($shop_id);
    }

    public function saveShopContactInfo($shop_id, array $contact)
    {
        return $this->shopRepository->saveShopContactInfo($shop_id, $contact);
    }

    public function updateShopContactInfo($shop_contact_id, $contact)
    {
        return $this->shopRepository->updateShopContactInfo($shop_contact_id, $contact);
    }

    public function getShopContactInfo($shop_id)
    {
        return $this->shopRepository->getShopContactInfo($shop_id);
    }

    public function getShopSubscribers($shop_id)
    {
        return $this->shopRepository->getAllShopSubscribers($shop_id);
    }

    public function getPaginatedUserShopSubscription($userId)
    {
        return $this->shopRepository->getPaginatedUserShopSubscription($userId);
    }

    public function isUserSubscribedShop($user_id, $shop_id)
    {
        return $this->shopRepository->findShopSubscriptionByUserId($user_id, $shop_id);
    }

    public function subscribeShopNotification(array $subscription)
    {
        //check if user had subscribed before
        if ($this->shopRepository->findShopSubscriptionByUserId($subscription['user_id'], $subscription['shop_id'])->isEmpty()) {
            return $this->shopRepository->subscribeToShopNotification($subscription);
        }
        return null;
    }

    public function unSubscribeToShopNotification($user_id, $shop_id)
    {
        return $this->shopRepository->unSubscribeToShopNotification($user_id, $shop_id);
    }
    public function saveShopCategories($shopId,$categories){
        return $this->shopRepository->saveShopCategories($shopId, $categories);
    }

    public function getActiveShops()
    {
        return $this->shopRepository->getAll();
    }

    public function savePackageSubscription(array $subscriptionDatails)
    {
        return $this->shopRepository->savePackageSubscriptionInfo($subscriptionDatails);
    }

    public function updateShopSubscription($subscriptionId, array $subscription)
    {
        return $this->shopRepository->updateShopSubscription($subscriptionId, $subscription);
    }

    public function getShopSubscription()
    {
        return $this->shopRepository->getShopSubcription();
    }

    public function getPaginatedProductsByShop($shop_id)
    {
        return $this->shopRepository->getPaginatedProductsByShop($shop_id);
    }


    public function hasActiveSubscriptionShop($shopId)
    {
        return $this->shopRepository->hasActiveSubscriptionShop($shopId);
    }
}
