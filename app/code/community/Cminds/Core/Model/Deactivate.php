<?php
class Cminds_Core_Model_Deactivate extends Cminds_Core_Model_Core {
    public function run($group_id) { 
        $this->before(false, $group_id);
        $this->deactivateLicense();
    }
}