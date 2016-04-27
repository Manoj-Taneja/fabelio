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


class AW_Rma_Block_Adminhtml_Sales_Order_View_Tabs_Requests_Grid extends AW_Rma_Block_Adminhtml_Rma_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId(self::ORDERS_GRID_ID)
            ->setUseAjax(true)
        ;
    }

    public function getGridUrl()
    {
        return $this->getUrl('awrma_admin/adminhtml_rma/ordergrid');
    }
}