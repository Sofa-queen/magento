<?php

namespace Shellpea\GuestWishlist\Model;

class Wishlist extends \Magento\Wishlist\Model\Wishlist
{
    public function loadWithoutCustomer($create = false)
    {
        if (!$this->getId() && $create) {
            $this->setSharingCode($this->_getSharingRandomCode());
            $this->save();
        }
        return $this;
    }
}
