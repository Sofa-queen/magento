<?php

namespace Shellpea\ListProducts\Block;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Display extends Template
{
    
    protected $sortOrder;
    /**
     * Product repository
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * SearchCriteria builder
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * ListProduct constructor
     *
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrder $sortOrder
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrder $sortOrder,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrder = $sortOrder;
    }

    /**
     * Get list of the 5 heaviest products
     *
     * @return ProductInterface[]
     */
    public function getProducts()
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('price', '0', 'gteq')
            ->addFilter('entity_id', 3, 'lteq')
            ->setPageSize(6)
            ->addSortOrder($this->sortOrder->setDirection('DESC')->setField('weight'))
            ->create();
 
        $products = $this->productRepository->getList($searchCriteria);
 
        return $products->getItems();
    }
}
