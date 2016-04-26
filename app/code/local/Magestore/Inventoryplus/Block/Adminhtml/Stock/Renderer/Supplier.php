<?php
class Magestore_Inventoryplus_Block_Adminhtml_Stock_Renderer_Supplier extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $product_id = $row->getEntityId();
        $supplier_products = Mage::getModel('inventorypurchasing/supplier_product')
            ->getCollection()
            ->addFieldToFilter('product_id',$product_id);
		$content = '';
		$check = 0;
        if(count($supplier_products) == 0){
            $content = 'No Supplier';
        }
        foreach($supplier_products as $supplier_product){
            $supplier_id = $supplier_product->getSupplierId();
            $url = Mage::helper('adminhtml')->getUrl('inventorypurchasingadmin/adminhtml_supplier/edit',array('id'=>$supplier_id));
            $supplier = Mage::getModel('inventorypurchasing/supplier')
                ->getCollection()
                ->addFieldToFilter('supplier_id',$supplier_id)
                ->getFirstItem();
            $name = $supplier->getSupplierName();
			if(in_array(Mage::app()->getRequest()->getActionName(),array('exportCsv','exportXml','exportCsvProductInfo','exportXmlProductInfo')))
			{
				if($check)
				$content.=', '.$name;
				else
				$content.=$name;
			}
			else
            $content .= "<a href=".$url.">$name;<a/>"."<br/>";
			$check++;
        }
        return $content;
    }

}

?>
