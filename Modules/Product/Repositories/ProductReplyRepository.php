<?php


namespace Modules\Product\Repositories;


use Modules\Product\Entities\ProductReply;

class ProductReplyRepository
{
    protected $replyModel;

    public function __construct(ProductReply $model)
    {
        $this->replyModel = $model;
    }

    public function create(array $reply)
    { 
		return $this->replyModel->create($reply);
    }

    public function findById($reply_id)
    {
        return $this->replyModel->where('id', $reply_id)->with('product', 'user')->first();
    }

    public function update(array $reply, $reply_id)
    {
        return $this->replyModel->find($reply_id)->update($reply);
    }

    public function delete($reply_id)
    {
        return $this->replyModel->find($reply_id)->delete();
    }
	
	public function findByEnquiryId($enquiry_id)
    {
        return  $this->replyModel->all()->where('enquiry_id', $enquiry_id); 
		//return $this->reviewModel->where('product_id', $product_id)->with('product', 'user')->first();
    }	
}
