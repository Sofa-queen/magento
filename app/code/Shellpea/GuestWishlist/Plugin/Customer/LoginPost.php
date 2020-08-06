<?php

namespace Shellpea\GuestWishlist\Plugin\Customer;

class LoginPost extends \Shellpea\GuestWishlist\Helper\GuestWishlist
{
    protected $_productRepository;

    protected $customerSession;

    protected $wishlistFactory;

    protected $resultFactory;

    protected $redirect;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Wishlist\Model\WishlistFactory $wishlistFactory,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->_productRepository = $productRepository;
        $this->wishlistFactory = $wishlistFactory;
        $this->resultFactory = $resultFactory;
        $this->session = $customerSession;
        $this->_redirect = $redirect;
    }

    public function afterExecute(\Magento\Customer\Controller\Account\LoginPost $subject, $resultRedirect)
    {
        $customerId = $this->session->getCustomerId();
        if ($customerId) {
            $this->addingProductsToTheCustomerWishlist($customerId);

            $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());

            return $resultRedirect;
        }
        return $resultRedirect;
    }
}
