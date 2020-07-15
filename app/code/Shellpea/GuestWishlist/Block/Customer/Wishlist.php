<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @author     Magento Core Team <core@magentocommerce.com>
 */
namespace Shellpea\GuestWishlist\Block\Customer;

/**
 * Wishlist block customer items.
 *
 * @api
 * @since 100.0.2
 */
class Wishlist extends \Magento\Wishlist\Block\Customer\Wishlist
{
    /**
     * @inheritdoc
     */
    protected function _toHtml()
    {
        if (!$this->getTemplate()) {
            return '';
        }
        return $this->fetchView($this->getTemplateFile());
    }
}

