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


class AW_Rma_Helper_Status extends Mage_Core_Helper_Abstract
{
    public static function getUneditedStatus()
    {
        return array(
            self::getPendingApprovalStatusId(),
            self::getApprovedStatusId(),
            self::getPackageSentStatusId(),
            self::getResolvedCanceledStatusId()
        );
    }

    public static function getPendingApprovalStatusId()
    {
        return 1;
    }

    public static function getApprovedStatusId()
    {
        return 2;
    }

    public static function getPackageSentStatusId()
    {
        return 3;
    }

    public static function getResolvedCanceledStatusId()
    {
        return 4;
    }

    public static function getResolvedStatuses()
    {
        $_statusCollection = Mage::getModel('awrma/entitystatus')->getCollection()
            ->setResolvedFilter();
        $_statusIds = array();
        foreach ($_statusCollection as $_item) {
            $_statusIds[] = $_item->getId();
        }
        return $_statusIds;
    }
}