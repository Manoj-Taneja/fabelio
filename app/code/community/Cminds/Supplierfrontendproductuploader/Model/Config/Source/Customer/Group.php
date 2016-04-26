<?php
    class Cminds_Supplierfrontendproductuploader_Model_Config_Source_Customer_Group {
        public function toOptionArray() {
            $customer_group = new Mage_Customer_Model_Group();
            $allGroups  = $customer_group->getCollection();
            $allSet = array();

            foreach($allGroups AS $attributeSet) {
                $allSet[] = array('value' => $attributeSet->getCustomerGroupId(), 'label' => $attributeSet->getCustomerGroupCode());
            }

            return $allSet;
        }
    }
