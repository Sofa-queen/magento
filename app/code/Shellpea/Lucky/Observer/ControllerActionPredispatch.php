<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Shellpea\Lucky\Observer;

use Magento\Framework\Event\ObserverInterface;


class ControllerActionPredispatch implements ObserverInterface
{
    protected $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)    
    {
        $this->logger = $logger;
    }
    
    public function execute(\Magento\Framework\Event\Observer $observer)
    {      
        //  $myEventData = $observer->getRequest()->getPathInfo();
        //  echo $myEventData;      
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $request = $objectManager->get('Magento\Framework\App\Request\Http');
        $url =  $request->getPathInfo() ;  
	echo $url;
        $this->logger->info($url);	 
    }	    
}
