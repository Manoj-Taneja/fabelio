<?php
class Cminds_Supplierfrontendproductuploader_Model_Session extends Mage_Core_Model_Session_Abstract {

    public function __construct() {

        $namespace = 'supplierfrontendproductuploader';

        $this->init($namespace);
        Mage::dispatchEvent('supplierfrontendproductuploader_session_init', array('supplierfrontendproductuploader_session' => $this));
    }
}
