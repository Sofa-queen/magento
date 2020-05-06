<?php
namespace Shellpea\Hello\Plugin;

class ProductInterfaceUpdater
{
    public function afterGetPrice($price)
    {
        return  $price = 899 ;
    }
}
