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

    protected $_urlInterface;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Wishlist\Model\Wishlist $wishlist
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->_urlInterface = $urlInterface;
        $this->wishlist = $wishlist;
    }

    public function getHref()
    {
        return $this->_urlInterface->getUrl('wishlist');
    }

    public function getQtyItems()
    {
        $customerId = $this->customerSession->getCustomerId();
        $wishlist_id = $this->customerSession->getWishlistId();
        if ($customerId != 0) {
            $wishlist = $this->wishlist->loadByCustomerId($customerId, true);
            $wishlist_collection = $wishlist->getItemCollection();

            $a = [];
            foreach ($wishlist_collection as $item) {
                    $proguctQty = $item->getQty();
                    $a[] = $proguctQty;
            }
            return array_sum($a);
        } elseif ($wishlist_id !== null) {
            $wishlist = $this->wishlist->load($wishlist_id);
            $wishlist_collection = $wishlist->getItemCollection();

            $a = [];
            foreach ($wishlist_collection as $item) {
                    $proguctQty = $item->getQty();
                    $a[] = $proguctQty;
            }
            return array_sum($a);
        }
    }
}
