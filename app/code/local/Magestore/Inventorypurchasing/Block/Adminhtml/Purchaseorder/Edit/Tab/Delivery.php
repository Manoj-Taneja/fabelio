<?php

class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Edit_Tab_Delivery extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('deliveryGrid');
        $this->setDefaultSort('delivery_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        if ($this->getPurchaseOrder() && $this->getPurchaseOrder()->getId()) {
            $this->setDefaultFilter(array('in_deliveries' => 1));
        }
    }

    protected function _prepareLayout() {
        if ($purchaseOrderId = $this->getRequest()->getParam('id')) {
            $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
            $resource = Mage::getSingleton('core/resource');
            $readConnection = $resource->getConnection('core_read');
            
            $sql = 'SELECT purchase_order_product_id from ' . $resource->getTableName("erp_inventory_purchase_order_product") . ' WHERE (purchase_order_id = ' . $this->getRequest()->getParam("id") . ') AND (qty_recieved < qty)';
            $results = $readConnection->fetchAll($sql);
            if (($purchaseOrder->getStatus() == '6') || !$results || (count($results) < 1))
                return parent::_prepareLayout();
            if ($this->checkCreateAllDelivery() && $purchaseOrder->getStatus()!=7) 
                $this->setChild('create_all_delivery_button', $this->getLayout()->createBlock('adminhtml/widget_button')
                                ->setData(array(
                                    'label' => Mage::helper('inventorypurchasing')->__('Create all deliveries'),
                                    'onclick' => 'setLocation(\'' . $this->getUrl('*/*/alldelivery', array('purchaseorder_id' => $this->getRequest()->getParam('id'), 'action' => 'alldelivery', '_current' => false)) . '\')',
                                    'class' => 'add',
									'style' => 'float:right'
                                ))
                );
			if ($this->checkCreateNewDelivery() && $purchaseOrder->getStatus()!=7){
                $this->setChild('create_delivery_button', $this->getLayout()->createBlock('adminhtml/widget_button')
                                ->setData(array(
                                    'label' => Mage::helper('inventorypurchasing')->__('Create a new delivery'),
                                    'onclick' => 'setLocation(\'' . $this->getUrl('*/*/newdelivery', array('purchaseorder_id' => $this->getRequest()->getParam('id'), 'warehouse_ids' => $purchaseOrder->getWarehouseId(), 'action' => 'newdelivery', '_current' => false)) . '\')',
                                    'class' => 'add',
									'style' => 'float:right'
                                ))
                );
			}	
        }
        return parent::_prepareLayout();
    }

    protected function _addColumnFilterToCollection($column) {
        if ($column->getId() == 'in_deliveries') {
            $deliveryIds = $this->_getSelectedDeliveries();
            if (empty($deliveryIds))
                $deliveryIds = 0;
            if ($column->getFilter()->getValue())
                $this->getCollection()->addFieldToFilter('delivery_id', array('in' => $deliveryIds));
            elseif ($deliveryIds)
                $this->getCollection()->addFieldToFilter('delivery_id', array('nin' => $deliveryIds));
            return $this;
        }
        return parent::_addColumnFilterToCollection($column);
    }

    protected function _prepareCollection() {
        $resource = Mage::getSingleton('core/resource');
        $purchaseOrderId = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('inventorypurchasing/purchaseorder_delivery')->getCollection()
                ->addFieldToFilter('purchase_order_id', $purchaseOrderId);

        $filter = $this->getParam($this->getVarNameFilter(), null);
        
        if ($filter) {
            $data = $this->helper('adminhtml')->prepareFilterString($filter);
            foreach ($data as $value => $key) {
                if ($value == 'delivery_date') {
                    $condorder = $key;
                }
            }
        }
        
    if (isset($condorder['from']) || isset($condorder['to'])) {
            $condorder = Mage::helper('inventorypurchasing')->filterDates($condorder, array('from', 'to'));
            if(isset($condorder['from']))
                $from = $condorder['from'];
            if(isset($condorder['to']))
                $to = $condorder['to'];
            if (isset($from)) {
                $from = date('Y-m-d', strtotime($from));
                $collection->addFieldToFilter('delivery_date', array('gteq' => $from));
            }
            if (isset($to)) {
                $to = date('Y-m-d', strtotime($to));
                $to .= ' 23:59:59';
                $collection->addFieldToFilter('delivery_date', array('lteq' => $to));
            }
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $currencyCode = Mage::app()->getStore()->getBaseCurrency()->getCode();

        $this->addColumn('delivery_id', array(
            'header' => Mage::helper('inventorypurchasing')->__('ID'),
            'width' => '80px',
            'type' => 'text',
            'index' => 'delivery_id',
        ));

        $this->addColumn('delivery_date', array(
            'header' => Mage::helper('catalog')->__('Delivery Date'),
            'sortable' => true,
            'width' => '60',
            'type' => 'date',
            'index' => 'delivery_date',
            'filter_condition_callback' => array($this, 'filterCreatedOn')
        ));

        $this->addColumn('product_name', array(
            'header' => Mage::helper('catalog')->__('Product Name'),
            'align' => 'left',
            'index' => 'product_name',
        ));


        $this->addColumn('product_sku', array(
            'header' => Mage::helper('catalog')->__('Product SKU'),
            'width' => '80px',
            'index' => 'product_sku'
        ));

        $this->addColumn('product_image', array(
            'header' => Mage::helper('catalog')->__('Image'),
            'width' => '90px',
            'renderer' => 'inventoryplus/adminhtml_renderer_productimage',
            'filter' => false,
        ));

        if ($this->getRequest()->getParam('id')) {
            $resource = Mage::getSingleton('core/resource');
            $readConnection = $resource->getConnection('core_read');
            
            $sql = 'SELECT distinct(`warehouse_id`),warehouse_name from ' . $resource->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' . $this->getRequest()->getParam("id") . ')';
            $results = $readConnection->fetchAll($sql);
            
            foreach ($results as $result) {
                $this->addColumn('warehouse_' . $result['warehouse_id'], array(
                    'header' => 'Qty Received for ' . $result['warehouse_name'],
                    'name' => 'warehouse_' . $result['warehouse_id'],
                    'type' => 'number',
                    'index' => 'warehouse_' . $result['warehouse_id'],
                    'filter' => false,
                    'editable' => true,
                    'edit_only' => true,
                    'align' => 'right',
                    'sortable' => false,
                    'renderer' => 'inventorypurchasing/adminhtml_purchaseorder_edit_tab_renderer_delivery_warehouse'
                ));
            }
        }

        $this->addColumn('qty_delivery', array(
            'header' => Mage::helper('inventorypurchasing')->__('Total Qty Received'),
            'name' => 'qty_delivery',
            'type' => 'number',
            'index' => 'qty_delivery'
        ));

        $this->addColumn('created_by', array(
            'header' => Mage::helper('inventorypurchasing')->__('Created by'),
            'name' => 'create_by',
            'index' => 'created_by'
        ));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/deliveryGrid', array(
                    '_current' => true,
                    'id' => $this->getRequest()->getParam('id'),
                    'store' => $this->getRequest()->getParam('store')
                ));
    }

    protected function _getSelectedDeliveries() {
        $deliveries = $this->getDeliveries();
        if (!is_array($deliveries)) {
            $deliveries = array_keys($this->getSelectedRelatedDeliveries());
        }
        return $deliveries;
    }

    public function getSelectedRelatedDeliveries() {
        $deliveries = array();
        $purchaseOrder = $this->getPurchaseOrder();
        $deliveryCollection = Mage::getResourceModel('inventorypurchasing/purchaseorder_delivery_collection')
                ->addFieldToFilter('purchase_order_id', $purchaseOrder->getId());
        foreach ($deliveryCollection as $delivery) {
            $deliveries[$delivery->getDeliveryId()] = array('qty' => $delivery->getQty());
        }
        return $deliveries;
    }

    /**
     * get Current Purchase Order
     *
     * @return Magestore_Inventory_Model_Purchaseorder
     */
    public function getPurchaseOrder() {
        return Mage::getModel('inventorypurchasing/purchaseorder')->load($this->getRequest()->getParam('id'));
    }

    /**
     * get currrent store
     *
     * @return Mage_Core_Model_Store
     */
    public function getStore() {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

    public function getResetFilterButtonHtml() {
        return $this->getChildHtml('create_delivery_button') . $this->getChildHtml('create_all_delivery_button') . parent::getResetFilterButtonHtml();
    }

    public function checkCreateNewDelivery() {
        $canDelivery = false;
        $adminId = Mage::getModel('admin/session')->getUser()->getId();
        if (!$adminId)
            return null;
        $purchaseOrderId = $this->getRequest()->getParam('id');
        $purchaseOrder = Mage::getModel('inventorypurchasing/purchaseorder')->load($purchaseOrderId);
        $warehouseIds = $purchaseOrder->getWarehouseId();
        $warehouseIds = explode(',', $warehouseIds);
        $warehouseAssigneds = Mage::getModel('inventoryplus/warehouse_permission')->getCollection()
                ->addFieldToFilter('admin_id', $adminId);
        $warehouseAvailableIds = array();
        foreach ($warehouseAssigneds as $warehouseAssigned) {
            if ($warehouseAssigned->getData('can_purchase_product'))
                $warehouseAvailableIds[] = $warehouseAssigned->getWarehouseId();
        }        
        //check if create all product
        $purchaseOrderProducts = Mage::getModel('inventorypurchasing/purchaseorder_productwarehouse')
                ->getCollection()              
                ->addFieldToFilter('warehouse_id' , array('in' => $warehouseAvailableIds))
                ->addFieldToFilter('purchase_order_id', $purchaseOrderId);
        foreach($purchaseOrderProducts as $purchaseOrderProduct){            
            $check = $purchaseOrderProduct->getQtyOrder() - $purchaseOrderProduct->getQtyReceived() - $purchaseOrderProduct->getQtyReturned();
            if($check > 0){
                $canDelivery = true;
                break;
            }
        }
        
        return $canDelivery;
    }

    public function checkCreateAllDelivery() {	
		$canAllDelivery = true;
		$purchaseOrderId = $this->getRequest()->getParam('id');
		if ($purchaseOrderId) {
			$resource = Mage::getSingleton('core/resource');
			$readConnection = $resource->getConnection('core_read');
			$installer = Mage::getModel('core/resource');
			$sql = 'SELECT distinct(`warehouse_id`),warehouse_name,qty_order from ' . $installer->getTableName("erp_inventory_purchase_order_product_warehouse") . ' WHERE (purchase_order_id = ' .$purchaseOrderId . ')';
			$results = $readConnection->fetchAll($sql);
			if (count($results) > 0) {
				foreach ($results as $result) {
					if($result['warehouse_id']){
						if(!Mage::helper('inventoryplus')->getPermission($result['warehouse_id'], 'can_purchase_product')){
							$canAllDelivery = false;
						}
					}
				}
			}
		}
		return $canAllDelivery;
    }

    public function filterCreatedOn($collection, $column) {
        return $this;
    }
    
    public function getRowUrl($row)
    {
        return false;
    }

}