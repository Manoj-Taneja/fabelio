<?php

class Magestore_Inventorypurchasing_Block_Adminhtml_Purchaseorder_Renderer_Supplier extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $supplier_id = $row->getSupplierId();
        $contentCSV = '';
        $content = '';
		$url = Mage::helper('adminhtml')->getUrl('inventorypurchasingadmin/adminhtml_supplier/edit',array('id'=>$supplier_id));
		$name = $row->getSupplierName();
		$content .= "<a href=".$url.">$name<a/>"."<br/>";
		$contentCSV = $name;

        if(in_array(Mage::app()->getRequest()->getActionName(),array('exportCsv','exportXml')))
            return $contentCSV;
        return '<label>'.$content.'</label>';
        
    }

}

?>
