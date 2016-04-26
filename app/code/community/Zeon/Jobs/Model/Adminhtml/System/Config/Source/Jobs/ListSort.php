<?php

/**
 * zeonsolutions inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.zeonsolutions.com/shop/license-community.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * This package designed for Magento COMMUNITY edition
 * =================================================================
 * zeonsolutions does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * zeonsolutions does not provide extension support in case of
 * incorrect edition usage.
 * =================================================================
 *
 * @category   Zeon
 * @package    Zeon_Jobs
 * @version    0.0.1
 * @copyright  @copyright Copyright (c) 2013 zeonsolutions.Inc. (http://www.zeonsolutions.com)
 * @license    http://www.zeonsolutions.com/shop/license-community.txt
 */
class Zeon_Jobs_Model_Adminhtml_System_Config_Source_Jobs_ListSort
{
    /**
     * Retrieve option values array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = array();
        $options[] = array(
                'label' => Mage::helper('zeon_jobs')->__('Job Title'),
                'value' => 'title'
            );
        $options[] = array(
                'label' => Mage::helper('zeon_jobs')->__('Recent Jobs'),
                'value' => 'update_time'
            );

        return $options;
    }

    /**
     * Retrieve Jobs Config Singleton
     *
     * @return Zeon_Jobs_Model_Config
     */
    protected function _getJobsConfig()
    {
        return Mage::getSingleton('zeon_jobs/config');
    }
}
