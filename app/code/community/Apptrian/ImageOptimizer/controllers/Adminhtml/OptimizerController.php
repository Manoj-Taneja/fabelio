<?php
/**
 * @category   Apptrian
 * @package    Apptrian_ImageOptimizer
 * @author     Apptrian
 * @copyright  Copyright (c) 2015 Apptrian (http://www.apptrian.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Apptrian_ImageOptimizer_Adminhtml_OptimizerController extends Mage_Adminhtml_Controller_Action
{
	
	public function scanAction()
	{
		
		$helper = Mage::helper('apptrian_imageoptimizer');
		
		try {
			
			$helper->scanAndReindex();
			
			$message = $this->__('Scan and reindex operations completed successfully.');
			Mage::getSingleton('adminhtml/session')->addSuccess($message);
			
		} catch (Exception $e) {
			
			$message = $this->__('Scanning and reindexing failed.');
			Mage::getSingleton('adminhtml/session')->addError($message);
			Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			
		}
		
		$url = Mage::helper('adminhtml')->getUrl('adminhtml/system_config/edit/section/apptrian_imageoptimizer');
		Mage::app()->getResponse()->setRedirect($url);
		
	}
	
	public function optimizeAction()
	{
	
		$helper = Mage::helper('apptrian_imageoptimizer');
		
		if ($helper->isExecFunctionEnabled()) {
		
			try {
					
				$helper->optimize();
					
				$message = $this->__('Optimization operations completed successfully.');
				Mage::getSingleton('adminhtml/session')->addSuccess($message);
					
			} catch (Exception $e) {
					
				$message = $this->__('Optimization failed.');
				Mage::getSingleton('adminhtml/session')->addError($message);
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
					
			}
		
		} else {
			
			$message = $this->__('Optimization failed because PHP exec() function is disabled.');
			Mage::getSingleton('adminhtml/session')->addError($message);
			
		}
		
		$url = Mage::helper('adminhtml')->getUrl('adminhtml/system_config/edit/section/apptrian_imageoptimizer');
		Mage::app()->getResponse()->setRedirect($url);
	
	}
	
	
}