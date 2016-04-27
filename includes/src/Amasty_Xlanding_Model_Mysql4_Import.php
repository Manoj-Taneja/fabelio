<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Xlanding
 */


class Amasty_Xlanding_Model_Mysql4_Import extends Mage_Core_Model_Mysql4_Abstract
{
	/**
	 * Holds array of columns from import file
	 * @var array
	 */
	private $_columns = array();
	
	/**
	 * Existing Landing Pages
	 */
	private $_existingPages = array();

    /**
     * Identifiers from loaded file
     * @var array
     */
    private $_loadedPageIdentifiers = array();
	
	
	/**
	 * List or errors during import
	 * @var array
	 */
	private $_importErrors = array();
	
  	protected function _construct()
    {
        $this->_init('amlanding/page', 'page_id');
    }
    
	public function uploadAndImport(Varien_Object $object)
    {
        if (empty($_FILES['groups']['tmp_name']['import']['fields']['file']['value'])) {
            return $this;
        }

        $csvFile = $_FILES['groups']['tmp_name']['import']['fields']['file']['value'];
        $website = Mage::app()->getWebsite($object->getScopeId());

        $this->_importWebsiteId     = (int)$website->getId();
        $this->_importUniqueHash    = array();
        $this->_importErrors        = array();
        $this->_importedRows        = 0;

        $io     = new Varien_Io_File();
        $info   = pathinfo($csvFile);
        $io->open(array('path' => $info['dirname']));
        $io->streamOpen($info['basename'], 'r');

        // check and skip headers
        $headers = $io->streamReadCsv(";");
        if ($headers === false || count($headers) < 5) {
            $io->streamClose();
            Mage::throwException(Mage::helper('amlanding')->__('Invalid Landing Pages File Format'));
        } else {
        	$this->_columns = $this->getFieldsByAliases($headers, Mage::helper('amlanding/import')->getColumnsAliasesForCsv());
        }
        
        $adapter = $this->_getWriteAdapter();
        $adapter->beginTransaction();

        try {
            $rowNumber  = 1;
            $importData = array();
            
            $this->loadExistingPages();

            while (false !== ($csvLine = $io->streamReadCsv(";"))) {
                $rowNumber ++;

                if (empty($csvLine)) {
                    continue;
                }

                $row = $this->validateCSVRow($csvLine, $rowNumber);
                if ($row !== false) {
                    $importData[] = $row;
                }

                if (count($importData) == 5000) {
                    $this->saveImportData($importData);
                    $importData = array();
                }
            }
            $this->saveImportData($importData);
            $io->streamClose();
        } catch (Mage_Core_Exception $e) {
            $adapter->rollback();
            $io->streamClose();
            Mage::throwException($e->getMessage());
        } catch (Exception $e) {
            $adapter->rollback();
            $io->streamClose();
            Mage::logException($e);
            Mage::throwException(Mage::helper('amlanding')->__('An error occurred while import Landing Pages.') . $e->getMessage());
        }

        $adapter->commit();

        if ($this->_importErrors) {
            $error = Mage::helper('shipping')->__('Landing Pages has not been imported completely. See the following list of errors:<br /> %s', implode(" \n", $this->_importErrors));
            Mage::throwException($error);
        }

        return $this;
    }
    
    public function validateCSVRow($line, $rowNumber)
    {
    	if (count($this->_columns) != count($line)) {
    		$this->_importErrors[] = Mage::helper('amlanding')->__('Row %d has incorrect columns count', $rowNumber);
    		return false;
    	}
    	
    	/*
    	 * Convert row to key=>value array
    	 */
    	$row = array();
    	foreach ($this->_columns as $i => $key) {
    		$row[$key] = $line[$i];
    	}
    	
    	if (!isset($row['identifier']) || $row['identifier'] == '') {
    		$this->_importErrors[] = Mage::helper('amlanding')->__('Landing Page Identifier should be set for Row #%d', $rowNumber);
    		return false;
    	}

        if(isset($this->_loadedPageIdentifiers[$row['identifier']])) {
            $this->_importErrors[] = Mage::helper('amlanding')->__('Landing Page Identifier is duplicated for Row #%d', $rowNumber);
            return false;
        }
        $this->_loadedPageIdentifiers[$row['identifier']] = 1;
    	
    	if (isset($this->_existingPages[$row['identifier']])) {
    		$this->_importErrors[] = Mage::helper('amlanding')->__('Record with "%s" identifier exists already. Delete it before update. Row #%d', $row['identifier'], $rowNumber);
    		return false;
    	}



    	if (isset($row['attributes']) && $row['attributes'] != '' && ($row['attributes'] = Mage::helper('amlanding/import')->decodeConditionFromCsv($row['attributes'])) === FALSE) {
    		$this->_importErrors[] = Mage::helper('amlanding')->__('Attributes have invalid format. Row #%d', $rowNumber);
    		return false;
    	}

        if(empty($row['attributes'])) {
            $row['attributes'] = serialize(array());
        }
    	
    	return $row;
    }
    
    public function loadExistingPages()
    {
    	$pages = Mage::getModel('amlanding/page')->getCollection();
    	$array = array();
    	foreach ($pages as $page) {
    		$array[$page->getIdentifier()] = $page;
    	}
    	$this->_existingPages = $array;
    }
    
    public function saveImportData($data)
    {
 
                    
    	if (!empty($data)) {
    		$ids = array();
    		foreach ($data as $row) {    
            	$this->_getWriteAdapter()->insert($this->getMainTable(), $row);            	
            	$ids[] = $this->_getWriteAdapter()->lastInsertId();
                
                
    		}
                
    		$stores = Mage::app()->getRequest()->getParam('groups');
                $stores = $stores['import']['fields']['store']['value'];
                
    		$storesInsert = array();
                    if (is_array($stores))
                    foreach ($stores as $storeId) {
                        foreach ($ids as $id) {
                                $storesInsert[] = array(
                                        'page_id' => $id,
                                        'store_id' => $storeId
                                );
                        }
                
                
            }
            
            if (count($storesInsert) > 0) {
                $storeTable = Mage::getSingleton('core/resource')->getTableName('amlanding/page_store');            
                $this->_getWriteAdapter()->insertArray($storeTable, array('page_id', 'store_id'), $storesInsert);
            }
            
            
            
            
        }
    }

    /**
     * Return names columns by aliases
     * @param array $aliases    Header columns from csv file
     * @param array $aliasesByFields Array aliase=>columnName
     * @return array column names
     */
    protected function getFieldsByAliases($aliases, $aliasesByFields) {
        $listFields = array();
        foreach($aliases as $aliase) {
            if(isset($aliasesByFields[$aliase])) {
                $listFields[] = $aliasesByFields[$aliase];
            } else {
                $listFields[] = $aliase;
            }
        }

        return $listFields;
    }
}
