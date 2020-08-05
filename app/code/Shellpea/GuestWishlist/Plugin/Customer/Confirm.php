<?php

namespace Shellpea\GuestWishlist\Plugin\Customer;

class Confirm extends \Shellpea\GuestWishlist\Helper\GuestWishlist
{
    protected $customerSession;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->session = $customerSession;
    }

    public function afterExecute(\Magento\Customer\Controller\Account\Confirm $subject, $resultRedirect)
    {
        $customerId = $this->session->getCustomerId();
        $this->addingProductsToTheCustomerWishlist($customerId);

        return $resultRedirect;
    }
}
