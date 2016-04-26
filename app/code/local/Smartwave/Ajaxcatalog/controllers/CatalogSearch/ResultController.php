<?php
/**
 * Catalog Search Controller
 */
require_once('app/code/core/Mage/CatalogSearch/controllers/ResultController.php');
class Smartwave_Ajaxcatalog_CatalogSearch_ResultController extends Mage_CatalogSearch_ResultController
{
	
	public function indexAction()
	{
		
		if($this->getRequest()->isXmlHttpRequest() && (!$this->getRequest()->getParam("fullpageajax") || $this->getRequest()->getParam("ajaxcatalog"))){ 
			//Check for AJAX query
			$response = array();
			
			$query = Mage::helper('catalogsearch')->getQuery();
			/* @var $query Mage_CatalogSearch_Model_Query */
			
			$query->setStoreId(Mage::app()->getStore()->getId());
			
			if ($query->getQueryText()) {
				if (Mage::helper('catalogsearch')->isMinQueryLength()) {
					$query->setId(0)
					->setIsActive(1)
					->setIsProcessed(1);
				}
				else {
					if ($query->getId()) {
						$query->setPopularity($query->getPopularity()+1);
					}else {
						$query->setPopularity(1);
					}
				
					if ($query->getRedirect()){
						$query->save();
						$this->getResponse()->setRedirect($query->getRedirect());
						return;
					}else {
						$query->prepare();
					}
				}
				
				Mage::helper('catalogsearch')->checkNotes();
				
				$this->loadLayout();
				$this->_initLayoutMessages('catalog/session');
				$this->_initLayoutMessages('checkout/session');
				$this->renderLayout();
				
				if (!Mage::helper('catalogsearch')->isMinQueryLength()) {
					$query->save();
				}
			}
			else {
				$this->_redirectReferer();
				$response['status'] = 'FAILURE'; //Add failure when filter can't be applied
			}
			
			$viewpanel = $this->getLayout()->getBlock('catalogsearch.leftnav')->toHtml(); //Get the new Layered Manu
			$productlist = $this->getLayout()->getBlock('search_result_list')->toHtml(); //New product List
			$response['status'] = 'SUCCESS'; //Send Success
			$response['viewpanel']=$viewpanel;
			$response['productlist'] = $productlist;
      $pager = Mage::registry('this_pager');
      if($pager){
        $response['pager'] = array();
        $response['pager']['current_page'] = $pager->getCurrentPage();
        $response['pager']['show_per_page'] = $pager->getShowPerPage();
        $response['pager']['available_limit'] = $pager->getAvailableLimit();
        $response['pager']['first_num'] = $pager->getFirstNum();
        $response['pager']['last_num'] = $pager->getLastNum();
        $response['pager']['total_num'] = $pager->getTotalNum();
        $response['pager']['is_first_page'] = $pager->isFirstPage();
        $response['pager']['last_page_num'] = $pager->getLastPageNum();
        $response['pager']['is_last_page'] = $pager->isLastPage();
        $response['pager']['is_limit_current'] = $pager->isLimitCurrent();
        $response['pager']['is_page_current'] = $pager->isPageCurrent();
        $response['pager']['pages'] = $pager->getPages();
        $response['pager']['first_page_url'] = $pager->getFirstPageUrl();
        $response['pager']['previous_page_url'] = $pager->getPreviousPageUrl();
        $response['pager']['next_page_url'] = $pager->getNextPageUrl();
        $response['pager']['last_page_url'] = $pager->getLastPageUrl();
        $response['pager']['page_url'] = $pager->getPageUrl();
        $response['pager']['limit_url'] = $pager->getLimitUrl();
      }
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
			return;
			
		}
		$query = Mage::helper('catalogsearch')->getQuery();
		/* @var $query Mage_CatalogSearch_Model_Query */
		
		$query->setStoreId(Mage::app()->getStore()->getId());
		
		if ($query->getQueryText()) {
			if (Mage::helper('catalogsearch')->isMinQueryLength()) {
			$query->setId(0)
			->setIsActive(1)
			->setIsProcessed(1);
			}else {
				if ($query->getId()) {
					$query->setPopularity($query->getPopularity()+1);
				}else {
					$query->setPopularity(1);
				}
		
				if ($query->getRedirect()){
					$query->save();
					$this->getResponse()->setRedirect($query->getRedirect());
					return;
				}else {
					$query->prepare();
				}
			}
		
			Mage::helper('catalogsearch')->checkNotes();
			
			$this->loadLayout();
			$this->_initLayoutMessages('catalog/session');
			$this->_initLayoutMessages('checkout/session');
			$this->renderLayout();
			
			if (!Mage::helper('catalogsearch')->isMinQueryLength()) {
				$query->save();
			}
		}
		else {
			$this->_redirectReferer();
		}
	}
	
}
