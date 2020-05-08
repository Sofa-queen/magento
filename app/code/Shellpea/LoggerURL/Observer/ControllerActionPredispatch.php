<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Shellpea\LoggerURL\Observer;

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
        $myEventData = $observer->getRequest()->getPathInfo();
	$this->logger->info($myEventData);
    }	    
}
