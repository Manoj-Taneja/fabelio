<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */

if (version_compare(Mage::getVersion(), '1.5.0.0', '>='))
{
    class Amasty_Orderstatus_Model_Sales_Order_Config extends Mage_Sales_Model_Order_Config
    {
        public function getStatuses()
        {
            $hideState = false;
            if (Mage::getStoreConfig('amorderstatus/general/hide_state')) {
                $hideState = true;
            }
            $statuses = parent::getStatuses();
            $statusesCollection = Mage::getModel('amorderstatus/status')->getCollection()->load();
            if ($statusesCollection->getSize() > 0) {
                $config = Mage::getConfig();
                foreach ($config->getNode('global/sales/order/states')->children() as $state => $node) {
                    $label = Mage::helper('sales')->__(trim( (string) $node->label ) );
                    $states[$label] = $state;
                }
                foreach ($states as $stateLabel => $state) {
                    foreach ($statusesCollection as $status) {
                        if ($status->getData('is_active') && !$status->getData('is_system')) {
                            // checking if we should apply status to the current state
                            $parentStates = array();
                            if ($status->getParentState()) {
                                $parentStates = explode(',', $status->getParentState());
                            }
                            if (!$parentStates || in_array($state, $parentStates)) {
                                $elementName = $state . '_' . $status->getAlias();
                                $statuses[$elementName] = ( $hideState ? '' : $stateLabel . ': ' ) . Mage::helper('amorderstatus')->__($status->getStatus());
                            }
                        }
                    }
                }
            }
            return $statuses;
        }
        
        public function getStateStatuses($stateToGetFor, $addLabels = true)
        {
            $hideState = false;
            if (Mage::getStoreConfig('amorderstatus/general/hide_state')) {
                $hideState = true;
            }
            $statuses = parent::getStateStatuses($stateToGetFor, $addLabels);
            $statusesCollection = Mage::getModel('amorderstatus/status')->getCollection()->load();
            if ($statusesCollection->getSize() > 0) {
                $config = Mage::getConfig();
                foreach ($config->getNode('global/sales/order/states')->children() as $state => $node) {
                    $label = Mage::helper('sales')->__(trim( (string) $node->label ) );
                    $states[$label] = $state;
                }
                foreach ($states as $stateLabel => $state) {
                    if ($stateToGetFor == $state) {
                        foreach ($statusesCollection as $status) {
                            if ($status->getData('is_active') && !$status->getData('is_system')) {
                                // checking if we should apply status to the current state
                                $parentStates = array();
                                if ($status->getParentState()) {
                                    $parentStates = explode(',', $status->getParentState());
                                }
                                if (!$parentStates || in_array($state, $parentStates)) {
                                    $elementName = $state . '_' . $status->getAlias();
                                    if ($addLabels) {
                                        $statuses[$elementName] = ( $hideState ? '' : $stateLabel . ': ' ) . Mage::helper('amorderstatus')->__($status->getStatus());
                                    } else {
                                        $statuses[] = $elementName;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return $statuses;
        }
        
        public function getStatusLabel($code)
        {
            $hideState = false;
            if (Mage::getStoreConfig('amorderstatus/general/hide_state')) {
                $hideState = true;
            }
            $statusLabel = parent::getStatusLabel($code);
            if (!$statusLabel) {
                $statusesCollection = Mage::getModel('amorderstatus/status')->getCollection()->load();
                if ($statusesCollection->getSize() > 0) {
                    $config = Mage::getConfig();
                    foreach ($config->getNode('global/sales/order/states')->children() as $state => $node) {
                        $label = Mage::helper('sales')->__(trim( (string) $node->label ) );
                        $states[$label] = $state;
                    }
                    foreach ($states as $stateLabel => $state) {
                        foreach ($statusesCollection as $status) {
                            if ($status->getData('is_active') && !$status->getData('is_system')) {
                                // checking if we should apply status to the current state
                                $parentStates = array();
                                if ($status->getParentState()) {
                                    $parentStates = explode(',', $status->getParentState());
                                }
                                if (!$parentStates || in_array($state, $parentStates)) {
                                    $elementName = $state . '_' . $status->getAlias();
                                    if ($code == $elementName) {
                                        $statusLabel = ( $hideState ? '' : $stateLabel . ': ' ) . Mage::helper('amorderstatus')->__($status->getStatus());
                                        break(2);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return $statusLabel;
        }
    }
} else 
{
    class Amasty_Orderstatus_Model_Sales_Order_Config extends Mage_Sales_Model_Order_Config {}
}