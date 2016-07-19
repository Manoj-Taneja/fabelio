<?php
/**
 * Ptech Multi Select Layer Navigation
 *  
 * @category     Ptech
 * @package      Ptech_Multilayer 
 * @copyright    Copyright (c) 2014-2015 Ptech
 * @author       Ptech (Brijesh Kumar)  
 * @version      Release: 1.0.0
 * @Class        Ptech_Multilayer_CategoryController
 * @Overwrite    Mage_Core_Controller_Front_Action
 */
class Ptech_Multilayer_CategoryController extends Mage_Core_Controller_Front_Action {

    public function viewAction() {

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


        $this->getLayout()->createBlock('multilayer/catalog_layer_view');
        $this->loadLayout();
        $this->renderLayout();
    }

}
