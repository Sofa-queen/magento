<?php

namespace Shellpea\MyController\Controller\Page;

class View extends \Magento\Framework\App\Action\Action
{
    protected $resultRedirect;

    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    protected $resultRawFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\Controller\Result\Redirect $resultRedirect
    ) {
        $this->resultRawFactory = $resultRawFactory;
        $this->resultRedirect = $resultRedirect;
        parent::__construct($context);
    }

    /**
     * View  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $result = $this->resultRawFactory->create();
        $result->setContents('<strong>Hello World</strong>');

        return $this->resultRedirect->setPath('/');
       //return $result;
    }
}
