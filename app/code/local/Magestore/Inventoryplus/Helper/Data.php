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
 * Inventory Helper
 * 
 * @category    Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * get list of country
     * @return type
     */
    public function getCountryList() {
        $result = array();
        $collection = Mage::getModel('directory/country')->getCollection();
        foreach ($collection as $country) {
            $cid = $country->getId();
            $cname = $country->getName();
            $result[$cid] = $cname;
        }
        return $result;
    }

    /**
     * get list of warehouse
     * @return type
     */
    public function getWarehouseList() {
        $options = array();
        $warehouses = Mage::getModel('inventoryplus/warehouse')->getCollection();
        foreach ($warehouses as $warehouse) {
            $options[$warehouse->getId()] = $warehouse->getWarehouseName();
        }

        return $options;
    }

    /**
     * Check is Warehouse plugin exists and enabled in global config.
     * 
     * @return boolean
     */
    public function isWarehouseEnabled() {
        return Mage::helper('core')->isModuleEnabled('Magestore_Inventorywarehouse');
    }

    /**
     * get label status
     * @return string
     */
    public function getStatusLabel($status) {
        $return = $this->__('Pending');
        if ($status == 1) {
            $return = $this->__('Completed');
        }
        return $return;
    }

    public function filterDates($array, $dateFields) {
        if (empty($dateFields)) {
            return $array;
        }
        $filterInput = new Zend_Filter_LocalizedToNormalized(array(
            'date_format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));
        $filterInternal = new Zend_Filter_NormalizedToLocalized(array(
            'date_format' => Varien_Date::DATE_INTERNAL_FORMAT
        ));

        foreach ($dateFields as $dateField) {
            if (array_key_exists($dateField, $array) && !empty($dateField)) {
                $array[$dateField] = $filterInput->filter($array[$dateField]);
                $array[$dateField] = $filterInternal->filter($array[$dateField]);
            }
        }
        return $array;
    }

    /**
     * get menu
     * 
     * @return HTML 
     */
    public function getMenu($menu, $level = 0, $showbutton = true) {
        if ((Mage::app()->getRequest()->getParam('section') == 'inventoryplus' && Mage::app()->getRequest()->getParam('section')) || !Mage::app()->getRequest()->getParam('section'))
            $html = '<ul ' . (!$level ? 'id="inventory-nav" style="display:block; width:100%; float:left"' : '') . '>' . PHP_EOL;
        else
            $html = '<ul ' . (!$level ? 'id="inventory-nav" style="display:none; width:100%; float:left"' : '') . '>' . PHP_EOL;



        foreach ($menu as $id => $item) {

            $html .= '<li ' . (!empty($item['children']) ? 'onmouseover="Element.addClassName(this,\'over\')" '
                            . 'onmouseout="Element.removeClassName(this,\'over\')"' : '') . ' class="'
                    . (!$level && !empty($item['active']) ? ' active' : '') . ' '
                    . (!empty($item['children']) ? ' parent' : '')
                    . (!empty($level) && !empty($item['last']) ? ' last' : '')
                    . ' level' . $level . '"> <a href="' . ((isset($item['url']) && $item['url'] != '') ? $item['url'] : 'javascript:void(0)') . '" '
                    . (!empty($item['title']) ? 'title="' . $item['title'] . '"' : '') . ' '
                    . (!empty($item['click']) ? 'onclick="' . $item['click'] . '"' : '') . ' class="'
                    . ($level === 0 && !empty($item['active']) ? 'active' : '') . '"><span>'
                    . (isset($item['label']) ? $this->escapeHtml($item['label']) : '') . '</span></a>' . PHP_EOL;

            if (isset($item['children'])) {
                //$children = new Varien_Object(array('menu'=>$item['children']));
                $html .= $this->getMenu($item['children'], $level + 1, false);
            }
            $html .= '</li>' . PHP_EOL;
        }
        // Billy comment
        //if($showbutton){
        //    $html .= '<div id="show_main_menu">';
        //  $html .= '<button onclick="showmainmenu()">' . $this->__('Show Main Menu') . '</button>';
        //   $html .= '</div>';
        // }
        //end
        $html .= '</ul>' . PHP_EOL;

        return $html;
    }

    /**
     * get list menu
     * 
     * @return Object 
     */
    public function getInventoryMenu() {
        $parentArr = array();
        $array = array(
            'dashboard' => array('label' => $this->__('Dashboard'),
                'sort_order' => 10,
                'url' => Mage::helper("adminhtml")->getUrl("inventoryplusadmin/adminhtml_dashboard/", array("_secure" => Mage::app()->getStore()->isCurrentlySecure())),
                'active' => (Mage::app()->getRequest()->getControllerName() == 'adminhtml_dashboard') ? true : false,
                'level' => 0),
            'warehouses' => array('label' => $this->__('Warehouses'),
                'sort_order' => 100,
                'url' => Mage::helper("adminhtml")->getUrl("inventoryplusadmin/adminhtml_warehouse/", array("_secure" => Mage::app()->getStore()->isCurrentlySecure())),
                'active' => (Mage::app()->getRequest()->getControllerName() == 'adminhtml_warehouse') ? true : false,
                'level' => 0),
            'managestock' => array('label' => $this->__('Manage Stock'),
                'sort_order' => 150,
                'url' => Mage::helper("adminhtml")->getUrl("inventoryplusadmin/adminhtml_stock/", array("_secure" => Mage::app()->getStore()->isCurrentlySecure())),
                'active' => (Mage::app()->getRequest()->getControllerName() == 'adminhtml_stock') ? true : false,
                'level' => 0),
            'adjuststock' => array('label' => $this->__('Adjust Stock'),
                'sort_order' => 300,
                'url' => Mage::helper("adminhtml")->getUrl("inventoryplusadmin/adminhtml_adjuststock/", array("_secure" => Mage::app()->getStore()->isCurrentlySecure())),
                'active' => (Mage::app()->getRequest()->getControllerName() == 'adminhtml_adjuststock') ? true : false,
                'level' => 0),
            'settings' => array('label' => $this->__('Settings'),
                'sort_order' => 10000,
                'url' => Mage::helper("adminhtml")->getUrl("adminhtml/system_config/edit/section/inventoryplus", array("_secure" => Mage::app()->getStore()->isCurrentlySecure())),
                'active' => (Mage::app()->getRequest()->getControllerName() == 'system_config') ? true : false,
                'level' => 0)
        );
        $menus = new Varien_Object(array('menu' => $array));

        Mage::dispatchEvent('inventory_menu_list', array('menus' => $menus));

        $parentArr = $this->sortMenu($menus);


        uasort($parentArr, array($this, '_sortMenu'));

        return $parentArr;
    }

    public function sortMenu($menus) {
        $parentArr = array();

        foreach ($menus->getMenu() as $id => $item) {
            $parentArr[$id] = $item;
            if (isset($item['children'])) {
                $childMenu = new Varien_Object(array('menu' => $item['children']));

                $parentArr[$id]['children'] = $this->sortMenu($childMenu);
                uasort($parentArr[$id]['children'], array($this, '_sortMenu'));
            }
        }

        return $parentArr;
    }

    protected function _sortMenu($a, $b) {
        if(isset($a['sort_order']) && isset($b['sort_order']))
            return $a['sort_order'] < $b['sort_order'] ? -1 : ($a['sort_order'] > $b['sort_order'] ? 1 : 0);
        else 
            return 0;
    }

    public function getAllocatedQty($item, $warehouseId) {
        $product_id = $item->getEntityId();
        $resource = Mage::getModel('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $writeConnection = $resource->getConnection('core_write');
        $sql = 'SELECT SUM(qty) as `allocated` FROM ' . $resource->getTableName('inventoryplus/warehouse_order') . ' WHERE product_id = ' . $product_id . ' AND warehouse_id = ' . $warehouseId;
        $result = $readConnection->fetchAll($sql);

        return $result[0]['allocated'];
    }

    public function isInstallData() {
        $resource = Mage::getModel('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $field_check = Mage::getModel('inventoryplus/checkupdate')
                ->getCollection()
                ->getFirstItem()
                ->getIsInsertData();
        $product_check = $readConnection->fetchOne('SELECT product_id FROM ' . $resource->getTableName('inventoryplus/warehouse_product') . ' LIMIT 1');
        if ($product_check == null && !$field_check) {
            return 0;
        } else
            return 1;
    }
/*    
    public function getPermission($warehouseId,$permissionType) {
        $admin = Mage::getSingleton('admin/session')->getUser();
        $adminId = $admin->getId();
        $permissions = Mage::getSingleton('adminhtml/session')->getData('inventory_permission');        
        $adminPermission = $permissions[$adminId];
        if (array_key_exists($warehouseId, $adminPermission)) {
            $permission = $adminPermission[$warehouseId][$permissionType];
        }
        return $permission;
    }
*/  
    public function getPermission($warehouseId,$permissionType) {
        $resource = Mage::getModel('core/resource');
        $readConnection = $resource->getConnection('core_read');      
        $admin = Mage::getSingleton('admin/session')->getUser();
        $adminId = $admin->getId();
        $sql = "SELECT * FROM ".$resource->getTableName('inventoryplus/warehouse_permission')
                .' WHERE admin_id = '.$adminId
                .' AND warehouse_id = '.$warehouseId;
        $result = $readConnection->fetchAll($sql);  
        $permission = isset($result[0][$permissionType]) ? $result[0][$permissionType] : 0;            
        return $permission;
    }
    
    public function saveSessionPermission(){
        Mage::getSingleton('adminhtml/session')->setData('inventory_permission',null);
        $permissionArray = array();
        $adminPermission = Mage::getModel('inventoryplus/warehouse_permission')
                ->getCollection();
        foreach($adminPermission as $permission){
            if(!array_key_exists($permission->getAdminId(),$permissionArray)){
                $permissionArray[$permission->getAdminId()] = '';
            } 
            if(!array_key_exists($permission->getWarehouseId(),$permissionArray[$permission->getAdminId()])){
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()] = '';
            }
            if($permissionArray[$permission->getAdminId()][$permission->getWarehouseId()] == ''){
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()]['can_edit'] = !$permission->getCanEdit() ? '0' : $permission->getCanEdit();
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()]['can_adjust'] = !$permission->getCanAdjust() ? '0' : $permission->getCanAdjust();
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()]['can_send_request_stock'] = !$permission->getCanSendRequestStock() ? '0' : $permission->getCanSendRequestStock();
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()]['can_physical'] = !$permission->getCanPhysical() ? '0' : $permission->getCanPhysical();
                $permissionArray[$permission->getAdminId()][$permission->getWarehouseId()]['can_purchase_product'] = !$permission->getCanPurchaseProduct() ? '0' : $permission->getCanPurchaseProduct();
            }
        }
        Mage::getSingleton('adminhtml/session')->setData('inventory_permission',$permissionArray);
    }
}
