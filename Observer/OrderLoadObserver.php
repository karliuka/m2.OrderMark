<?php
/**
 * Copyright © 2011-2017 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\OrderMark\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\ObjectManager;

/**
 * Order Load Observer
 */
class OrderLoadObserver implements ObserverInterface
{
    /**
     * Order Load After
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $attributes = $order->getExtensionAttributes() ?: $this->_getExtensionAttributes();
        
        $attributes->setAdminId($order->getAdminId());

        $order->setExtensionAttributes($attributes);
    }

    /**
     * Retrieve Order Extension Attributes
     *
     * @return \Magento\Sales\Api\Data\OrderExtension
     */
    protected function _getExtensionAttributes()
    {
        return ObjectManager::getInstance()->get(
            '\Magento\Sales\Api\Data\OrderExtension'
        );
    }
}