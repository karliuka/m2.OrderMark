<?php
/**
 * Copyright © 2011-2017 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\OrderMark\Ui\Component\Listing\Column\User;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\User\Model\ResourceModel\User\CollectionFactory;

/**
 * User Options
 */
class Options implements OptionSourceInterface
{
    /**
     * Option
     *
     * @var array
     */
    protected $_options;

    /**
     * User Collection Factory
     *
     * @var \Magento\User\Model\ResourceModel\User\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * Initialize Option
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->_collectionFactory = $collectionFactory;
    }

    /**
     * Retrieve Options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->_options === null) {
            $this->_options = [];
            $collection = $this->_collectionFactory->create();
            foreach ($collection as $user) {
                $this->_options[] = [
                    'value' => $user->getId(), 
                    'label' => $user->getName()
                ];
            }            
            //$this->_options = $this->_collectionFactory->create()->toOptionArray();
        }
        return $this->_options;
    }
}
