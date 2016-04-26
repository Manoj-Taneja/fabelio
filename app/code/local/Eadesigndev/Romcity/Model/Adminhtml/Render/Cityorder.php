<?php

/**
 * Created by IntelliJ IDEA.
 * User: eadesignpc
 * Date: 5/7/2015
 * Time: 3:07 PM
 */
class Eadesigndev_Romcity_Model_Adminhtml_Render_Cityorder implements Varien_Data_Form_Element_Renderer_Interface
{
    public function render(Varien_Data_Form_Element_Abstract $element)
    {

        $countryId = false;
        if ($country = $element->getForm()->getElement('country_id')) {
            $countryId = $country->getValue();
        }

        $regionId = false;
        if ($region = $element->getForm()->getElement('region_id')) {
            $regionId = $region->getValue();
        }

        $city = false;
        if ($cityData = $element->getForm()->getElement('city')) {
            $city = $cityData->getValue();
        }

        $cities = Mage::helper('romcity')->getCitiesAsOptions($countryId, $regionId);
        $cityData = $cities->getData();

//        echo '<pre>';
//        print_r($cityData);
//        echo '</pre>';

        $htmlAttributes = $element->getHtmlAttributes();
        foreach ($htmlAttributes as $key => $attribute) {
            if ('type' === $attribute) {
                unset($htmlAttributes[$key]);
                break;
            }
        }

        $regionHtmlName = $element->getName();
        $changeJs = '';
        if($regionHtmlName=='order[billing_address][city]'){
            $changeJs = 'onchange="syncCity(this)"';
        }
        $regionIdHtmlName = str_replace('region', 'region_id', $regionHtmlName);
        $regionHtmlId = $element->getHtmlId();
        $regionIdHtmlId = str_replace('region', 'region_id', $regionHtmlId);

        $html = '<tr>' . "\n";
        $html .= '<td class="label">' . $element->getLabelHtml() . '</td>';
        $html .= '<td class="value">';

        if (!empty($cityData)) {
            $html .= '<select id="' . $element->getHtmlId(). '" '.$changeJs.' name="' . $element->getName() . '" '
                . $element->serialize($htmlAttributes) . '>' . "\n";
            foreach ($cityData as $myCity) {

                $selected = ($myCity['cityname'] == $city) ? ' selected="selected"' : '';
                $html .= '<option value="' . $myCity['cityname'] . '"' . $selected . '>'
                    . Mage::helper('adminhtml')->escapeHtml(Mage::helper('directory')->__($myCity['cityname']))
                    . '</option>';
            }
            $html .= '</select>' . "\n";
        } else {
            $html = '<tr>' . "\n";
            $html .= '<td class="label">' . $element->getLabelHtml() . '</td>';
            $html .= '<td class="value">';
            $html .= '<input id="' . $regionHtmlId . '" '.$changeJs.' name="' . $regionHtmlName
                . '" value="' . $element->getEscapedValue() . '" '
                . $element->serialize($htmlAttributes) . "/>" . "\n";

            $html .= '</td>' . "\n";
            $html .= '</tr>' . "\n";
        }


        $html .= '</td>' . "\n";
        $html .= '</tr>' . "\n";
        return $html;


    }

}