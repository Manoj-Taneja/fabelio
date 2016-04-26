<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Model_Observer
{
    public function initStatuses($observer)
    {
        if (version_compare(Mage::getVersion(), '1.5.0.0', '>=')) {
            return;
        }
        
        /**
        * All these applies to 1.3-1.4 only
        */
        
        $config = Mage::getConfig();
        foreach ($config->getNode('global/sales/order/states')->children() as $state => $node) {
            $label = Mage::helper('sales')->__(trim( (string) $node->label ) );
            $states[$label] = $state;
        }

        $statusesCollection = Mage::getModel('amorderstatus/status')->getCollection()->load();
        if ($statusesCollection->getSize() < 1) {
            return true;
        }
        
        $hideState = false;
        if (Mage::getStoreConfig('amorderstatus/general/hide_state')) {
            $hideState = true;
        }
        
        $xml = '<?xml version="1.0"?>
                <config>
                    <global>
                        <sales>
                            <order>
                                <statuses>
                                ';
                                
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
                                                $xml .= '<' . $elementName . ' translate="label" amorderstatus="1"><label><![CDATA[' . ( $hideState ? '' : $stateLabel . ': ' ) . Mage::helper('amorderstatus')->__($status->getStatus()) . ']]></label></' . $elementName . '>' . "\r\n";
                                            }
                                        }
                                    }
                                }
                                
                                // replacing default status names
                                // do not replace if we are on edit default statuses page
                                if (false === strpos(Mage::app()->getRequest()->getPathInfo(), 'status/system')) {
                                    foreach ($statusesCollection as $status) {
                                        if ($status->getData('is_system')) {
                                            $xml .= '<' . $status->getAlias() . ' translate="label"><label>' . $status->getStatus() . '</label></' . $status->getAlias() . '>' . "\r\n";
                                        }
                                    }
                                }
                                        
        $xml .= 
                                '
                                
                                </statuses>
                                <states>
                                ';
                                
                                foreach ($states as $state) {
                                    $xml .= '<' . $state . '><statuses>' . "\r\n";
                                    foreach ($statusesCollection as $status) {
                                        if (!$status->getData('is_system')) {
                                            $parentStates = array();
                                            if ($status->getParentState()) {
                                                $parentStates = explode(',', $status->getParentState());
                                            }
                                            if (!$parentStates || in_array($state, $parentStates)) {
                                                $xml .= '    <' . $state . '_' . $status->getAlias() . '/>' . "\r\n";
                                            }
                                        }
                                    }
                                    $xml .= '</statuses></' . $state . '>' . "\r\n";
                                }
                                
        $xml .=                 '
                                </states>
                            </order>
                        </sales>
                    </global>
                </config>
        ';
        
        
        /*d(htmlspecialchars($xml), 1);*/
        
        $base = new Mage_Core_Model_Config_Base();
        $base->loadString($xml);
        $config->extend($base);
    }
}