<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Shellpea\GuestWishlist\Controller;

/**
 * WishlistProvider Controller
 *
 * @SuppressWarnings(PHPMD.CookieAndSessionMisuse)
 */
class WishlistProvider extends \Magento\Wishlist\Controller\WishlistProvider
{
    public function __construct(
        \Magento\Wishlist\Model\WishlistFactory $wishlistFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\App\RequestInterface $request
    ) {
        parent::__construct(
            $wishlistFactory,
            $customerSession,
            $messageManager,
            $request
        );
    }

    public function getWishlist($wishlistId = null)
    {
        if ($this->wishlist) {
            return $this->wishlist;
        }
        try {
            if (!$wishlistId) {
                $wishlistId = $this->request->getParam('wishlist_id');
            }
            $customerId = $this->customerSession->getCustomerId();
            $wishlist = $this->wishlistFactory->create();

            if (!$wishlistId && !$customerId) {
                if ($this->customerSession->getWishlistId() == null) {
                    $wishlist->loadWithoutCustomer(true);
                    $wishlist_id = $wishlist->getId();
                    $this->customerSession->setWishlistId($wishlist_id);
                } else {
                    $wishlist_id = $this->customerSession->getWishlistId();
                    $wishlist->load($wishlist_id);
                }
            }

            if ($wishlistId) {
                $wishlist->load($wishlistId);
            } elseif ($customerId) {
                $wishlist->loadByCustomerId($customerId, true);
            }

            if (!$wishlist->getId()) {
                throw new \Magento\Framework\Exception\NoSuchEntityException(
                    __('The requested Wish List doesn\'t exist.')
                );
            }
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return false;
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('We can\'t create the Wish List right now.'));
            return false;
        }
        $this->wishlist = $wishlist;
        return $wishlist;
    }
}
