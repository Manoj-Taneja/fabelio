<?php
/**
 * Creates the select values in the configuration by pulling all catalog product
 * attributes from the Magento DB.
 *
 * @package     BlueAcorn\Optimizely
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
class BlueAcorn_Optimizely_Model_System_Config_Source_Attribute
{
    /**
     * Options select for different types of custom text attributes
     *
     * @return array
     */
    public function toOptionArray()
    {
        $entityTypeId = Mage::getModel('eav/entity')
                ->setType(Mage_Catalog_Model_Product::ENTITY)
                ->getTypeId();

        $attributes = Mage::getResourceModel('catalog/product_attribute_collection')
                ->setEntityTypeFilter($entityTypeId)
                ->getItems();

        $excluded = array('sku', 'price', 'name');
        $attributeOptions = array(
            array('value' => '', 'label' => ''),
        );

        foreach ($attributes as $attribute) {
            $code  = $attribute['attribute_code'];
            $label = $attribute['frontend_label'];
            if (!in_array($code, $excluded) && strlen($label) > 0) {
                array_push(
                    $attributeOptions,
                    array(
                       'value' => $code,
                       'label' => $label,
                   )
                );
            }
        }
        uasort($attributeOptions, array($this, 'attributeOptionArrayComparison'));

        return $attributeOptions;
    }

    static public function attributeOptionArrayComparison($a, $b)
    {
        if ($a['label'] == $b['label']) {
            return 0;
        }
        return ($a['label'] < $b['label']) ? -1 : 1;
    }
}


