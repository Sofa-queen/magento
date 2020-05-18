<?php

namespace Shellpea\Hello\Plugin\Pricing\Price;

class ConfigurablePriceResolverUpdater
{
    public function afterResolvePrice($price)
    {
        $price = 3456;
            return $price;
    }
}
