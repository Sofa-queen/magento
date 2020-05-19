<?php
namespace Shellpea\Block\Controller\Index;

class Display extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        //$html = $resultPage->getLayout() ->createBlock('Shellpea\Block\Block\Display') ->toHtml();
        $html = $resultPage->getLayout()
                ->createBlock('Magento\Framework\View\Element\Text')
                ->setText('_/\o-o/\_ Frog')
                ->toHtml();
        $this->getResponse()->setBody($html);
    }
}
