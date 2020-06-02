<?php

namespace Shellpea\MyTable\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddAttribute implements DataPatchInterface
{
   /** @var ModuleDataSetupInterface */
    private $moduleDataSetup;

   /**
    * @param ModuleDataSetupInterface $moduleDataSetup
    * @param EavSetupFactory $eavSetupFactory
    */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }
    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->insertMultiple(
            $this->moduleDataSetup->getTable('my_table'),
            [
              ['id' => 1, 'name' => 'John', 'email' => 'andrew@email.com', 'password' => '4569644689809'],
              ['id' => 2, 'name' => 'Kevin', 'email' => 'Kevin@mail.com', 'password' => '098433580'],
            ]
        );
          $this->moduleDataSetup->endSetup();
    }
    
    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
