<?php
class Fabmod_Feed_Helper_Data extends Mage_Core_Helper_Abstract {

  public function getBrand($product){
     $manufacturer = $product->getAttributeText('manufacturer');
     if(!$manufacturer) return "Fabelio";
     $manufacturer = trim($manufacturer);
     $fabelioDesigners = Array('Fabelio Design Studio', '---', 'Fitria Noviianti', 'Guida Arezzi', 'Reza Anwar', 'Sadhiya Hanindita', '');
     if(in_array($manufacturer, $fabelioDesigners)) return "Fabelio";
     return $manufacturer;
  }
}
