<?php
/**
 * Ptech Multi Select Layer Navigation
 *  
 * @category     Ptech
 * @package      Ptech_Multilayer 
 * @copyright    Copyright (c) 2014-2015 Ptech
 * @author       Ptech (Brijesh Kumar)  
 * @version      Release: 1.0.0
 * @Class        Ptech_Multilayer_FrontController
 * @Overwrite    Mage_Core_Controller_Front_Action
 */
class Ptech_Multilayer_FrontController extends Mage_Core_Controller_Front_Action {

    public function categoryAction() {
        // init category
        $categoryId = (int) $this->getRequest()->getParam('id', false);
        if (!$categoryId) {
            $this->_forward('noRoute');
            return;
        }

        $category = Mage::getModel('catalog/category')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($categoryId);
        Mage::register('current_category', $category);


        $this->loadLayout();

        $response = array();
        $response['layer'] = $this->getLayout()->getBlock('layer')->toHtml();
        $response['products'] = $this->getLayout()->getBlock('root')->toHtml();

        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        
        
    }

    public function searchAction() {
        $this->loadLayout();
        $response = array();
        $response['layer'] = $this->getLayout()->getBlock('layer')->toHtml();
        $response['products'] = $this->getLayout()->getBlock('root')->setIsSearchMode()->toHtml();
        
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
    }

}
