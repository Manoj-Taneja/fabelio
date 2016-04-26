<?php
class  Eadesigndev_Romcity_Model_Eacore_Observer
{
    public function preDispatch(Varien_Event_Observer $observer)
    {
//        exit('test');
        if (Mage::getSingleton('admin/session')->isLoggedIn()) {

            $feedModel  = Mage::getModel('romcity/eacore_feed');

            $feedModel->checkUpdate();
        }
    }
}