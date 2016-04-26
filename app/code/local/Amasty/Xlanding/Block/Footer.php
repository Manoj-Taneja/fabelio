<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

class Amasty_Xlanding_Block_Footer extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate("amasty/amlanding/footer.phtml");
    }

    protected function _getPage(){
        return Mage::registry('amlanding_page');
    }

    protected function getHeading(){
        return $this->_getPage()->getLayoutHeading();
    }

    protected function getDescription(){
        return $this->_getPage()->getLayoutDescription();
    }

    protected function getFile(){
        return $this->_getPage()->getLayoutFileUrl();
    }

    protected function getFileMobile(){
        return $this->_getPage()->getLayoutFileMobileUrl();
    }

    protected function getFileName(){
        return $this->_getPage()->getLayoutFileName();
    }

    protected function getFileAlt(){
        return $this->_getPage()->getLayoutFileAlt();
    }
}
?>
