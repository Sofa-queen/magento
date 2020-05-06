<?php
namespace Shellpea\Hello\Plugin;

class Breadcrumbs
{
    public function beforeAddCrumb( \Magento\Theme\Block\Html\Breadcrumbs $subject, $crumbName, $crumbInfo)
    {
	$crumbInfo['label'] = $crumbInfo['label'].'(!)';
        return [$crumbName, $crumbInfo];
    }
}
