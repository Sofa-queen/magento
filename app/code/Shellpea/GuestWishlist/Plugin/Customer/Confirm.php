<?php

namespace Shellpea\GuestWishlist\Plugin\Customer;

class Confirm extends \Shellpea\GuestWishlist\Helper\GuestWishlist
{
    protected $_productRepository;                                                                                                     
                                                                                                                                       
    protected $customerSession;                                                                                                        
                                                                                                                                       
    protected $wishlistFactory;                                                                                                        
                                                                                                                                       
    public function __construct(                                                                                                       
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,                                                            
        \Magento\Wishlist\Model\WishlistFactory $wishlistFactory,                                                                      
        \Magento\Customer\Model\Session $customerSession                                                                               
    ) {                                                                                                                                
        $this->_productRepository = $productRepository;                                                                                
        $this->wishlistFactory = $wishlistFactory;                                                                                     
        $this->session = $customerSession;                                                                                             
    }                                                                                                                                  
     
    public function afterExecute(\Magento\Customer\Controller\Account\Confirm $subject, $resultRedirect)
    {
        $customerId = $this->session->getCustomerId();
        $this->addingProductsToTheCustomerWishlist($customerId);

        return $resultRedirect;
    }
}
