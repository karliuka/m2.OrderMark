<?php
/**
 * Copyright © 2011-2017 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\OrderMark\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Sales\Setup\SalesSetupFactory;

/**
 * OrderMark InstallData
 */
class InstallData implements InstallDataInterface
{
    /**
     * Sales Setup Factory
     *
     * @var \Magento\Sales\Setup\SalesSetupFactory
     */
    protected $_salesSetupFactory;

    /**
     * Initialize Setup
     *
     * @param SalesSetupFactory $salesSetupFactory
     */
    public function __construct(
		SalesSetupFactory $salesSetupFactory
	) {
        $this->_salesSetupFactory = $salesSetupFactory;
    }
    	
    /**
     * Installs DB Data for a Module OrderMark
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var \Magento\Sales\Setup\SalesSetup $salesInstaller */
        $salesInstaller = $this->_salesSetupFactory->create([
            'resourceName' => 'sales_setup', 
            'setup' => $setup
        ]);
        
        $salesInstaller->addAttribute('order', 'admin_id', [
            'type'    => Table::TYPE_INTEGER, 
            'visible' => true, 
            'default' => 0,
            'grid'    => true
        ]);
    }
}
