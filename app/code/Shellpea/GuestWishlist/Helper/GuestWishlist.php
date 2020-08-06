<?php

namespace Shellpea\GuestWishlist\Helper;

class GuestWishlist
{
    public function addingProductsToTheCustomerWishlist($customerId)
    {
        $wishlistId = $this->session->getWishlistId();
        $guestWishlist = $this->wishlistFactory->create()->load($wishlistId);
        $wishlistCollection = $guestWishlist->getItemCollection();
        foreach ($wishlistCollection as $item) {
                 $productId = $item->getProduct()->getId();
                 $product = $this->_productRepository->getById($productId);
                 $wishlist = $this->wishlistFactory->create()->loadByCustomerId($customerId, true);
                 $wishlist->addNewItem($product);
                 $wishlist->save();
        }
        $guestWishlist->delete();
        return '';
    }
}
