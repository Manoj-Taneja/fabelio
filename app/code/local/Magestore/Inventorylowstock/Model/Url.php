<?php
class Magestore_Inventorylowstock_Model_Url extends Mage_Adminhtml_Model_Url{
    public function getSecretKey($controller = null, $action = null)
    {
        $params = $this->getRequest()->getParams();
        if(isset($params['key']) && $params['key'] && isset($params['uncheck_url_key']) && $params['uncheck_url_key']==true){
            return $params['key'];
        }
       
        return parent::getSecretKey($controller, $action);       
    }    
}

