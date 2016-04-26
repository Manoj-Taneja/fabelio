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
class Zeon_Jobs_Helper_Data extends Mage_Core_Helper_Abstract
{
    
    const XML_PATH_ENABLED = 'zeon_jobs/general/is_enabled';
    const XML_PATH_DEFAULT_META_TITLE = 'zeon_jobs/frontend/meta_title';
    const XML_PATH_DEFAULT_META_KEYWORDS = 'zeon_jobs/frontend/meta_keywords';
    const XML_PATH_DEFAULT_META_DESCRIPTION = 'zeon_jobs/frontend/meta_description';
    const XML_PATH_ALLOWED_FILE_EXTENSIONS  = 'zeon_jobs/frontend/allowed_file_extensions';
    const XML_PATH_IS_APPLY_ONLINE = 'zeon_jobs/frontend/is_apply_online';
    
    public function setIsModuleEnabled($value)
    {
        Mage::getModel('core/config')->saveConfig(self::XML_PATH_ENABLED, $value);
    }

     /**
     * Retrieve default title for jobs
     *
     * @return string
     */
    public function getDefaultTitle()
    {
        return Mage::getStoreConfig(self::XML_PATH_DEFAULT_META_TITLE);
    }
     /**
     * Retrieve default meta keywords for jobs
     *
     * @return string
     */
    public function getDefaultMetaKeywords()
    {
        return Mage::getStoreConfig(self::XML_PATH_DEFAULT_META_KEYWORDS);
    }
     /**
     * Retrieve default meta description for jobs
     *
     * @return string
     */
    public function getDefaultMetaDescription()
    {
        return Mage::getStoreConfig(self::XML_PATH_DEFAULT_META_DESCRIPTION);
    }
     /**
     * Retrieve allowed file extensions
     *
     * @return string
     */
    public function getAllowedFileExtensions()
    {
        return Mage::getStoreConfig(self::XML_PATH_ALLOWED_FILE_EXTENSIONS);
    }
     /**
     * Retrieve allowed apply online for job or not
     */
    public function getAllowedApplyOnline()
    {
        return Mage::getStoreConfig(self::XML_PATH_IS_APPLY_ONLINE);
    }
    
    /**
     * Retrieve Template processor for Block Content
     *
     * @return Varien_Filter_Template
     */
    public function getBlockTemplateProcessor()
    {
        return Mage::getModel('zeon_jobs/template_filter');
    }
}