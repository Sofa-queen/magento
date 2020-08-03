<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Shellpea\GuestWishlist\Model;

class Wishlist extends \Magento\Wishlist\Model\Wishlist
{
    protected $_wishlistRepository;

    protected $_productRepository;

    protected $_customerSession;

    private $wishlist;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Wishlist\Model\WishlistFactory $wishlistRepository,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Wishlist\Model\Wishlist $wishlist
    ) {
        $this->_productRepository = $productRepository;
        $this->_wishlistRepository= $wishlistRepository;
        $this->session = $customerSession;
        $this->wishlist = $wishlist;
    }

    public function loadWithoutCustomer($create = false)
    {
        if (!$this->getId() && $create) {
            $this->setSharingCode($this->_getSharingRandomCode());
            $this->save();
        }
        return $this;
    }

    public function addingProductsToTheCustomerWishlist($customerId)
    {
        $wishlistId = $this->session->getWishlistId();
        $guestWishlist = $this->wishlist->load($wishlistId);
        $wishlistCollection = $guestWishlist->getItemCollection();
        foreach ($wishlistCollection as $item) {
                 $productId = $item->getProduct()->getId();
                 $product = $this->_productRepository->getById($productId);
                 $wishlist = $this->_wishlistRepository->create()->loadByCustomerId($customerId, true);
                 $wishlist->addNewItem($product);
                 $wishlist->save();
        }
        $guestWishlist->delete();
    }
}
