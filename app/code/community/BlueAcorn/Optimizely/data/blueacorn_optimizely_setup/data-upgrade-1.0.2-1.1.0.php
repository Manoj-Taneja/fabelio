<?php
/**
 * @package     BlueAcorn\Optimizely
 * @version     1.1.0
 * @author      Blue Acorn, Inc. <code@blueacorn.com>
 * @copyright   Blue Acorn, Inc. 2014
 */
$config = new Mage_Core_Model_Config();

$settings = array(
    'settings/enabled',
    'settings/revenue_tracking',
    'settings/optimizely_project_code',
);

foreach($settings as $setting) {
    $val = Mage::getStoreConfig("optimizely/$setting");
    $config->saveConfig("blueacorn_optimizely/$setting", $val);
    $config->deleteConfig("optimizely/$setting");
}

$cust_attrs = array(
    'project_settings/optimizely_custom_one',
    'project_settings/optimizely_custom_two',
    'project_settings/optimizely_custom_three',
    'project_settings/optimizely_custom_four',
);

$attributes = array();
foreach($cust_attrs as $setting) {

    $val = Mage::getStoreConfig("optimizely/$setting");

    if ($val) {
        $attributes[] = array(
            'attribute' => $val,
        );
    }
    $config->deleteConfig("optimizely/$setting");
};

$config->saveConfig("blueacorn_optimizely/project_settings/attributes", serialize($attributes));

