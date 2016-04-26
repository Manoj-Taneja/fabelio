<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Rma
 * @version    1.5.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Rma_Block_Adminhtml_Rma_Edit_Tab_Rmaitems extends Mage_Adminhtml_Block_Abstract
{
    private $_rmaRequest = null;
    private $_order = null;

    public function __construct()
    {
        if (!$this->getTemplate()) {
            $this->setTemplate('aw_rma/rmaitems.phtml');
        }
    }

    public function getRmaRequest()
    {
        if (!$this->_rmaRequest) {
            $this->_rmaRequest = Mage::registry('awrmaformdatarma');
        }
        return $this->_rmaRequest;
    }

    public function getOrder()
    {
        if (!$this->_order) {
            $this->_order = Mage::getModel('sales/order')->loadByIncrementId($this->getRmaRequest()->getOrderId());
        }
        return $this->_order;
    }
}