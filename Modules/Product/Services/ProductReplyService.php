<?php

namespace Modules\Product\Services;


use Modules\Product\Repositories\ProductReplyRepository;

class ProductReplyService
{
    private $ProductReplyRepository;

    public function __construct(ProductReplyRepository $productReplyRepository)
    {
        $this->productReplyRepository = $productReplyRepository;
    }

    public function saveEnquiryReply(array $reply)
    {
        return $this->productReplyRepository->create($reply);
    }

    public function findReplyById($enquiry_id)
    {
        return $this->productReplyRepository->findById($enquiry_id);
    }

    public function updateReply(array $enquiry, $enquiry_id)
    {
        return $this->productReplyRepository->update($enquiry, $enquiry_id);
    }

    public function deleteReply($enquiry_id)
    {
        return $this->productReplyRepository->delete($enquiry_id);
    }
	
	 public function findByEnquiryId($enquiry_id)
    {
        return $this->productReplyRepository->findByEnquiryId($enquiry_id);
    }
}
?>
