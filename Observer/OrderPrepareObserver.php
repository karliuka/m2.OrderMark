<?php
/**
 * Copyright © 2011-2017 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\OrderMark\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Backend\Model\Auth\Session;

/**
 * Order Prepare Observer
 */
class OrderPrepareObserver implements ObserverInterface
{
    /**
     * Auth Session
     *
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_session;    
    
    /**
     * Initialize Observer
     *
     * @param Session $objectManager
     */
    public function __construct(
        Session $objectManager
    ) {
        $this->_session = $objectManager;
    }
       	
    /**
     * Order Save Before
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
		$user = $this->getUser();
		if ($user && $user->getId()) {
            $order = $observer->getEvent()->getOrder();
            $order->setAdminId($user->getId());
		}
    }
    
    /**
     * Retrieve Current User
     * 
     * @return \Magento\User\Model\User
     */    
    public function getUser()
    {
        return $this->_session->getUser();
    }    
}  
