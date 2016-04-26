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


class AW_Rma_Model_Status_Template extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('awrma/status_template');
    }

    public function loadByStatusAndStore($statusId, $storeId)
    {
        $collection = $this->getCollection()
            ->addFieldToFilter('status_id', $statusId)
            ->addFieldToFilter('store_id', $storeId)
            ->setPageSize(1)
        ;

        foreach ($collection as $tpl) {
            return $tpl;
        }
        return null;
    }
}
