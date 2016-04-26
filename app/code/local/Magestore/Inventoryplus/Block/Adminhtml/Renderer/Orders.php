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
 * Supplier Adminhtml Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Block_Adminhtml_Renderer_Orders extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {
   
    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row)
    {               
        $warehouse_id = Mage::app()->getRequest()->getParam('id');
        if(!$warehouse_id){
            $warehouse_id = 0;
        }
        $product_id = $row->getEntityId();
        $allocated_qty = $row->getAllocated();
        $url = Mage::helper('adminhtml')->getUrl('inventoryadmin/adminhtml_stock/customerchart');    
        if($row->getAllocated()){
             return '<p style="text-align:center"><a name="url" href="javascript:void(0)" onclick="showcustomer('.$product_id.','.$warehouse_id.')">'.$allocated_qty.'</a></p>';
        } else {
            return '0';
        }        
        
    }
}