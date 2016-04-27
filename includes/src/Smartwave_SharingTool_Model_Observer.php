<?php

class Smartwave_SharingTool_Model_Observer
{
  public function addButtonsHtml($observer)
    {
      $block = $observer->getBlock();
      $transport = $observer->getTransport();
    }  
}