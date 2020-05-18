<?php
namespace Shellpea\Hello\Plugin;

class ProductInterfaceUpdater
{
    public function afterGetPrice(\Magento\Catalog\Api\Data\ProductInterface $subject, $price)
    {
        return  $price*2 ;
    }
}
