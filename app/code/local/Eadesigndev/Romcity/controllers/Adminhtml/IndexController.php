<?php

/**
 *
 * @author Ea Design
 */
class  Eadesigndev_Romcity_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function citiesAction()
    {
        if (!$this->getRequest()->isXmlHttpRequest()) {
            return;
        }

        $cityId = (int)$this->getRequest()->getParam('city_id');
        $countryId = $this->getRequest()->getParam('country_id');

        if (!$cityId || !$countryId) {
            return;
        }

        echo Mage::helper('romcity')->getCities($countryId, $cityId);

        return;
    }

    protected function _isAllowed()
    {
        return true;
    }
}
