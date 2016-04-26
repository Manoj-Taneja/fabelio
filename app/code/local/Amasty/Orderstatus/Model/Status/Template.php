<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Orderstatus
 */
class Amasty_Orderstatus_Model_Status_Template extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('amorderstatus/status_template');
    }
    
    public function saveTemplates($storeEmailTemplate, Amasty_Orderstatus_Model_Status $statusModel)
    {
        $this->getResource()->removeStatusTemplates($statusModel->getId());
        if (!empty($storeEmailTemplate)) {
            foreach ($storeEmailTemplate as $storeId => $templateId) {
                $template = Mage::getModel('amorderstatus/status_template');
                $data = array(
                    'status_id'	    => $statusModel->getId(),
                    'store_id'		=> $storeId,
                    'template_id'	=> $templateId
                );
                $template->addData($data)->save();
            }
        }
    }
    
    /**
     * Adds e-mail template IDs to the status model object
     * 
     * @param Amasty_Orderstatus_Model_Status $statusModel
     */
    public function attachTemplates(Amasty_Orderstatus_Model_Status $statusModel)
    {
        $collection = $this->getResourceCollection();
        $collection->addFieldToFilter('status_id', array('eq' => $statusModel->getId()));
        foreach ($collection as $template) {
            $key = 'store_template[' . $template->getStoreId() . ']';
            $statusModel->setData($key, $template->getTemplateId());
        }
    }
    
    public function loadTemplateId($statusId, $storeId)
    {
        return $this->getResource()->loadTemplateId($statusId, $storeId);
    }
}