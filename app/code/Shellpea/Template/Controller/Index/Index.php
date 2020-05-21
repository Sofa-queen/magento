<?php
namespace Shellpea\Template\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;

    protected $resultRaw;

    protected $layoutFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\Raw $resultRaw,
        \Magento\Framework\View\LayoutFactory $layoutFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultRaw = $resultRaw;
        $this->layoutFactory = $layoutFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->layoutFactory->create()
                ->createBlock('Shellpea\Template\Block\Index')
                ->setTemplate('Shellpea_Template::sayhello.phtml')
                ->toHtml();
        return $this->resultRaw->setContents($result);
    }
}
