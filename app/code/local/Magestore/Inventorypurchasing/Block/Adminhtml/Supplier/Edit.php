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
 * Inventory Supplier Edit Block
 * 
 * @category     Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventorypurchasing_Block_Adminhtml_Supplier_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'inventorypurchasing';
        $this->_controller = 'adminhtml_supplier';

        $this->_updateButton('save', 'label', Mage::helper('inventorypurchasing')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('inventorypurchasing')->__('Delete'));
        
        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
            Event.observe('auto_general_password','click',function(){
                if($('auto_general_password').checked){
                    $('new_password').value = '';
                    $('new_password').disable();
                }else{
                    $('new_password').enable();
                }
            });
            var id = '" . $this->getRequest()->getParam('id', null) . "';
            function toggleEditor() {
                if (tinyMCE.getInstanceById('inventory_content') == null)
                    tinyMCE.execCommand('mceAddControl', false, 'inventory_content');
                else
                    tinyMCE.execCommand('mceRemoveControl', false, 'inventory_content');
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
			
            function fileSelected() {
                var file = document.getElementById('fileToUpload').files[0];
                if (file) {
                    var fileSize = 0;
                    if (file.size > 1024 * 1024)
                        fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
                    else
                        fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';

                    document.getElementById('fileName').innerHTML = 'Name: ' + file.name;
                    document.getElementById('fileSize').innerHTML = 'Size: ' + fileSize;
                    document.getElementById('fileType').innerHTML = 'Type: ' + file.type;
                }
            }

            function uploadFile() {
                if(!$('fileToUpload') || !$('fileToUpload').value){
                    alert('Please choose CSV file to import!');return false;
                }
                if($('loading-mask')){
                    $('loading-mask').style.display = 'block';
                    $('loading-mask').style.height = '900px';                    
                    $('loading-mask').style.width = '1500px';                    
                    $('loading-mask').style.top = '0';                    
                    $('loading-mask').style.left = '-2';                    
                }
                var fd = new FormData();
                fd.append('fileToUpload', document.getElementById('fileToUpload').files[0]);
                fd.append('form_key', document.getElementById('form_key').value);
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', uploadProgress, false);
                xhr.addEventListener('load', uploadComplete, false);
                xhr.addEventListener('error', uploadFailed, false);
                xhr.addEventListener('abort', uploadCanceled, false);
                xhr.open('POST', '" . $this->getUrl('inventorypurchasingadmin/adminhtml_supplier/importproduct') . "');
                xhr.send(fd);
           }

           function uploadProgress(evt) {
           }

           function uploadComplete(evt) {
               $('supplier_tabs_products_section').addClassName('notloaded');
               supplier_tabsJsTabs.showTabContent($('supplier_tabs_products_section'));               
           }

           function uploadFailed(evt) {
                alert('There was an error attempting to upload the file.');
           }

           function uploadCanceled(evt) {
                alert('The upload has been canceled by the user or the browser dropped the connection.');
           }
           
           function showhistory(supplierHistoryId){
                var url = '" . $this->getUrl('inventorypurchasingadmin/adminhtml_supplier/showhistory') . "';               
                var supplierHistoryId = supplierHistoryId;                
                var url = url+'supplierHistoryId/'+supplierHistoryId;
                TINY.box.show(url,1, 800, 400, 1);
            }    
         
        ";
    }

    /**
     * get text to show in header when edit an item
     *
     * @return string
     */
    public function getHeaderText() {
        if (Mage::registry('inventorypurchasing_supplier_data')
                && Mage::registry('inventorypurchasing_supplier_data')->getId()
        ) {
            return Mage::helper('inventorypurchasing')->__("Edit Supplier '%s'", $this->htmlEscape(Mage::registry('inventorypurchasing_supplier_data')->getSupplierName())
            );
        }
        return Mage::helper('inventorypurchasing')->__('Add Supplier');
    }

}