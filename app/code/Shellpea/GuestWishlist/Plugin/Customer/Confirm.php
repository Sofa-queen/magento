<?php

namespace Shellpea\GuestWishlist\Plugin\Customer;

class Confirm
{
    protected $customerSession;

    protected $_wishlist;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Shellpea\GuestWishlist\Model\Wishlist $wishlist
    ) {
        $this->session = $customerSession;
        $this->wishlist = $wishlist;
    }

    public function afterExecute(\Magento\Customer\Controller\Account\Confirm $subject, $resultRedirect)
    {
        $customerId = $this->session->getCustomerId();
        $this->wishlist->addingProductsToTheCustomerWishlist($customerId);

        return $resultRedirect;
    }
}
