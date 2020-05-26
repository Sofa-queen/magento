<?php

namespace Shellpea\ActionName\Block;

class Index extends \Magento\Framework\View\Element\Template
{

    public function actionName()
    {
        return $this->getRequest()->getFullActionName();
    }
}
