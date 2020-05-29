<?php

namespace Shellpea\Stores\Block;

class Index extends \Magento\Framework\View\Element\Template
{

    protected $categoryFactory;

    protected $storeManager;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->_categoryFactory = $categoryFactory;
        parent::__construct($context, $data);
    }
    
    public function getStores()
    {
        $storeManagerDataList = $this->_storeManager->getStores();
        $options = [];
        foreach ($storeManagerDataList as $store) {
              $category = $this->_categoryFactory->create()->load($store->getRootCategoryId());
              $storeName = $store->getName();
              $categoryName =  $category->getName();
              $options[] = 'store_name:' . ' ' . $storeName . '<br>' . 'category_name:' . ' ' . $categoryName . '<br>';

        }
        return $options;
    }
}
