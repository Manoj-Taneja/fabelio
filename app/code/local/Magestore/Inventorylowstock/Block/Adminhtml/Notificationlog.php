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
 * @package     Magestore_Inventorylowstock
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventorylowstock Adminhtml Block
 * 
 * @category    Magestore
 * @package     Magestore_Inventorylowstock
 * @author      Magestore Developer
 */
class Magestore_Inventorylowstock_Block_Adminhtml_Notificationlog extends Mage_Adminhtml_Block_Widget_Grid_Container
{
   public function __construct()
    {
        $this->_controller = 'adminhtml_notificationlog';
        $this->_blockGroup = 'inventorylowstock';
        $this->_headerText = Mage::helper('inventorylowstock')->__('Notification Logs');
        
        parent::__construct();
        $this->_removeButton('add');
    }
}