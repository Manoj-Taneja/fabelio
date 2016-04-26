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
 * @package     Magestore_Inventorydashboard
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Inventorydashboard Adminhtml Controller
 * 
 * @category    Magestore
 * @package     Magestore_Inventorydashboard
 * @author      Magestore Developer
 */
class Magestore_Inventorydashboard_Adminhtml_InventorydashboardController extends Mage_Adminhtml_Controller_Action
{
    /**
     * init layout and set active for current menu
     *
     * @return Magestore_Inventorydashboard_Adminhtml_InventorydashboardController
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('inventoryplus')
            ->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Items Manager'),
                Mage::helper('adminhtml')->__('Item Manager')
            );
        return $this;
    }
 
    /**
     * index action
     */
    public function indexAction()
    {
        $this->_title($this->__('Inventory'))
             ->_title($this->__('Dashboard'));
        $this->_initAction()
            ->renderLayout();
    }

    /**
     * view and edit item action
     */
    public function editAction()
    {
        $inventorydashboardId     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('inventorydashboard/inventorydashboard')->load($inventorydashboardId);

        if ($model->getId() || $inventorydashboardId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('inventorydashboard_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('inventoryplus');

            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Item Manager'),
                Mage::helper('adminhtml')->__('Item Manager')
            );
            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Item News'),
                Mage::helper('adminhtml')->__('Item News')
            );

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('inventorydashboard/adminhtml_inventorydashboard_edit'))
                ->_addLeft($this->getLayout()->createBlock('inventorydashboard/adminhtml_inventorydashboard_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventorydashboard')->__('Item does not exist')
            );
            $this->_redirect('*/*/');
        }
    }
 
    public function newAction()
    {
        $this->_forward('edit');
    }
 
    /**
     * save item action
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            if (isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {
                try {
                    /* Starting upload */    
                    $uploader = new Varien_File_Uploader('filename');
                    
                    // Any extention would work
                       $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                    $uploader->setAllowRenameFiles(false);
                    
                    // Set the file upload mode 
                    // false -> get the file directly in the specified folder
                    // true -> get the file in the product like folders 
                    //    (file.jpg will go in something like /media/f/i/file.jpg)
                    $uploader->setFilesDispersion(false);
                            
                    // We set media as the upload dir
                    $path = Mage::getBaseDir('media') . DS ;
                    $result = $uploader->save($path, $_FILES['filename']['name'] );
                    $data['filename'] = $result['file'];
                } catch (Exception $e) {
                    $data['filename'] = $_FILES['filename']['name'];
                }
            }
              
            $model = Mage::getModel('inventorydashboard/inventorydashboard');        
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));
            
            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('inventorydashboard')->__('Item was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('inventorydashboard')->__('Unable to find item to save')
        );
        $this->_redirect('*/*/');
    }
 
    /**
     * delete item action
     */
    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('inventorydashboard/inventorydashboard');
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Item was successfully deleted')
                );
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * mass delete item(s) action
     */
    public function massDeleteAction()
    {
        $inventorydashboardIds = $this->getRequest()->getParam('inventorydashboard');
        if (!is_array($inventorydashboardIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($inventorydashboardIds as $inventorydashboardId) {
                    $inventorydashboard = Mage::getModel('inventorydashboard/inventorydashboard')->load($inventorydashboardId);
                    $inventorydashboard->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted',
                    count($inventorydashboardIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
    
    /**
     * mass change status for item(s) action
     */
    public function massStatusAction()
    {
        $inventorydashboardIds = $this->getRequest()->getParam('inventorydashboard');
        if (!is_array($inventorydashboardIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($inventorydashboardIds as $inventorydashboardId) {
                    Mage::getSingleton('inventorydashboard/inventorydashboard')
                        ->load($inventorydashboardId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($inventorydashboardIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export grid item to CSV type
     */
    public function exportCsvAction()
    {
        $fileName   = 'inventorydashboard.csv';
        $content    = $this->getLayout()
                           ->createBlock('inventorydashboard/adminhtml_inventorydashboard_grid')
                           ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export grid item to XML type
     */
    public function exportXmlAction()
    {
        $fileName   = 'inventorydashboard.xml';
        $content    = $this->getLayout()
                           ->createBlock('inventorydashboard/adminhtml_inventorydashboard_grid')
                           ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('inventoryplus');
    }
    
    
    //save new dashboard tab
    public function savetabAction()
    {
        $data = $this->getRequest()->getPost();
        if($data){
            $name = $data['dashboard_name'];            
            if($this->getRequest()->getParam('tab_id')){                
                $model = Mage::getModel('inventorydashboard/tabs')->load($this->getRequest()->getParam('tab_id'));
                $model->setData('name',$name)                      
                      ->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('inventorydashboard')->__('The dashboard has been saved.')
                );
            }else{                
                $position = 0;
                $tabCollection = Mage::getModel('inventorydashboard/tabs')->getCollection()
                                                ->setOrder('position','DESC')
                                                ->getFirstItem();
                if($tabCollection->getId()){
                    $position = $tabCollection->getPosition() + 1;
                }
                $model = Mage::getModel('inventorydashboard/tabs');            
                $model->setData('name',$name)
                      ->setData('position',$position)
                      ->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('inventorydashboard')->__('The dashboard has been created.')
                );
            }
            $this->_redirect('*/*/',array('tab_id'=>$model->getId()));
        }else{
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventorydashboard')->__('Unable to find dashboard tab to save')
            );
            $this->_redirect('*/*/');
        }
    }
    
    //delete dashboard tab
    public function deletetabAction()
    {        
        if($tabId = $this->getRequest()->getParam('tab_id')){
            $model = Mage::getModel('inventorydashboard/tabs')->load($tabId);
            $model->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('inventorydashboard')->__('Dashboard tab was successfully delete')
            );            
            $this->_redirect('*/*/');
        }else{
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventorydashboard')->__('Unable to find dashboard tab to delete')
            );
            $this->_redirect('*/*/');
        }
    }
    
    
    
    //save tabs position
    public function savetabpositionAction()
    {        
        $data = $this->getRequest()->getPost();
        if($data){
            $dashboardIds = explode(',',$data['DashboardIDs']);
            $i = 1;
            $countSql = 0;
            $resource = Mage::getSingleton('core/resource');
            $writeConnection = $resource->getConnection('core_write');
            $sql = '';
            foreach($dashboardIds as $dashboardId){
                if($dashboardId){
                    $sql .= 'UPDATE ' . $resource->getTableName('inventorydashboard/tabs') . ' 
                                                    SET `position` = \'' . $i . '\'
                                                            WHERE `tab_id` =' . $dashboardId . ';';
                    $i++;
                    $countSql++;
                }
                if ($countSql == 900) {
                    $writeConnection->query($sql);
                    $countSql = 0;
                }
            }
            if (!empty($sql)) {                
                $writeConnection->query($sql);
            }
        }
    }
    
    //save new chart 
    public function savechartAction()
    {
        $data = $this->getRequest()->getPost();
        $tabId = $this->getRequest()->getParam('tab_id');
        if($data){
            $name = $data['chart_name'];
            $reportType = $data['report_type'];
            $chartType = $data['chart_type'];
            $position = 0;
            if(isset($data['item_id']) && $id = $data['item_id']){
                $model = Mage::getModel('inventorydashboard/items')->load($id);
                $model->setData('name',$name)                      
                      ->setData('chart_code',$chartType)
                      ->setData('report_code',$reportType)
                      ->save();
                $tabId = $model->getTabId();
            }else{
                $itemCollection = Mage::getModel('inventorydashboard/items')->getCollection()
                                                ->addFieldToFilter('tab_id',$tabId)
                                                ->addFieldToFilter('item_column',1)
                                                ->setOrder('item_row','DESC')
                                                ->getFirstItem();
                if($itemCollection->getId()){
                    $position = $itemCollection->getItemRow() + 1;
                }
                $model = Mage::getModel('inventorydashboard/items');                        
                $model->setData('name',$name)
                      ->setData('tab_id',$tabId)
                      ->setData('item_column',1)
                      ->setData('item_row',$position)
                      ->setData('chart_code',$chartType)
                      ->setData('report_code',$reportType)
                      ->save();
            }
            if(!$tabId){
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('inventorydashboard')->__('The chart has been created.')
                );
            }else{
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('inventorydashboard')->__('The chart has been saved.')
                );
            }
            $this->_redirect('*/*/',array('tab_id'=>$tabId));
        }else{
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('inventorydashboard')->__('Unable to find chart to save')
            );
            $this->_redirect('*/*/');
        }
    }
    
    //save view items position
    public function saveviewpositionAction()
    {
        $postions = $this->getRequest()->getPost('Positions');
        if($postions){
            $postions = json_decode($postions,true);
            $countSql = 0;
            $resource = Mage::getSingleton('core/resource');
            $writeConnection = $resource->getConnection('core_write');
            $sql = '';
            foreach($postions as $postion){
                if($postion){
                    $sql .= 'UPDATE ' . $resource->getTableName('inventorydashboard/items') . ' 
                                                    SET `item_column` = \'' . $postion['Column'] . '\',
                                                        `item_row` = \'' . $postion['Row'] . '\'
                                                            WHERE `item_id` =' . $postion['ViewID'] . ';';                    
                    $countSql++;
                }
                if ($countSql == 900) {
                    $writeConnection->query($sql);
                    $countSql = 0;
                }
            }
            if (!empty($sql)) {                
                $writeConnection->query($sql);
            }
        }
    }
    
    //change chart type
    public function changecharttypeAction()
    {
        $response = '';
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('read_write');
        $reportCode = $this->getRequest()->getParam('report_code');
        $sql = 'Select distinct(`chart_code`) from '.$resource->getTableName('erp_inventory_dashboard_chart_report').' where `report_code` = \''.$reportCode.'\'';        
        $results = $readConnection->query($sql);
        foreach($results as $result){            
            $image =  Mage::getBaseUrl('media').'inventorydashboard/charttype/'.$result['chart_code'].'.png';       
            $response .= '<li style="float:left;margin-right:15px">
                <input type="radio" class="radio validate-one-required-by-name validation-passed" value="'.$result['chart_code'].'" name="chart_type" title="'.$result['chart_code'].'" />
                <label for="chart_pie"><img src ="'.$image.'" title="'.$result['chart_code'].'" /></label>
                </li>';
        }
        echo $response;
    }
    
    //show edit item(chart) form
    public function edititemformAction()
    {
        if($id = $this->getRequest()->getParam('item_id')){
            echo $this->getLayout()->createBlock('adminhtml/template')->setItemId($id)->setTemplate('inventorydashboard/edititemform.phtml')->toHtml();
        }else{
            return '';
        }
    }
    
    //delete item(chart)
    public function deleteitemAction()
    {
        if($id = $this->getRequest()->getParam('item_id')){
            $item = Mage::getModel('inventorydashboard/items')->load($id);
            $item->delete();
        }
    }
    
    public function changeWarehouseAction(){
        $params = $this->getRequest()->getParams();
        $chart = Mage::getModel('inventorydashboard/items')->load($params['code'],'report_code');
        
        $cookie = Mage::getSingleton('core/cookie');
        $cookie->set($params['code'].$params['box_id'].'chart_warehouse_id', $params['warehouse_id'] ,time()+3600);

        
        $result = array();
        $result['success'] = true;
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));  
    }
}