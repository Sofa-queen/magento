<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Shellpea\GuestWishlist\Model;

class Wishlist extends \Magento\Wishlist\Model\Wishlist
{
    public function loadByCustomerId($customerId, $create = false)
    {
        if ($customerId === null) {
            if (!$this->getId() && $create) {
                $this->setSharingCode($this->_getSharingRandomCode());
                $this->save();
            }
            return $this;
        }
        $customerId = (int)$customerId;
        $customerIdFieldName = $this->_getResource()->getCustomerIdFieldName();
        $this->_getResource()->load($this, $customerId, $customerIdFieldName);
        if (!$this->getId() && $create) {
            $this->setCustomerId($customerId);
            $this->setSharingCode($this->_getSharingRandomCode());
            $this->save();
        }

        return $this;
    }
}
