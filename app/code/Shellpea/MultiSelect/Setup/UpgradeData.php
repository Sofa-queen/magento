<?php

namespace Shellpea\MultiSelect\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            Product::ENTITY,
            'attribute_multiselect',
            [
                'type' => 'text',
                'label' => 'Multiselect Attribute',
                'input' => 'multiselect',
                'global' => Attribute::SCOPE_GLOBAL,
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                'visible' => true,
                'required' => false,
                'visible_on_front' => true,
                'option' => ['values' => [
                    'No',
                    'of course not',
                    'and in any case',
                    ],
                ],
            ]
        );
        $setup->endSetup();
    }
}


