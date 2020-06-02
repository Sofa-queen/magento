<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Shellpea\SaveProduct\Observer;

use Magento\Framework\Event\ObserverInterface;

class ControllerSaveProduct implements ObserverInterface
{
    protected $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $values = [];
        $product = $observer->getEvent()->getProduct();
        foreach ($product->getAttributes() as $attribute) {
            $attributes[] = $attribute->getName();
        }

        foreach ($attributes as $attribute) {
            $productName = $product['name'];
            $old = $product->getOrigData($attribute);
            $new = $product->getData($attribute);
            if (!is_array($old) && !is_array($new) && $old !== $new) {
                 $result = " $old => $new ";
                 $this->logger->info($result);
            }
        }
    }
}
