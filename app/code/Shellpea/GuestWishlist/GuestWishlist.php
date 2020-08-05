<?php

namespace Shellpea\GuestWishlist\Helper;

class GuestWishlist 
{
    protected $_wishlistRepository;

    protected $_productRepository;

    protected $_customerSession;

    protected $wishlistFactory;

    protected $wishlist;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Wishlist\Model\WishlistFactory $wishlistRepository,
        \Magento\Wishlist\Model\WishlistFactory $wishlistFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Wishlist\Model\Wishlist $wishlist
    ) {
        $this->_productRepository = $productRepository;
        $this->_wishlistRepository= $wishlistRepository;
        $this->wishlistFactory = $wishlistFactory;
        $this->session = $customerSession;
        $this->wishlist = $wishlist;
    }

    public function addingProductsToTheCustomerWishlist($customerId)
    {
        $wishlistId = $this->session->getWishlistId();
        echo $wishlistId . '</br>';
        $wishlist = $this->wishlistFactory->create();
        $wishlist->load($wishlistId);
        echo $wishlist->getId() . '</br>';
        $guestWishlist = $this->wishlist->load($wishlistId);
        echo $guestWishlist->getId();
        $wishlistCollection = $guestWishlist->getItemCollection();
        foreach ($wishlistCollection as $item) {
                 echo 333;
                 $productId = $item->getProduct()->getId();
                 $product = $this->_productRepository->getById($productId);
                 echo $productId . '</br>';
                 $wishlist = $this->_wishlistRepository->create()->loadByCustomerId($customerId, true);
                 echo $wishlist->getId() . '<pre>';
                 $wishlist->addNewItem($product);
                 $wishlist->save();
        }
        $guestWishlist->delete();
        return '';
    }
}

