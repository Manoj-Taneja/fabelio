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


class AW_Rma_Model_Entitycomments extends Mage_Core_Model_Abstract
{
    protected $_entity = null;

    public function _construct()
    {
        $this->_init('awrma/entitycomments');
    }

    /**
     * @return AW_Rma_Model_Entity|null
     */
    public function getEntity()
    {
        if ($this->_entity === null && ($entityId = $this->getData('entity_id'))) {
            /** @var AW_Rma_Model_Entity $entity */
            $entity = Mage::getModel('awrma/entity')->load($entityId);
            if ($entity->getId()) {
                $this->_entity = $entity;
            }
        }
        return $this->_entity;
    }
}
