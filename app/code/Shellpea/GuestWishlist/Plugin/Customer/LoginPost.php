<?php

namespace Shellpea\GuestWishlist\Plugin\Customer;

class LoginPost extends \Shellpea\GuestWishlist\Helper\GuestWishlist
{
    protected $customerSession;

    protected $resultFactory;

    protected $redirect;

    public function __construct(
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->resultFactory = $resultFactory;
        $this->session = $customerSession;
        $this->_redirect = $redirect;
    }

    public function afterExecute(\Magento\Customer\Controller\Account\LoginPost $subject, $resultRedirect)
    {
        $customerId = $this->session->getCustomerId();
        if($customerId) {
           $this->addingProductsToTheCustomerWishlist($customerId);

           $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
           $resultRedirect->setUrl($this->_redirect->getRefererUrl());

           return $resultRedirect;
        }
        return $resultRedirect;
    }
}
