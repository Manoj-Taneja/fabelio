<?php
class Sprint_Migs_Model_Observer
{
  public function setPaymentSession($observer) {
    Mage::getSingleton('core/session')->unsMigsSiteId();
    $payment = Mage::app()->getRequest()->getPost('payment', array());
    $installment = false;
    switch($payment['method']) {
      case 'bri':
        $installment = $payment['bri_installment'];
        break;
      case 'permata':
        $installment = $payment['permata_installment'];
        break;
      case 'bcacredit':
        $installment = $payment['bca_credit_installment'];
        break;
      case 'sc':
        $installment = $payment['sc_installment'];
        break;

    }
    if(!$installment) return;
    $siteId = 'Fabelio';
    switch($installment){
      case 'bri3':
        $siteId = 'fabelioBRI3';
        break;
      case 'bri6':
        $siteId = 'fabelioBRI6';
        break;
      case 'bri12':
        $siteId = 'fabelioBRI12';
        break;
      case 'permata3':
        $siteId = 'fabeliopermata3';
        break;
      case 'permata6':
        $siteId = 'fabeliopermata6';
        break;
      case 'permata12':
        $siteId = 'fabeliopermata12';
        break;
      case 'bca3':
        $siteId = 'FabelioBCA3';
        break;
      case 'bca6':
        $siteId = 'FabelioBCA6';
        break;
      case 'bca12':
        $siteId = 'FabelioBCA12';
        break;
      case 'sc3':
        $siteId = 'fabelioSCB3';
        break;
      case 'sc6':
        $siteId = 'fabelioSCB6';
        break;
      case 'sc12':
        $siteId = 'fabelioSCB12';
        break;


    }
    Mage::getSingleton('core/session')->setMigsSiteId($siteId);
  }
}
