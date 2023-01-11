<?php

namespace Modules\Product\Services;


use Modules\Product\Repositories\ProductQuoteRepository;

class ProductQuoteService
{
    private $ProductQuoteRepository;

    public function __construct(ProductQuoteRepository $ProductQuoteRepository)
    {
        $this->ProductQuoteRepository = $ProductQuoteRepository;
    }

    public function saveProductQuote(array $quote)
    {
        return $this->ProductQuoteRepository->create($quote);
    }

    // SAVE PRODUCT QUOTE IMAGES
    public function saveQuoteImages($quote_id, $quote_image)
    {
        return $this->ProductQuoteRepository->saveQuoteImage($quote_id, $quote_image);
    }

    public function findQuoteById($quote_id)
    {
        return $this->ProductQuoteRepository->findById($quote_id);
    }
    public function findDeletedQuoteById($quote_id)
    {
        return $this->ProductQuoteRepository->findDeletedById($quote_id);
    }

    public function updateQuote(array $quote, $quote_id)
    {
        return $this->ProductQuoteRepository->update($quote, $quote_id);
    }

    public function deleteQuote($quote_id)
    {
        return $this->ProductQuoteRepository->delete($quote_id);
    }

    public function findQuoteByProductId($product_id)
    {
        return $this->ProductQuoteRepository->findByProductId($product_id);
    }

    public function findUserDetailsByProductId($product_id)
    {
        return $this->ProductQuoteRepository->findUserDetailsByProductId($product_id);
    }

    public function findQuoteBySlugUrl($slug)
    {
        return $this->ProductQuoteRepository->findQuoteBySlugUrl($slug);
    }

    public function getQuoteImages($quote_id)
    {
        return $this->ProductQuoteRepository->getQuoteImages($quote_id);
    }

    public function getAllQuotes()
    {
        return $this->ProductQuoteRepository->getAll();
    }

    public function getAllShopProductQuotes($shopId)
    {
        return $this->ProductQuoteRepository->getAllShopProductQuotes($shopId);
    }

    public function getPaginatedUserProductQuotes($userId)
    {
        return $this->ProductQuoteRepository->getPaginatedUserProductQuotes($userId);
    }
}

?>
