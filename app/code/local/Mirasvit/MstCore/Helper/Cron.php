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


class Mirasvit_MstCore_Helper_Cron extends Mage_Core_Helper_Data
{
    /**
     * Method allows to display message about not working cron job in admin panel.
     * Need call at start of adminhtml controller action.
     * @param  string  $jobCode cronjob code (from config.xml)
     * @param  boolean $link    link to manual about cronjob configuration
     */
 	public function checkCronStatus($jobCode, $link = false)
    {
    	if (!$this->isCronRunning($jobCode)) {
    		$message = $this->__('Cron is not running. You need to setup a cron job for Magento. To do this, add following expression to your crontab <br><i>%s</i>', $this->getCronExpression());
    		if ($link) {
    			$message .= $this->__('<br><a href="%s" target="_blank">Read more</a>', $link);
    		}
            Mage::getSingleton('adminhtml/session')->addError($message);
    	}
	}

 	public function isCronRunning($jobCode)
    {
        $job = Mage::getModel('cron/schedule')->getCollection()
            ->addFieldToFilter('job_code', $jobCode)
            ->addFieldToFilter('status', 'success')
            ->setOrder('scheduled_at', 'desc')
            ->getFirstItem();

        if (!$job->getId()) {
            return false;
        }

        $jobTimestamp = strtotime($job->getExecutedAt());
        $timestamp    = Mage::getSingleton('core/date')->gmtTimestamp();

        if (abs($timestamp - $jobTimestamp) > 6 * 60 * 60) {
            return false;
        }

        return true;
    }

    public function getCronExpression()
    {
        $phpBin = $this->getPhpBin();
        $root   = Mage::getBaseDir();
        $var    = Mage::getBaseDir('var');

        $line = '* * * * * date >> '.$var.DS.'log'.DS.'cron.log;'
            .$phpBin.' -f '.$root.DS.'cron.php >> '.$var.DS.'log'.DS.'cron.log 2>&1;';

        return $line;
    }

    public function getPhpBin()
    {
        $phpBin = 'php';

        if (PHP_BINDIR) {
            $phpBin = PHP_BINDIR.DS.'php';
        }

        return $phpBin;
    }
}
