<?php
namespace Shellpea\GuestWishlist\Block\Customer;

class Wishlist extends \Magento\Wishlist\Block\Customer\Wishlist
{
    protected function _toHtml()
    {
        if (!$this->getTemplate()) {
            return '';
        }
        return $this->fetchView($this->getTemplateFile());
    }
}
