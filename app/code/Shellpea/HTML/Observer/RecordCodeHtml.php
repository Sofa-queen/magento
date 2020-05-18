<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Shellpea\HTML\Observer;

use Magento\Framework\Event\ObserverInterface;

class RecordCodeHtml implements ObserverInterface
{
    protected $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $response = $observer->getEvent()->getData('response');
        if (!$response) {
            return;
        }
        $body = $response->getBody();
        $this->logger->info($body);
    }
}
