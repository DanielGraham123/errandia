<?php


namespace Modules\Product\Services;


use Modules\Product\Repositories\ProductReviewRepository;

class ProductReviewService
{
    private $productReviewRepository;

    public function __construct(ProductReviewRepository $productReviewRepository)
    {
        $this->productReviewRepository = $productReviewRepository;
    }

    public function saveProductReview(array $review)
    {
        return $this->productReviewRepository->create($review);
    }

    // SAVE REVIEW IMAGES
    public function saveReviewImages($review_id, $review_image)
    {
        return $this->productReviewRepository->saveReviewImage($review_id, $review_image);
    }

    public function findReviewById($review_id)
    {
        return $this->productReviewRepository->findById($review_id);
    }

    public function updateReview(array $review, $review_id)
    {
        return $this->productReviewRepository->update($review, $review_id);
    }

    public function deleteReview($review_id)
    {
        return $this->productReviewRepository->delete($review_id);
    }

    public function findReviewByProductId($product_id)
    {
        return $this->productReviewRepository->findByProductId($product_id);
    }

    public function getReviewImages($review_id)
    {
        return $this->productReviewRepository->getReviewImages($review_id);
    }

    public function getAllReviews()
    {
        return $this->productReviewRepository->getAll();
    }

    public function getPaginatedReviewsForShop($shopId)
    {
        return $this->productReviewRepository->getPaginatedReviewsForShop($shopId);
    }

    public function getPaginatedReviewsForUser($userId)
    {
        return $this->productReviewRepository->getPaginatedReviewsForUser($userId);
    }

    public function getProductReviewImagesByIds($reviewIds)
    {
        return $this->productReviewRepository->getProductReviewImagesByIds($reviewIds);
    }
}

