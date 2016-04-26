<?php
class Cminds_Marketplace_Block_Adminhtml_Billing_List_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected $_countTotals = true;
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('id');
        $this->setId('billing_list_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $code           = $this->getEavAttrCode();
        $tableName      = Mage::getSingleton("core/resource")->getTableName("catalog_product_entity_int");
        $orderTable     = Mage::getSingleton('core/resource')->getTableName('sales/order');
        $supplierPayment = Mage::getSingleton('core/resource')->getTableName('marketplace/payments');
        $collection     = Mage::getModel('sales/order_item')->getCollection();

        $collection->addExpressionFieldToSelect('vendor_amount', 'SUM(price-(price*(vendor_fee/100)))', 'vendor_fee');

        $collection->getSelect()
            ->joinInner(array('o' => $orderTable), 'o.entity_id = main_table.order_id', array('status', 'state', 'subtotal', 'increment_id'))
            ->joinInner(array('e' => $tableName), 'e.entity_id = main_table.product_id AND e.attribute_id = ' . $code, array('value as supplier_id') )
            ->joinLeft(array('p' => $supplierPayment), 'p.order_id = main_table.order_id AND p.supplier_id = supplier_id', array('amount AS payment_amount', 'payment_date', 'id AS payment_id'))
            ->where('main_table.parent_item_id is null')
            ->where('e.value IS NOT NULL')
            ->where('o.state != "canceled"');

        $collection->getSelect()->group('o.entity_id', 'e.value');

        $this->setCollection($collection);
        $s =  parent::_prepareCollection();

        return $s;
    }

    protected function _prepareColumns()
    {
        $this->addColumn('supplier_id', array(
            'header'    => Mage::helper('marketplace')->__('Vendor ID'),
            'width'     => '50px',
            'index'     => 'supplier_id',
            'filter_index' => 'e.value'
        ));
        $this->addColumn('order_id', array(
            'header'    => Mage::helper('marketplace')->__('Order Id'),
            'index'     => 'increment_id',
            'type'  => 'number',
        ));
        $this->addColumn('created_at', array(
            'header'    => Mage::helper('marketplace')->__('Date'),
            'index'     => 'created_at',
            'type'      => 'datetime',
            'filter_index' => 'o.created_at',
            'gmtoffset' => true
        ));
        $this->addColumn('order_status', array(
            'header'    => Mage::helper('marketplace')->__('Order Status'),
            'width'     => '150',
            'index'     => 'status',
            'type'  => 'options',
            'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
        ));

        $this->addColumn('subtotal', array(
            'header'    => Mage::helper('marketplace')->__('Subtotal'),
            'width'     => '100',
            'index'     => 'subtotal',
            'type'  => 'price',
            'currency_code' => (string)Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
        ));

        $this->addColumn('vendor_amount', array(
            'header'    => Mage::helper('marketplace')->__('Net Income'),
            'width'     => '100',
            'index'     => 'vendor_amount',
            'type'      => 'price',
            'currency_code' => (string)Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
        ));

        $this->addColumn('payed_amount', array(
            'header'    => Mage::helper('marketplace')->__('Payed Amount'),
            'width'     => '90',
            'index'     => 'payment_amount',
            'type'      => 'price',
            'currency_code' => (string)Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
        ));

        $this->addColumn('payed_date', array(
            'header'    => Mage::helper('marketplace')->__('Payed Date'),
            'index'     => 'payment_date',
            'type'      => 'datetime',
            'gmtoffset' => true
        ));

        $this->addColumn('owning', array(
            'header'    => Mage::helper('marketplace')->__('Owing'),
            'index'     => 'owning',
            'totals_label' => '',
            'filter'    => false,
            'align'   => 'center',
            'type' => 'price',
            'renderer'  => 'Cminds_Marketplace_Block_Adminhtml_Billing_List_Grid_Renderer_Owning'
        ));

        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('marketplace')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'renderer'  => 'Cminds_Marketplace_Block_Adminhtml_Billing_List_Grid_Renderer_Action',
                'totals_label' => '',
                'filter'    => false,
                'sortable'  => false,
                'is_system' => true,
            ));

        $this->addExportType('*/*/exportCsv', Mage::helper('marketplace')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('marketplace')->__('Excel XML'));
        return parent::_prepareColumns();
    }

    public function getTotals()
    {
        $totals = new Varien_Object();
        $fields = array(
            'payment_amount' => 0,
            'vendor_amount' => 0,
            'subtotal' => 0,
            'owning' => 0,
        );
        foreach ($this->getCollection() as $item) {
            foreach($fields as $field => $value){
                if($field == 'owning') {
                } else {
                    $fields[$field] += $item->getData($field);
                }
            }
        }
        $fields['supplier_id'] = 'Totals';
        $totals->setData($fields);
        return $totals;
    }

    private function getEavAttrCode() {
        $eavAttribute   = new Mage_Eav_Model_Mysql4_Entity_Attribute();
        return $eavAttribute->getIdByCode('catalog_product', 'creator_id');
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('order_id' => $row->getOrderId(), 'supplier_id' => $row->getSupplierId()));
    }
}