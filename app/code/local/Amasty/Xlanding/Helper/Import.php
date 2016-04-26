<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */

/**
 * Created by PhpStorm.
 * User: sumrak
 * Date: 19.12.2014
 * Time: 18:06
 */

class Amasty_Xlanding_Helper_Import
{
	public function getColumnsForCsv()
	{
		$hlp =  Mage::helper('amlanding');

		return array(
			/*'pade_id' => array(
				'header'    => $hlp->__('ID'),
				'align'     => 'right',
				'width'     => '50px',
			),*/
			'title' => array(
				'header'    => $hlp->__('Page Name'),
			),

			'root_template' => array(
				'header'    => $hlp->__('Page Layout: Layout'),
			),

			'meta_title' => array(
				'header'    => $hlp->__('Meta Data: Title'),
			),
			'meta_keywords' => array(
				'header'    => $hlp->__('Meta Data: Keywords'),
			),
			'meta_description' => array(
				'header'    => $hlp->__('Meta Data: Description'),
			),
			'identifier' => array(
				'header'    => $hlp->__('Meta Data: URL Key'),
			),
			'is_active' => array(
				'header'    => Mage::helper('cms')->__('Status'),
			),

			'layout_update_xml' => array(
				'header'    => $hlp->__('Page Layout: Layout Update XML'),
			),

			'is_new' => array(
				'header'    => $hlp->__('State: Is New'),
			),
			/*'is_sale' => array(
				'header'    => $hlp->__('ASDadsasd'),
			),*/
			'is_sale_by_rule' => array(
				'header'    => $hlp->__('State: Is on Sale'),
			),
			/*'include_type' => array(
				'header'    => $hlp->__(''),
			),*/
			/*'include_sku' => array(
				'header'    => $hlp->__('ASDadsasd'),
			),*/
			'category' => array(
				'header'    => $hlp->__('Category'),
			),
			'attributes' => array(
				'header'    => $hlp->__('Condition'),
			),
			/*'stock_less' => array(
				'header'    => $hlp->__('ASDadsasd'),
			),
			'stock_more' => array(
				'header'    => $hlp->__('ASDadsasd'),
			),*/
			'stock_status' => array(
				'header'    => $hlp->__('Stock: Status'),
			),
			'layout_heading' => array(
				'header'    => $hlp->__('Page Design: Heading'),
			),
			// Поля загруженного файла
			/*'layout_file' => array(
				'header'    => $hlp->__('ASDadsasd'),
			),
			'layout_file_name' => array(
				'header'    => $hlp->__('ASDadsasd'),
			),
			'layout_file_alt' => array(
				'header'    => $hlp->__('Page Design: Image Alt'),
			),*/
			'layout_description' => array(
				'header'    => $hlp->__('Page Design: Description'),
			),

			'layout_static_top' => array(
				'header'    => $hlp->__('Page Design: Top Static Block'),
			),

			'layout_static_bottom' => array(
				'header'    => $hlp->__('Page Design: Bottom Static Block'),
			),

			'include_navigation' => array(
				'header'    => $hlp->__('Page Design: Include Navigation'),
			),
			'columns_count' => array(
				'header'    => $hlp->__('Page Design: Columns Count'),
			),
			/*'include_menu' => array(
				'header'    => $hlp->__('ASDadsasd'),
			),*/
			/*'include_menu_position' => array(
				'header'    => $hlp->__('ASDadsasd'),
			),*/
			'default_sort_by' => array(
				'header'    => $hlp->__('Page Design: Default Product Listing Sort By'),
			),
			'advanced_filter_condition' => array(
				'header'    => $hlp->__('Advanced Filter: Condition'),
			),
			'conditions_serialized' => array(
				'header'    => $hlp->__('Conditions Serialized'),
			),
		);
	}


	public function getColumnsAliasesForCsv()
	{
		$listAliasesColumns = array();
		foreach ($this->getColumnsForCsv() as $columnName=>$columnData) {
			$listAliasesColumns[$columnData['header']] = $columnName;
		}

		return $listAliasesColumns;
	}

	/**
	 * @param string $serializedCondition
	 * @return string encoded array condition for csv
	 */
	public function encodeConditionForCsv($serializedCondition)
	{
		$lineConditionFormat = "code|cond|value";
		$listLinesCondition = array();
		$listCondition = unserialize($serializedCondition);
		foreach ($listCondition as $condition) {
			$listLinesCondition[] = str_replace(array_keys($condition), array_values($condition), $lineConditionFormat);
		}

		return implode("||", $listLinesCondition);
	}

	/**
	 * @param string $condition
	 * @return bool|string serialized condition
	 */
	public function decodeConditionFromCsv($condition)
	{
		$listLinesCondition = explode("||", $condition);
		if(count($listLinesCondition) <= 0) {
			return false;
		}
		$listCondition = array();
		foreach($listLinesCondition as $lineCondition) {
			$condition = explode("|", $lineCondition);
			if(count($condition) < 3) {
				return false;
			}
			$listCondition[] = array(
				'code' => $condition[0],
				'cond' => $condition[1],
				'value' => $condition[2],
			);
		}

		return serialize($listCondition);
	}
}