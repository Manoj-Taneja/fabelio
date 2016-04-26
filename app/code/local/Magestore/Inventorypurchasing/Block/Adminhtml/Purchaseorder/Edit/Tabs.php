<?php
/**
 * Magestore
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventory Supplier Edit Tabs Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('purchaseorder_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('inventorypurchasing')->__('Purchase Order Information'));
    }
    
    /**
     * prepare before render block to html
     *
     * @return Magestore_Inventory_Block_Adminhtml_Inventory_Edit_Tabs
     */
    protected function _beforeToHtml()
    {
        $deliveryActive = false;
        $returnActive = false;
        $active = $this->getRequest()->getParam('active');
        if($active == 'delivery'){
            $deliveryActive = true;
        }elseif($active == 'return'){
            $returnActive = true;
        }
        
        $this->addTab('form_section', array(
            'label'     => Mage::helper('inventorypurchasing')->__('General Information'),
            'title'     => Mage::helper('inventorypurchasing')->__('General Information'),
            'content'   => $this->getLayout()
                                ->createBlock('inventorypurchasing/adminhtml_purchaseorder_edit_tab_form')
                                ->toHtml(),
        ));
		
        $this->addTab('products_section',array(
                'label'     => Mage::helper('inventorypurchasing')->__('Products'),
                'title'     => Mage::helper('inventorypurchasing')->__('Products'),
                'url'       => $this->getUrl('*/*/product',array(
                  '_current'	=> true,
                  'id'			=> $this->getRequest()->getParam('id'),
                  'store'		=> $this->getRequest()->getParam('store')
                )),
                'class'     => 'ajax',
        ));
		
        if($this->getRequest()->getParam('id')){
            $purchaseorder = Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('id'));
                if($purchaseorder->getStatus()!=7){
                    $this->addTab('delivery_section',array(
                                    'label'     => Mage::helper('inventorypurchasing')->__('Deliveries'),
                                    'title'     => Mage::helper('inventorypurchasing')->__('Deliveries'),
                                    'url'       => $this->getUrl('*/*/delivery',array(
                                      '_current'	=> true,
                                      'id'			=> $this->getRequest()->getParam('id'),
                                      'store'		=> $this->getRequest()->getParam('store')
                                    )),
                                    'class'     => 'ajax',
                                    'active' => $deliveryActive
                    ));
					$this->addTab('returnorder_section',array(
									'label'     => Mage::helper('inventorypurchasing')->__('Return Orders'),
									'title'     => Mage::helper('inventorypurchasing')->__('Return Orders'),
									'url'       => $this->getUrl('*/*/returnorder',array(
									  '_current'	=> true,
									  'id'			=> $this->getRequest()->getParam('id'),
									  'store'		=> $this->getRequest()->getParam('store')
									)),
									'class'     => 'ajax',
									'active' => $returnActive
					));
				}
            $this->addTab('history_section', array(
                'label' => Mage::helper('inventorypurchasing')->__('Change History'),
                'title' => Mage::helper('inventorypurchasing')->__('Change History'),
//                'content' => $this->getLayout()
//                                  ->createBlock('inventorypurchasing/adminhtml_purchaseorder_edit_tab_history')
//                                  ->toHtml(),
                'url' => $this->getUrl('*/*/history', array(
                    '_current' => true,
                    'id' => $this->getRequest()->getParam('id'),
                    'store' => $this->getRequest()->getParam('store')
                )),            
                'class' => 'ajax',
            ));
        }
        return parent::_beforeToHtml();
    }
}