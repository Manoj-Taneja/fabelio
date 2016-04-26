<?php
/**
 * Category controller
 *
 * @category   Mage
 * @package    Mage_Catalog
 */

require_once('app/code/core/Mage/Catalog/controllers/CategoryController.php');
class Smartwave_Ajaxcatalog_Catalog_CategoryController extends Mage_Catalog_CategoryController
{

	public function viewAction()
	{
		if($this->getRequest()->isXmlHttpRequest() && (!$this->getRequest()->getParam("fullpageajax") || $this->getRequest()->getParam("ajaxcatalog"))){ //Check if it was an AJAX request
			$response = array();
			
			if ($category = $this->_initCatagory()) {
				$design = Mage::getSingleton('catalog/design');
				$settings = $design->getDesignSettings($category);
				
				// apply custom design
				if ($settings->getCustomDesign()) {
					$design->applyCustomDesign($settings->getCustomDesign());
				}
				
				Mage::getSingleton('catalog/session')->setLastViewedCategoryId($category->getId());
				
				$update = $this->getLayout()->getUpdate();
				$update->addHandle('default');
				
				if (!$category->hasChildren()) {
					$update->addHandle('catalog_category_layered_nochildren');
				}
				
				$this->addActionLayoutHandles();
				$update->addHandle($category->getLayoutUpdateHandle());
				$update->addHandle('CATEGORY_' . $category->getId());
				$this->loadLayoutUpdates();
				
				// apply custom layout update once layout is loaded
				if ($layoutUpdates = $settings->getLayoutUpdates()) {
					if (is_array($layoutUpdates)) {
						foreach($layoutUpdates as $layoutUpdate) {
							$update->addUpdate($layoutUpdate);
						}
					}
				}
			
			$this->generateLayoutXml()->generateLayoutBlocks(); //Generate new blocks
			$viewpanel = $this->getLayout()->getBlock('catalog.leftnav')->toHtml();
			$productlist = $this->getLayout()->getBlock('product_list')->toHtml(); // Generate product list
			$response['status'] = 'SUCCESS';
			$response['viewpanel']=$viewpanel;
			$response['productlist'] = $productlist;

      $pager = Mage::registry('this_pager');
      if($pager){
        $response['pager'] = array();
        $response['pager']['current_page']      = $pager->getCurrentPage();
        $response['pager']['show_per_page']     = $pager->getShowPerPage();
        $response['pager']['available_limit']   = $pager->getAvailableLimit();
        $response['pager']['first_num']         = $pager->getFirstNum();
        $response['pager']['last_num']          = $pager->getLastNum();
        $response['pager']['total_num']         = $pager->getTotalNum();
        $response['pager']['is_first_page']     = $pager->isFirstPage();
        $response['pager']['last_page_num']     = $pager->getLastPageNum();
        $response['pager']['is_last_page']      = $pager->isLastPage();
        $response['pager']['is_limit_current']  = $pager->isLimitCurrent();
        $response['pager']['is_page_current']   = $pager->isPageCurrent();
        $response['pager']['pages']             = $pager->getPages();
        $response['pager']['first_page_url']    = preg_replace('/\&/', "?", htmlspecialchars_decode($pager->getFirstPageUrl()), 1);
        $response['pager']['previous_page_url'] = preg_replace('/\&/', "?", htmlspecialchars_decode($pager->getPreviousPageUrl()), 1);
        $response['pager']['next_page_url']     = preg_replace('/\&/', "?", htmlspecialchars_decode($pager->getNextPageUrl()), 1);
        $response['pager']['last_page_url']     = preg_replace('/\&/', "?", htmlspecialchars_decode($pager->getLastPageUrl()), 1);
        $response['pager']['page_url']          = preg_replace('/\&/', "?", htmlspecialchars_decode($pager->getPageUrl()), 1);
        $response['pager']['limit_url']         = preg_replace('/\&/', "?", htmlspecialchars_decode($pager->getLimitUrl()), 1);
      }
			
			// apply custom layout (page) template once the blocks are generated
			}elseif (!$this->getResponse()->isRedirect()) {
				$this->_forward('noRoute');
				$response['status'] = 'FAILURE';
			}
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
			return;
		}
		
		if ($category = $this->_initCatagory()) {
			$design = Mage::getSingleton('catalog/design');
			$settings = $design->getDesignSettings($category);
			
			// apply custom design
			if ($settings->getCustomDesign()) {
				$design->applyCustomDesign($settings->getCustomDesign());
			}
			
			Mage::getSingleton('catalog/session')->setLastViewedCategoryId($category->getId());
			
			$update = $this->getLayout()->getUpdate();
			$update->addHandle('default');
			
			if (!$category->hasChildren()) {
				$update->addHandle('catalog_category_layered_nochildren');
			}
			
			$this->addActionLayoutHandles();
			$update->addHandle($category->getLayoutUpdateHandle());
			$update->addHandle('CATEGORY_' . $category->getId());
			$this->loadLayoutUpdates();
			
			// apply custom layout update once layout is loaded
			if ($layoutUpdates = $settings->getLayoutUpdates()) {
				if (is_array($layoutUpdates)) {
					foreach($layoutUpdates as $layoutUpdate) {
						$update->addUpdate($layoutUpdate);
					}
				}
			}
			
			$this->generateLayoutXml()->generateLayoutBlocks();
			// apply custom layout (page) template once the blocks are generated
			if ($settings->getPageLayout()) {
				$this->getLayout()->helper('page/layout')->applyTemplate($settings->getPageLayout());
			}
			
			if ($root = $this->getLayout()->getBlock('root')) {
				$root->addBodyClass('categorypath-' . $category->getUrlPath())
				->addBodyClass('category-' . $category->getUrlKey());
			}
			
			$this->_initLayoutMessages('catalog/session');
			$this->_initLayoutMessages('checkout/session');
			$this->renderLayout();
		}elseif (!$this->getResponse()->isRedirect()) {
			$this->_forward('noRoute');
		}
	}
	
}
