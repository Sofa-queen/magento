<?php
namespace Shellpea\GuestWishlist\Helper;

class Data extends \Magento\Wishlist\Helper\Data
{
    public function getItemCount()
    {
        $customerId = $this->_customerSession->getCustomerId();
        if ($customerId == null) {
            $wishlistId = $this->_customerSession->getWishlistId();
            $wishlist = $this->wishlistProvider->getWishlist();
            $wishlist_collection = $wishlist->getItemCollection();
            return count($wishlist_collection);
        }
        $storedDisplayType = $this->_customerSession->getWishlistDisplayType();
        $currentDisplayType = $this->scopeConfig->getValue(
            self::XML_PATH_WISHLIST_LINK_USE_QTY,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        $storedDisplayOutOfStockProducts = $this->_customerSession->getDisplayOutOfStockProducts();
        $currentDisplayOutOfStockProducts = $this->scopeConfig->getValue(
            self::XML_PATH_CATALOGINVENTORY_SHOW_OUT_OF_STOCK,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        if (!$this->_customerSession->hasWishlistItemCount() ||
            $currentDisplayType != $storedDisplayType ||
            $this->_customerSession->hasDisplayOutOfStockProducts() ||
            $currentDisplayOutOfStockProducts != $storedDisplayOutOfStockProducts
        ) {
            $this->calculate();
        }

        return $this->_customerSession->getWishlistItemCount();
    }
}
