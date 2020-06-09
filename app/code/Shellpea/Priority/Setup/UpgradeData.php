<?php

namespace Shellpea\Priority\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetup;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;
    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
    }
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'priority_att', [
            'type' => 'int',
            'label' => 'Priority',
            'input' => 'select',
            'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
            'frontend_type' => 'select',
            'backend_type' => 'int',
            'is_system' => 0,
            'visible' => true,
            'required' => false,
        ]);
        
        $eavSetup->updateAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'priority_att',
            'source_model',
            'Shellpea\Priority\Model\Attribute\Source\Material'
        );

        $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'priority_att');
        $attribute->setData(
            'used_in_forms',
            ['adminhtml_customer']
        );
        $attribute->save();
        $setup->endSetup();
    }
}
