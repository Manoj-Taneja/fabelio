<?php
    class Cminds_Supplierfrontendproductuploader_Model_Config_Source_Attribute_Set {
        public function toOptionArray() {
            $entityType = Mage::getModel('catalog/product')->getResource()->getTypeId();
            $collection = Mage::getResourceModel('eav/entity_attribute_set_collection')->setEntityTypeFilter($entityType);
            $allSet = array();

            foreach($collection AS $attributeSet) {
                $allSet[] = array('value' => $attributeSet->getAttributeSetId(), 'label' => $attributeSet->getAttributeSetName());
            }

            return $allSet;
        }
    }
