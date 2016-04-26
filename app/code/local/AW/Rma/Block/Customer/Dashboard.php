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


class AW_Rma_Block_Customer_Dashboard extends Mage_Core_Block_Template
{

    public function __construct()
    {
        parent::__construct();
        if (Mage::helper('awrma')->checkExtensionVersion('Mage_Core', '0.8.25')) {
            $_template = 'aw_rma/customer/dashboard.phtml'; // >= Magento 1.4
        } else {
            $_template = 'aw_rma/customer/dashboard13x.phtml'; // < Magento 1.4
        }
        $this->setTemplate($_template);
        return $this;
    }

    /**
     * Collection of RMA entities
     *
     * @var AW_Rma_Model_Mysql4_Entity_Collection
     */
    private $_rmaEntitiesCollection = null;

    /**
     * Returns RMA entities collection with some filters. Filtered by current
     * user id or email, for sample.
     *
     * @return AW_Rma_Model_Mysql4_Entity_Collection
     */
    public function getRmaEntitiesCollection()
    {
        if ($this->_rmaEntitiesCollection instanceof AW_Rma_Model_Mysql4_Entity_Collection) {
            return $this->_rmaEntitiesCollection;
        }

        $this->_rmaEntitiesCollection = Mage::getModel('awrma/entity')->getCollection()
            ->setCustomerFilter(Mage::getModel('customer/session')->getId())
            ->joinStatusNames()
            ->setOrder('created_at', 'DESC');

        return $this->_rmaEntitiesCollection;
    }

    public function setRmaEntitiesCollection(AW_Rma_Model_Mysql4_Entity_Collection $collection)
    {
        $this->_rmaEntitiesCollection = $collection;
        return $this;
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock('page/html_pager', 'awrma.entity.list.pager')
            ->setCollection($this->getRmaEntitiesCollection());
        $this->setChild('pager', $pager);
        $this->getRmaEntitiesCollection()->load();

        return $this;
    }
}