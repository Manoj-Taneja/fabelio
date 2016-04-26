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
 * Inventory Adjust Stock Edit Block
 * 
 * @category     Magestore
 * @package     Magestore_Inventory
 * @author      Magestore Developer
 */
class Magestore_Inventoryplus_Block_Adminhtml_Adjuststock_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'inventoryplus';
        $this->_controller = 'adminhtml_adjuststock';
        $this->_updateButton('save', 'label', Mage::helper('inventoryplus')->__('Save'));
        $this->_updateButton('save', 'onclick', 'saveAction()');
        $this->_addButton('cancel', array('label' => Mage::helper('inventoryplus')->__('Cancel'), 'class'=>'cancel', 'onclick' => 'cancelAction()') );
        $this->_addButton('confirm', array('label' => Mage::helper('inventoryplus')->__('Confirm'), 'class'=>'save', 'onclick' => 'confirmAction()') );
        $this->_updateButton('reset', 'onclick', 'setLocation(\'' . $this->getUrl('inventoryplusadmin/adminhtml_adjuststock/new') . '\')');
        // if ($warehouseBack = $this->getRequest()->getParam('warehouseback_id'))
        //     $this->_updateButton('back', 'onclick', 'setLocation(\'' . $this->getUrl('inventoryplusadmin/adminhtml_warehouse/edit/id/' . $warehouseBack) . '\')');
        $this->removeButton('delete');
        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save & Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);
        if ($this->getRequest()->getParam('id')) {

            $this->removeButton('reset');
            $model = Mage::getModel('inventoryplus/adjuststock')->load($this->getRequest()->getParam('id'));
            $warehouses = Mage::helper('inventoryplus/adjuststock')->getWarehouseByAdmin();
            $permission = Mage::helper('inventoryplus')->getPermission($model->getWarehouseId(), 'can_adjust');
            if(!$permission || $model->getStatus()==1 || $model->getStatus()==2 || !count($warehouses)){
                $this->removeButton('cancel');
                $this->removeButton('save');
                $this->removeButton('saveandcontinue');
                $this->removeButton('confirm');
            }
        } else {
            $this->removeButton('cancel');
        }
       
        if(!Mage::helper('inventoryplus/adjuststock')->getWarehouseByAdmin()){
            $this->removeButton('cancel');
            $this->removeButton('confirm');
            $this->removeButton('save');
            $this->removeButton('saveandcontinue');
            $this->removeButton('reset');
        }
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('inventory_content') == null)
                    tinyMCE.execCommand('mceAddControl', false, 'inventory_content');
                else
                    tinyMCE.execCommand('mceRemoveControl', false, 'inventory_content');
            }
            
            function isNumeric(n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            }

            function validateQty(){
                var adjustFields = document.getElementsByName('adjust_qty');
                for(var i = 0;i<adjustFields.length;i++){
                    var el = adjustFields[i];
                    if(!el.disabled && el.tagName == 'INPUT'){
                        if(!el.value || el.value < 0 || !isNumeric(el.value) ){
                            var messageDiv = document.getElementById('messages');
                            messageDiv.innerHTML = '';
                            var ulMessage = document.createElement('UL');
                            ulMessage.className = 'messages';
                            var liMessage = document.createElement('LI');
                            liMessage.className = 'error-msg';
                            var textnode = document.createTextNode('".Mage::helper('inventoryplus/adjuststock')->__("Adjust Qty. does not accept negative values or blank. Please enter a valid value.")."');
                            liMessage.appendChild(textnode);
                            ulMessage.appendChild(liMessage);
                            messageDiv.appendChild(ulMessage);
                            var body = document.getElementsByTagName('BODY')[0];
                            body.scrollTop = 50;
                            return false;
                        } 
                    } 
                }
                return true;
            }

            function saveAndContinueEdit(){
                var validate = validateQty();
                if(validate){
                    var r=confirm('".Mage::helper('inventoryplus')->__('Are you sure you want to save this stock adjustment?')."');  
                    if (r==true){
                        editForm.submit($('edit_form').action+'back/edit/');
                    }
                }
            }
            

            function saveAction(){
                var validate = validateQty();
                if(validate){
                    var r=confirm('".Mage::helper('inventoryplus')->__('Are you sure you want to save this stock adjustment?')."');  
                    if (r==true){
                        editForm.submit();
                    }
                }
            }
            
            function confirmAction(){
                var validate = validateQty();
                if(validate){
                    var r=confirm('".Mage::helper('inventoryplus')->__('Are you sure you want to confirm this stock adjustment?')."');  
                    if (r==true){
                      editForm.submit($('edit_form').action+'confirm/adjuststock');
                    }
                }
            }
            
            function confirmAction(){
                var validate = validateQty();
                if(validate){
                    if(editForm.validate()) {
                        var r=confirm('".Mage::helper('inventoryplus')->__('Are you sure you want to confirm this stock receiving? Qty. of products in the system will be increased by the Qty. received instantly.')."');  
                        if (r==true){
                            editForm.submit($('edit_form').action+'confirm/1/');
                        }
                    }
                }
            }

            function cancelAction(){
                var r=confirm('".Mage::helper('inventoryplus')->__('Are you sure you want to cancel this stock adjustment?')."');  
                if (r==true){
                    editForm.submit($('edit_form').action+'cancel/1/');
                }
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
                }
                var fd = new FormData();
                fd.append('fileToUpload', document.getElementById('fileToUpload').files[0]);
                fd.append('form_key', document.getElementById('form_key').value);
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange=function()
                {
                    if (xhr.readyState==4 && xhr.status==200)
                    {
                        if(xhr.responseText != ''){
                            alert(xhr.responseText);
                        }
                    }
                }
                xhr.upload.addEventListener('progress', uploadProgress, false);
                xhr.addEventListener('load', uploadComplete, false);
                xhr.addEventListener('error', uploadFailed, false);
                xhr.addEventListener('abort', uploadCanceled, false);
                xhr.open('POST', '" . $this->getUrl('inventoryplusadmin/adminhtml_adjuststock/importproduct') . "');
                xhr.send(fd);
            }

            function uploadProgress(evt) {

            }
            var reason = '';
            function uploadComplete(evt) {
                reason = $('reason').value;
                $('adjuststock_tabs_form_section').addClassName('notloaded');
                adjuststock_tabsJsTabs.showTabContent($('adjuststock_tabs_form_section'));   
               
                setTimeout(function(){
                     $('reason').value = reason;
                },1500);
            }

            function uploadFailed(evt) {
                alert('There was an error attempting to upload the file.');
            }

            function uploadCanceled(evt) {
                alert('The upload has been canceled by the user or the browser dropped the connection.');
            }

        ";
    }

    /**
     * get text to show in header when edit an item
     *
     * @return string
     */
    public function getHeaderText() {
        if (Mage::registry('adjuststock_data')
                && Mage::registry('adjuststock_data')->getId()
        ) {
            return Mage::helper('inventoryplus')->__("View Stock Adjustment No. '%s'", $this->htmlEscape(Mage::registry('adjuststock_data')->getId())
            );
        }
        return Mage::helper('inventoryplus')->__('Add Stock Adjustment');
    }

}