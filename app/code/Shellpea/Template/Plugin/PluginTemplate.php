<?php
 
namespace Shellpea\Template\Plugin;
 
class PluginTemplate
{

    public function beforeSetTemplate(\Magento\Catalog\Block\Product\View\Description $subject, $template)
    {
        return $template = 'Shellpea_Template::sayhello.phtml';
    }
}
