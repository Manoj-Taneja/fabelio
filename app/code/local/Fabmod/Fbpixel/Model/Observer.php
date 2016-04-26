<?php
class Fabmod_Fbpixel_Model_Observer{
 public function fbaccounttrack($observer){
   Mage::getModel('core/session')->setFbPixUserRegistered("true");
 }
 public function fbuserlogin($observer){
   Mage::getModel('core/session')->setFbPixUserLoggedIn("true");
 }

}
?>
