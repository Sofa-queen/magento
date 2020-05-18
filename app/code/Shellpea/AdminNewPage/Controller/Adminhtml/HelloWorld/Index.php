<?php
namespace Shellpea\AdminNewPage\Controller\Adminhtml\HelloWorld;

class Index extends \Magento\Backend\App\AbstractAction
{
    protected $resultRaw;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\Raw $resultRaw
    ) {
        $this->resultRaw = $resultRaw;
        return parent::__construct($context);
    }

    protected function _isAllowed()
    {
        $param = $this->_request->getParam('secret');
        if (!($param == 1)) {
            return false;
        }
      
        return $this->_authorization->isAllowed('Shellpea_AdminNewPage::helloworld');
    }

    public function execute()
    {
        return $this->resultRaw->setContents('Welcome to my Admin Controller! 0~0 ');
    }
}
