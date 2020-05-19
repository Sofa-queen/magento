<?php
 
namespace Shellpea\Block\Block;
 
use Magento\Framework\View\Element\AbstractBlock;
 
/**
 * Class Display
 * @package Shellpea\Block\Block
 */
class Display extends AbstractBlock
{
    /**
     * Return the HTML
     * @return string
     */
    protected function _toHtml()
    {
        return 'Today\'s date is ' . date('Y-m-d') . '!';
    }
}
