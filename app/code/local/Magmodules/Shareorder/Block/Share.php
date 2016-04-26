<?php
/**
 * Magmodules.eu
 * http://www.magmodules.eu
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magmodules.eu so we can send you a copy immediately.
 *
 * @category    Magmodules
 * @package     Magmodules_Ordershare
 * @author      Magmodules <info@magmodules.eu)
 * @copyright   Copyright (c) 2013 (http://www.magmodules.eu)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magmodules_Shareorder_Block_Share extends Mage_Core_Block_Template {

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('magmodules/shareorder/share.phtml');
    }

    public function getEnabled() 
    { 
        return Mage::getStoreConfig('shareorder/settings/enable');
    }
    
    public function getProductIdsOrder()
    {
        return $this->helper('shareorder')->getProductIdsOrder();
    }

    public function getFacebookImg($_product) 
    {
		if(Mage::getStoreConfig('shareorder/settings/facebook_enable')) {
			$share = '<a name="fb_share" type="button_count" share_url="' . $_product->getProductUrl() .'"></a>';			
		} else {
			$share = '';
		}		
		return $share;		
    }

    public function getTwitterImg($_product) 
    {
		if(Mage::getStoreConfig('shareorder/settings/twitter_enable')) {
			$msg = Mage::getStoreConfig('shareorder/settings/twitter_share');
			$msg = str_replace("{{product}}", $_product->getName(), $msg); 
			$via = '';
			if(Mage::getStoreConfig('shareorder/settings/twitter_user')) {
				$via = 'data-via="' . Mage::getStoreConfig('shareorder/settings/twitter_user') . '"'; 
			}	
			$share = '<a href="http://twitter.com/share" 
							   class="twitter-share-button" 
							   data-lang="en"
							   data-url="' . $_product->getProductUrl() .'"                        
							   data-text="' . $msg . '"
							   ' . $via . '
							   data-count="twitter-share-button">
						Tweet</a>';
		} else {
			$share = '';
		}
		return $share;
    }
     
}
