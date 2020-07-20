<?php

namespace Shellpea\GuestWishlist\Block;

class QtyItems extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;
    
    /**
     * @var \Magento\Wishlist\Model\Wishlist
     */
    protected $wishlist;

	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Wishlist\Model\Wishlist $wishlist
    ){
		parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->wishlist = $wishlist;
	}

	public function getQtyItems()
	{
        $customerId = $this->customerSession->getCustomerId();
        $wishlist_id = $this->customerSession->getWishlistId();
        if($customerId != 0) {
           $wishlist = $this->wishlist->loadByCustomerId($customerId, true);
           $wishlist_collection = $wishlist->getItemCollection();

           $a = [];
           foreach ($wishlist_collection as $item) {
                    $proguctName = $item->getProduct()->getName();
                    $a[] = $proguctName;
           }
           return count($a);
        } elseif ($wishlist_id !== null) {
            $wishlist = $this->wishlist->load($wishlist_id);
            $wishlist_collection = $wishlist->getItemCollection();

            $a = [];
            foreach ($wishlist_collection as $item) {
                    $proguctName = $item->getProduct()->getName();
                    $a[] = $proguctName;
            }
            return count($a);
	    }
    }
}
