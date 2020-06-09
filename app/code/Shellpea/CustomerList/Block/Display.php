<?php

namespace Shellpea\CustomerList\Block;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Display extends Template
{
    public function __construct(
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        CustomerRepositoryInterface $customerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrder $sortOrder,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->customerRepository = $customerRepository;
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrder = $sortOrder;
    }

    public function getCustomers()
    {
        $filterName = $this->filterBuilder
            ->setField(CustomerInterface::FIRSTNAME)
            ->setConditionType('eq')
            ->setValue('zebra')
            ->create();
        $filterId = $this->filterBuilder
            ->setField(CustomerInterface::EMAIL)
            ->setConditionType('like')
            ->setValue('%com')
            ->create();
        $filterGroup = $this->filterGroupBuilder
            ->setFilters([$filterName, $filterId])
            ->create();
        $searchCriteria = $this->searchCriteriaBuilder
            ->setFilterGroups([$filterGroup])
            ->create();

        $customers = $this->customerRepository->getList($searchCriteria);

        return $customers->getItems();
    }
}
