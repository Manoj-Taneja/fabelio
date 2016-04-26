<?php
class Cminds_Supplierfrontendproductuploader_Block_Product_List extends Mage_Core_Block_Template
{
    public function _construct()
    {
        parent::_construct();
    }

    public function getItems() {
        $supplier_id = Mage::helper('supplierfrontendproductuploader')->getSupplierId();

        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('creator_id')
            ->addAttributeToSelect('frontendproduct_product_status')
            ->addAttributeToFilter(array(array('attribute' => 'creator_id', 'eq' => $supplier_id)))
            ->setOrder('entity_id');

        $status = $this->getRequest()->getParam('status');
        $name = $this->getRequest()->getParam('name', null);

        if($name) {
            $collection->addFieldToFilter(
                array(
                   array('attribute' => 'name', 'like' => '%'.$name.'%'),
            ));
        }

        switch($status) {
            case 'pending':
                $collection->addAttributeToFilter(array(array('attribute' => 'frontendproduct_product_status', 'eq' => Cminds_Supplierfrontendproductuploader_Model_Product::STATUS_PENDING)));
                break;
            case 'active':
                $collection->addAttributeToFilter(array(array('attribute' => 'frontendproduct_product_status', 'eq' => Cminds_Supplierfrontendproductuploader_Model_Product::STATUS_APPROVED)));
                break;
            case 'inactive':
                $collection->addAttributeToFilter(array(array('attribute' => 'frontendproduct_product_status', 'eq' => Cminds_Supplierfrontendproductuploader_Model_Product::STATUS_NONACTIVE)));
                break;
            case 'disapproved':
                $collection->addAttributeToFilter(array(array('attribute' => 'frontendproduct_product_status', 'eq' => Cminds_Supplierfrontendproductuploader_Model_Product::STATUS_DISAPPROVED)));
                break;
            default:
                break;
        }

        $page = Mage::app()->getRequest()->getParam('p', 1);
        $collection->setPageSize(10)->setCurPage($page);

        return $collection;
    }

    public function getStatusLabel($status) {
        switch ($status) {
            case Cminds_Supplierfrontendproductuploader_Model_Product::STATUS_PENDING:
                return $this->__('Pending');
                break;
            case Cminds_Supplierfrontendproductuploader_Model_Product::STATUS_APPROVED:
                return $this->__('Approved');
                break;
            case Cminds_Supplierfrontendproductuploader_Model_Product::STATUS_DISAPPROVED:
                return $this->__('Disapproved');
                break;
            case Cminds_Supplierfrontendproductuploader_Model_Product::STATUS_NONACTIVE:
                return $this->__('Not Active');
                break;
            default:        
                return $this->__('Unknown');
            break;
        }
    }
}
