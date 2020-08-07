<?php

namespace Shellpea\GuestWishlist\Block;

class GuestWishlistLink extends \Magento\Framework\View\Element\Template
{
    protected $customerSession;
    
    protected $_urlInterface;

    protected $wishlist;

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

    public function getLabel()
    {
        return __('My Guest Wish List');
    }

    public function getHref()
    {
        return $this->_urlInterface->getUrl('wishlist');
    }

    public function getWishlistQty()
    {
        $customerId = $this->customerSession->getCustomerId();
        $wishlistId = $this->customerSession->getWishlistId();
        if ($customerId != 0) {
            $wishlist = $this->wishlist->loadByCustomerId($customerId, true);
            return  $this->getQtyProductsInWishlist($wishlist);
        } elseif ($wishlistId !== null) {
            $wishlist = $this->wishlist->load($wishlistId);
            return $this->getQtyProductsInWishlist($wishlist);
        }
    }
    public function getQtyProductsInWishlist($wishlist)
    {
        $wishlistCollection = $wishlist->getItemCollection();
        $qtyProductsInWishlist = [];
        foreach ($wishlistCollection as $item) {
                 $qtyProductsInWishlist[] = $item->getId();
        }
        return count($qtyProductsInWishlist);
    }
}
