<?php
class Fabmod_Mixpanel_Model_Observer{
 public function accounttrack($observer){
   Mage::getModel('core/session')->setNewUserRegistered("true");
 }
 
 public function logintrack($observer){
   Mage::getModel('core/session')->setUserLoggedIn("true");
 }

}
?>
