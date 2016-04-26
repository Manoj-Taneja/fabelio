<?php 
/**
 * Magento
 *
 * @author    WakaMage http://www.wakamage.com <cs@wakamage.com>
 * @copyright Copyright (C) 2013 WakaMage. (http://www.wakamage.com)
 *
 */
class Sprint_Migs_Block_Sending extends Mage_Core_Block_Abstract {
  protected function _toHtml() {
    $form = new Varien_Data_Form();
    $form->setAction(Mage::getUrl('migs/payment/redirect',array('_secure'=>true)))
      ->setId('migsredirect')
      ->setName('migsredirect')
      ->setMethod('POST')
      ->setUseContainer(true);
    $submitButton = new Varien_Data_Form_Element_Submit(array(
      'value' => $this->__('Klik disini jika dalam 5 detik belum diarahkan'),
    ));
    $form->addElement($submitButton);
    $html = '<html><body>';
    $html.= $this->__('<p>Sekarang Anda akan diarahkan untuk melakukan pembayaran.</p>');
    $html.= $form->toHtml();
    $html.= '<script type="text/javascript">document.getElementById("migsredirect").submit();</script>';
    $html.= '</body></html>';

    return $html;
  }
}
