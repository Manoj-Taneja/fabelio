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
 * @package    AW_Storecredit
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */

class AW_Storecredit_Model_Mysql4_Storecredit extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('aw_storecredit/storecredit', 'entity_id');
    }

    public function removeTotals(AW_Storecredit_Model_Storecredit $storecreditModel)
    {
        $write = $this->_getWriteAdapter();
        $write->query(
            "DELETE FROM {$this->getTable('aw_storecredit/history')} "
            . "WHERE storecredit_id = {$storecreditModel->getId()}"
        );
        $write->query(
            "DELETE FROM {$this->getTable('aw_storecredit/quote_storecredit')} "
            . "WHERE storecredit_id = {$storecreditModel->getId()}"
        );
        $write->query(
            "DELETE FROM {$this->getTable('aw_storecredit/order_invoice_storecredit')} "
            . "WHERE storecredit_id = {$storecreditModel->getId()}"
        );
        $write->query(
            "DELETE FROM {$this->getTable('aw_storecredit/order_creditmemo_storecredit')} "
            . "WHERE storecredit_id = {$storecreditModel->getId()}"
        );
        return $this;
    }
}