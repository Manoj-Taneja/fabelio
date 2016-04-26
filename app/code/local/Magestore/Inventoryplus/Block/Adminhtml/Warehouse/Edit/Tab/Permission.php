<?php

class Magestore_Inventoryplus_Block_Adminhtml_Warehouse_Edit_Tab_Permission extends Mage_Adminhtml_Block_Widget_Grid {

    protected $_disable = array();

    public function __construct() {
        parent::__construct();
        $this->setId('permissionGrid');
        $this->setDefaultSort('user_id');
        $this->setDefaultDir('ASC');
        $this->setUseAjax(true); // Using ajax grid is important
        $this->setPagerVisibility(false);
        $this->setDefaultLimit(1000);
    }

    protected function _getSelectedAssignments() {
        $assignments = $this->getAssignments();
        if (!is_array($assignments))
            $assignments = array_keys($this->getSelectedAssignments());
        return $assignments;
    }

    public function _getSelectedUsers() {
        return array();
    }

    /**
     * get select assignment of warehouse
     * @return int
     */
    public function getSelectedAssignments() {
        $assignments = array();
        $warehouse = $this->getWarehouse();
        $collection = Mage::getResourceModel('inventoryplus/warehouse_permission_collection')
                ->addFieldToFilter('warehouse_id', $warehouse->getId());
        foreach ($collection as $assignment) {
            $assignments[$assignment->getId()] = array('position' => 0);
        }
        return $assignments;
    }

    public function getWarehouse() {
        return Mage::getModel('inventoryplus/warehouse')
                        ->load($this->getRequest()->getParam('id'));
    }

    protected function _prepareCollection() {
        $admin = Mage::getSingleton('admin/session')->getUser();
        $warehouse = $this->getWarehouse();
        $collection = Mage::getModel('admin/user')->getCollection();
        if ($warehouse->getWarehouseId()) {
            if ($admin->getUsername() == $warehouse->getCreatedBy() || $admin->getUsername() == $warehouse->getManager()) {
                $collection->addFieldToFilter('username', array(
                    'nin' => array($warehouse->getManager(), $warehouse->getCreatedBy())
                ));
            } else {
                $collection->addFieldToFilter('username', $admin->getUsername());
            }
        } else {
            $collection->addFieldToFilter('username', array(
                'nin' => array($admin->getUsername())
            ));
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $admin = Mage::getSingleton('admin/session')->getUser();
        $warehouse = $this->getWarehouse();
        if ($warehouse->getWarehouseId()) {
            if ($admin->getUsername() != $warehouse->getManager() && $admin->getUsername() != $warehouse->getCreatedBy()) {
                $this->_disable[] = $admin->getId();
            }
        }
        $this->addColumn('user_id', array(
            'header' => Mage::helper('inventoryplus')->__('Admin ID'),
            'sortable' => true,
            'index' => 'user_id',
            'type' => 'number',
        ));

        $this->addColumn('username', array(
            'header' => Mage::helper('inventoryplus')->__('User Name'),
            'sortable' => true,
            'index' => 'username',
        ));

        $this->addColumn('can_edit_warehouse', array(
            'header' => Mage::helper('inventoryplus')->__('Edit Warehouse'),
            'header_css_class' => 'a-center',
            'type' => 'checkbox',
            'field_name' => 'edit[]',
            'align' => 'center',
            'index' => 'user_id',
            'sortable' => false,
            'filter' => false,
            'disabled_values' => $this->_disable,
            'values' => $this->_getSelectedCanEditAdmins(),
        ));

        $this->addColumn('can_adjust', array(
            'header' => Mage::helper('inventoryplus')->__('Adjust Stock'),
            'sortable' => false,
            'filter' => false,
            'width' => '60px',
            'type' => 'checkbox',
            'index' => 'user_id',
            'align' => 'center',
            'field_name' => 'adjust[]',
            'disabled_values' => $this->_disable,
            'values' => $this->_getSelectedCanAdjustAdmins()
        ));

        Mage::dispatchEvent('inventory_adminhtml_add_column_permission_grid', array('grid' => $this, 'disabled' => $this->_disable));

        return parent::_prepareColumns();
    }

    protected function _getSelectedCanEditAdmins() {
        $warehouse = $this->getWarehouse();
        if ($warehouse->getId()) {
            $canEditAdmins = Mage::getModel('inventoryplus/warehouse_permission')->getCollection()
                    ->addFieldToFilter('warehouse_id', $warehouse->getId())
                    ->getAllCanEditAdmins();
        } else {
            $adminId = Mage::getSingleton('admin/session')->getUser()->getId();
            $canEditAdmins = array($adminId);
        }
        return $canEditAdmins;
    }

    protected function _getSelectedCanAdjustAdmins() {
        $warehouse = $this->getWarehouse();
        if ($warehouse->getId())
            $canEditAdmins = Mage::getModel('inventoryplus/warehouse_permission')->getCollection()
                    ->addFieldToFilter('warehouse_id', $warehouse->getId())
                    ->getAllCanAdjustAdmins();
        else {
            $adminId = Mage::getSingleton('admin/session')->getUser()->getId();
            $canEditAdmins = array($adminId);
        }
        return $canEditAdmins;
    }

    public function getGridUrl() {
        return $this->getData('grid_url') ? $this->getData('grid_url') : $this->getUrl('*/*/permissionGrid', array('_current' => true, 'id' => $this->getRequest()->getParam('id')));
    }
    
    public function getRowUrl(){
        return false;
    }
}

?>
