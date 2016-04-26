<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */
class Amasty_Xlanding_Block_Adminhtml_Page_Csvgrid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('ruleGrid');
        $this->setDefaultSort('pos');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('amlanding/page')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _getListColumns(){
        $listColumns = Mage::helper('amlanding/import')->getColumnsForCsv();
        $listColumns['attributes']['renderer'] = 'amlanding/adminhtml_renderer_condition';
        $listColumns['layout_update_xml']['renderer'] = 'amlanding/adminhtml_renderer_html';
        $listColumns['layout_description']['renderer'] = 'amlanding/adminhtml_renderer_html';
        return $listColumns;
    }

    protected function _getDefaultParamsForColumn()
    {
        return array(
            'align' => 'left',
        );
    }

    protected function _prepareColumns()
    {
        $defaultColumnParams = $this->_getDefaultParamsForColumn();

        foreach($this->_getListColumns() as $field=>$params) {
            $params = array_merge($defaultColumnParams, $params);

            if(!isset($params['index'])) {
                $params['index'] = $field;
            } elseif($params['index'] === false) {
                unset($params['index']);
            }
            $this->addColumn($field, $params);
        }

        return parent::_prepareColumns();
    }




    /**
     * Retrieve a file container array by grid data as CSV
     *
     * Return array with keys type and value
     *
     * @return array
     */
    public function getCsvFile($delimiter = ';', $enclosure = '"')
    {
        $this->_isExport = true;
        $this->_prepareGrid();

        $io = new Varien_Io_File();

        $path = Mage::getBaseDir('var') . DS . 'export' . DS;
        $name = md5(microtime());
        $file = $path . DS . $name . '.csv';

        $io->setAllowCreateFolders(true);
        $io->open(array('path' => $path));
        $io->streamOpen($file, 'w+');
        $io->streamLock(true);
        $io->streamWriteCsv($this->_getExportHeaders(), $delimiter, $enclosure);

        $this->_exportIterateCollection('_exportCsvItem', array($io, $delimiter, $enclosure));

        if ($this->getCountTotals()) {
            $io->streamWriteCsv($this->_getExportTotals(), $delimiter, $enclosure);
        }

        $io->streamUnlock();
        $io->streamClose();

        return array(
            'type'  => 'filename',
            'value' => $file,
            'rm'    => true // can delete file after use
        );
    }

    /**
     * Write item data to csv export file
     *
     * @param Varien_Object $item
     * @param Varien_Io_File $adapter
     */
    protected function _exportCsvItem(Varien_Object $item, Varien_Io_File $adapter, $delimiter = ';', $enclosure = '"')
    {
        $row = array();
        foreach ($this->_columns as $column) {
            if (!$column->getIsSystem()) {
                $row[] = $column->getRowFieldExport($item);
            }
        }
        $adapter->streamWriteCsv($row, $delimiter, $enclosure);
    }

    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }
}