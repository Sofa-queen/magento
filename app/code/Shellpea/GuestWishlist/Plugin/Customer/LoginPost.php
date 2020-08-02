<?php

namespace Shellpea\GuestWishlist\Plugin\Customer;

class LoginPost
{
    private $wishlist;

    protected $_wishlistRepository;

    protected $_productRepository;

    protected $resultFactory;

    protected $redirect;

    public function __construct(
        \Magento\Wishlist\Model\Wishlist $wishlist,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Wishlist\Model\WishlistFactory $wishlistRepository,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Framework\Controller\ResultFactory $resultFactory
    ) {
        $this->wishlist = $wishlist;
        $this->_productRepository = $productRepository;
        $this->_wishlistRepository= $wishlistRepository;
        $this->session = $customerSession;
        $this->resultFactory = $resultFactory;
        $this->_redirect = $redirect;
    }

    public function afterExecute(\Magento\Customer\Controller\Account\LoginPost $subject)
    {

        $wishlist_id = $this->session->getWishlistId();
        $customer_id = $this->session->getCustomerId();
        $guest_wishlist = $this->wishlist->load($wishlist_id);
        $wishlist_collection = $guest_wishlist->getItemCollection();
        foreach ($wishlist_collection as $item) {
                $productId = $item->getProduct()->getId();
                $product = $this->_productRepository->getById($productId);
                $wishlist = $this->_wishlistRepository->create()->loadByCustomerId($customer_id, true);
                $wishlist->addNewItem($product);
                $wishlist->save();
        }
        $guest_wishlist->delete();

        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
