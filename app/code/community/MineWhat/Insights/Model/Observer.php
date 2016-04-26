<?php

class MineWhat_Insights_Model_Observer
{

  const CONFIG_ACTIVE = 'minewhat_insights/settings/active';
  const CONFIG_API_KEY = 'minewhat_insights/settings/api_key';

  public function onSaveSettings($observer) {

    $enabled = Mage::getStoreConfig(self::CONFIG_ACTIVE);
    $api_key = Mage::getStoreConfig(self::CONFIG_API_KEY);
    $store_url = Mage::getBaseUrl();
    $magento_version = Mage::getVersion();

    file_get_contents("https://app.minewhat.com/stats/magentoinstall?enabled=".$enabled."&api_key=".$api_key."&store_url=".$store_url."&magentoversion=".$magento_version);

  }

  public function logCartAdd($observer) {

    if (!$observer->getQuoteItem()->getProduct()->getId()) {
      return;
    }

    $product = $observer->getProduct();
    $id = $observer->getQuoteItem()->getProduct()->getId();
    $bundle = array();

    if($product->getTypeId() == 'bundle') {

      $id = $product->getId();
      $optionCollection = $product->getTypeInstance()->getOptionsCollection();
      $selectionCollection = $product->getTypeInstance()->getSelectionsCollection($product->getTypeInstance()->getOptionsIds());
      $options = $optionCollection->appendSelections($selectionCollection);
      foreach( $options as $option )
      {
        $_selections = $option->getSelections();
        foreach( $_selections as $selection )
        {
          $bundleItem = array();
          $bundleItem['pid'] = $selection->getId();
          $bundleItem['sku'] = $selection->getSku();
          $bundleItem['price'] = $selection->getPrice();
          $bundle[] = $bundleItem;
        }
      }

    }

    $parentId = '';
    $parentIds = Mage::getModel('catalog/product_type_configurable')->getParentIdsByChild($id);
    if($parentIds != null && count($parentIds) > 0) {
      $parentId = $parentIds[0];
    }
    Mage::getModel('core/session')->setProductToShoppingCart(
      array(
        'id' => $id,
        'sku' => $product->getSku(),
        'parentId' => $parentId,
        'qty' => $product->getQty(),
        'bundle' => $bundle
      )
    );

  }
}
