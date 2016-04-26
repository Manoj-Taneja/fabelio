<?php
/**
 * Magento
 *
 * @author    WakaMage http://www.wakamage.com <cs@wakamage.com>
 * @copyright Copyright (C) 2013 WakaMage. (http://www.wakamage.com)
 *
 */
class Sprint_Migs_Block_Payment_Form_Bcacredit extends Mage_Payment_Block_Form
{
    /**
     * Set template and redirect message
     */
    protected function _construct() {
      $this->setTemplate('migs/payment/redirectbcacredit.phtml')
        ->setMethodTitle('Cicilan 0% Kartu Kredit Bank BCA');
		
			return parent::_construct();    
	}
}
