<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Full Page Cache
 * @version   1.0.1
 * @build     360
 * @copyright Copyright (C) 2015 Mirasvit (http://mirasvit.com/)
 */


class Mirasvit_MstCore_Block_Adminhtml_Validator extends Mage_Adminhtml_Block_Template
{
    public function _prepareLayout()
    {
        $this->setTemplate('mstcore/validator.phtml');
    }

    public function getResults()
    {
        $results = array();

        $modules = $this->getModules();

        foreach ($modules as $module) {
            $helper = $this->getValidatorHelper($module);
            if ($helper) {
                $results += $helper->runTests();
            }
        }

        return $results;

    }

    public function getValidatorHelper($module)
    {
        if ($module == 'SEO') {
            $module = 'Seo';
        } elseif ($module == 'MCore') {
            $module = 'MstCore';
        }

        $file = Mage::getBaseDir().'/app/code/local/Mirasvit/'.$module.'/Helper/Validator.php';

        if (file_exists($file)) {
            $helper = Mage::helper(strtolower($module).'/Validator');
            return $helper;
        }
    }

    public function getModules()
    {
        $modules = Mage::app()->getRequest()->getParam('modules');
        if ($modules != '') {
            $modules = explode(',', $modules);
        }

        if (count($modules) == 0) {
            $mstdir = Mage::getBaseDir('app').DS.'code'.DS.'local'.DS.'Mirasvit';

            if ($handle = opendir($mstdir)) {
                while (false !== ($entry = readdir($handle))) {
                    if (substr($entry, 0, 1) != '.') {
                        if (!Mage::helper('mstcore')->isModuleInstalled("Mirasvit_$entry")) {
                            continue;
                        }
                        $modules[] = $entry;
                    }
                }
                closedir($handle);
            }
        }

        return $modules;
    }

    public function getBackUrl()
    {
        return Mage::helper('core/http')->getHttpReferer();
    }
}
