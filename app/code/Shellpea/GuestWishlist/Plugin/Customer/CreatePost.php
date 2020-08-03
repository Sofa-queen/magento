<?php

namespace Shellpea\GuestWishlist\Plugin\Customer;

class CreatePost
{
    protected $customerSession;

    protected $resultFactory;

    protected $redirect;

    private $_wishlist;

    public function __construct(
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Shellpea\GuestWishlist\Model\Wishlist $wishlist
    ) {
        $this->resultFactory = $resultFactory;
        $this->session = $customerSession;
        $this->_redirect = $redirect;
        $this->wishlist = $wishlist;
    }

    public function afterExecute(\Magento\Customer\Controller\Account\CreatePost $subject, $resultRedirect)
    {
        $customerId = $this->session->getCustomerId();
        if ($customerId == null) {
            return $resultRedirect;
        }
        $this->wishlist->addingProductsToTheCustomerWishlist($customerId);

        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());

        return $resultRedirect;
    }
}
