<?php
class Cminds_Supplierfrontendproductuploader_Model_Image extends Mage_Core_Model_Abstract {
    public function cleanUpCache() {
        foreach (new DirectoryIterator(Mage::getBaseDir('upload')) as $fileInfo) {
            if(!$fileInfo->isDot()) {
                unlink($fileInfo->getPathname());
            }
        }
    }
}
