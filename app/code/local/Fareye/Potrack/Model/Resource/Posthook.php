<?php
class Fareye_Potrack_Model_Resource_Posthook   extends Mage_Core_Model_Resource_Db_Abstract 
{
   protected function _construct()
         {
            $this->_init('fareye_potrack', 'id');
         }
}
