<?php

namespace Modules\Product\Services;


use Modules\Product\Repositories\ProductEnquiryRepository;

class ProductEnquiryService
{
    private $ProductEnquiryRepository;

    public function __construct(ProductEnquiryRepository $productEnquiryRepository)
    {
        $this->productEnquiryRepository = $productEnquiryRepository;
    }

    public function saveProductEnquiry(array $enquiry)
    {
        return $this->productEnquiryRepository->create($enquiry);
    }

    // SAVE ENQUIRY IMAGES
    public function saveEnquiryImages($enquiry_id, $enquiry_image)
    {
        return $this->productEnquiryRepository->saveEnquiryImage($enquiry_id, $enquiry_image);
    }

    public function findEnquiryById($enquiry_id)
    {
        return $this->productEnquiryRepository->findById($enquiry_id);
    }

    public function updateEnquiry(array $enquiry, $enquiry_id)
    {
        return $this->productEnquiryRepository->update($enquiry, $enquiry_id);
    }

    public function deleteEnquiry($enquiry_id)
    {
        return $this->productEnquiryRepository->delete($enquiry_id);
    }

    public function findEnquiryByProductId($product_id)
    {
        return $this->productEnquiryRepository->findByProductId($product_id);
    }

    public function findUserDetailsByProductId($product_id)
    {
        return $this->productEnquiryRepository->findUserDetailsByProductId($product_id);
    }

    public function getEnquiryImages($enquiry_id)
    {
        return $this->productEnquiryRepository->getEnquiryImages($enquiry_id);
    }

    public function getAllEnquiries()
    {
        return $this->productEnquiryRepository->getAll();
    }

    public function getPaginatedShopEnquiries($shopId)
    {
        return $this->productEnquiryRepository->getPaginatedShopEnquiries($shopId);
    }

    public function getPaginatedUserEnquiries($userId)
    {
        return $this->productEnquiryRepository->getPaginatedUserEnquiries($userId);
    }
}

?>
