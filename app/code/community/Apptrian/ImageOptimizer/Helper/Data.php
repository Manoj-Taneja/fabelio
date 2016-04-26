<?php
/**
 * @category   Apptrian
 * @package    Apptrian_ImageOptimizer
 * @author     Apptrian
 * @copyright  Copyright (c) 2015 Apptrian (http://www.apptrian.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Apptrian_ImageOptimizer_Helper_Data extends Mage_Core_Helper_Abstract
{
	/**
	 * Logging flag.
	 * 
	 * @var null|int
	 */
	protected $logging = null;
	
	/**
	 * Returns extension version.
	 *
	 * @return string
	 */
	public function getExtensionVersion()
	{
		return (string) Mage::getConfig()->getNode()->modules->Apptrian_ImageOptimizer->version;
	}
    
	/**
	 * Checks if exec() function is enabled in php and suhosin config.
	 * 
	 * @return boolean
	 */
	public function isExecFunctionEnabled()
	{
		$r = false;
		
		// PHP disabled functions
		$phpDisabledFunctions = array_map('strtolower', array_map('trim', explode(',', ini_get('disable_functions'))));
		// Suhosin disabled functions
		$suhosinDisabledFunctions = array_map('strtolower', array_map('trim', explode(',', ini_get('suhosin.executor.func.blacklist'))));
		
		$disabledFunctions = array_merge($phpDisabledFunctions, $suhosinDisabledFunctions);
		
		$disabled = false;
		
		if (in_array('exec', $disabledFunctions)) {
			$disabled = true;
		}
		
		if(function_exists('exec') === true && $disabled === false) {
			$r = true;
		}
		
		return $r;
	}
	
	/**
	 * Optimized way of getting logging flag from config.
	 * 
	 * @return int
	 */
	public function isLoggingEnabled()
	{
		if ($this->logging === null) {
			
			$this->logging = (int) Mage::getConfig()->getNode('apptrian_imageoptimizer/utility/log_output', 'default');
			
		}
		
		return $this->logging;
	}
	
	/**
	 * Based on config returns array of all paths that will be scaned for images.
	 * 
	 * @return array
	 */
	public function getPaths()
	{
		
		$paths = array();
		
		$pathsString = trim(trim(Mage::getConfig()->getNode('apptrian_imageoptimizer/general/paths', 'default'), ';'));
			
		$rawPaths = explode(';', $pathsString);
		
		foreach ($rawPaths as $p) {
			
			$trimmed = trim(trim($p), '/');
			
			$dirs = explode('/', $trimmed);
			
			$paths[] = implode(DS, $dirs);
			
		}
		
		return array_unique($paths);
		
	}
	
	/**
	 * Optimizes single file.
	 * 
	 * @param string $filePath
	 * @return boolean
	 */
	public function optimizeFile($filePath)
	{
		
		$info = pathinfo($filePath);
		
		$output = array();
		
		switch ($info['extension']) {
			case 'jpg':
			case 'jpeg':
				exec(Mage::helper('apptrian_imageoptimizer/utility')->getJpgUtil($filePath), $output, $return_var);
				$type = 'jpg';
				break;
			case 'png':
				exec(Mage::helper('apptrian_imageoptimizer/utility')->getPngUtil($filePath), $output, $return_var);
				$type = 'png';
				break;
			case 'gif':
				exec(Mage::helper('apptrian_imageoptimizer/utility')->getGifUtil($filePath), $output, $return_var);
				$type = 'gif';
				break;
		}
		
		if ($return_var == 126) {
			
			$error = Mage::getConfig()->getNode('apptrian_imageoptimizer/utility/' . $type, 'default') . ' is not executable.';
			
			Mage::log($error, null, 'apptrian_imageoptimizer.log');
			
			return false;
			
		} else {
			
			if ($this->isLoggingEnabled()) {
				
				Mage::log($filePath, null, 'apptrian_imageoptimizer.log');
				Mage::log($output, null, 'apptrian_imageoptimizer.log');
				
			}
			
			return true;
			
		}
		
	}
	
	/**
	 * Optimization process.
	 * 
	 * @return boolean
	 */
	public function optimize()
	{
		// Get Batch Size
		$batchSize = Mage::getConfig()->getNode('apptrian_imageoptimizer/general/batch_size', 'default');
		
		// Get Collection of files for optimization but limited by batch size
		$collection = Mage::getModel('apptrian_imageoptimizer/file')
			->getCollection()
			->addFieldToSelect(array('id', 'file_path'))
			->addFieldToFilter('optimized', array('eq' => 0))
			->setPageSize($batchSize)
			->load();
		
		$toUpdate    = array();
		$toDelete    = array();
		$oldFileSize = 0;
		
		foreach ($collection as $item) {
			
			$id    = $item->getId();
			$fPath = $item->getFilePath();
			
			$filePath = realpath($fPath);
			
			// If image exists, optimize else remove it from database
			if (file_exists($filePath)) {
				
				$oldFileSize = filesize($filePath);
				
				if ($this->optimizeFile($filePath)) {
					
					$toUpdate[$id]['file_path']     = $fPath;
					$toUpdate[$id]['old_file_size'] = $oldFileSize;
					$toUpdate[$id]['optimized']     = 1;
					
				}
				
			} else {
				
				$toDelete = $id;
				
			}
			
		}
		
		// Itereate over $toUpdate array and set modified time and new_file_size
		// (mtime etc) takes a split second to update
		foreach ($toUpdate as $i => $f) {
			
			$filePath = realpath($f['file_path']);
			
			if (file_exists($filePath)) {
				$toUpdate[$i]['new_file_size']     = filesize($filePath);
				$toUpdate[$i]['optimization_time'] = filemtime($filePath);
			}
			
		}
		
		$resource = Mage::getResourceModel('apptrian_imageoptimizer/file');
		
		$result1 = $resource->deleteFiles($toDelete);
		$result2 = $resource->updateFiles($toUpdate);
		
		if ($result1 === true && $result2 === true) {
			return true;
		} else {
			return false;
		}
		
	}
	
	/**
	 * Scan and reindex process.
	 * 
	 * @return boolean
	 */
	public function scanAndReindex()
	{
		
		$collection = Mage::getModel('apptrian_imageoptimizer/file')
			->getCollection()
			->addFieldToSelect(array('id', 'file_path', 'optimization_time'))
			->load();
		
		$inIndex  = array();
		$toAdd    = array();
		$toUpdate = array();
		$toDelete = array();
		$id       = 0;
		$filePath = '';
		
		foreach ($collection as $item) {
			
			$id = $item->getId();
			
			$inIndex[$id] = 0;
			
			$filePath = realpath($item->getFilePath());
			
			if (file_exists($filePath)) {
				if (filemtime($filePath) != $item->getOptimizationTime()) {
					$toUpdate[] = $id;
				}
			} else {
				$toDelete[] = $id;
			}
			
		}
		
		
		$files = array();
		$paths = $this->getPaths();
		
		foreach ($paths as $path) {
		
			$iterator = new RecursiveIteratorIterator(
					new RecursiveDirectoryIterator(Mage::getBaseDir() . DS . $path, RecursiveDirectoryIterator::FOLLOW_SYMLINKS));
			
			foreach ( $iterator as $filename => $file ) {
				if ($file->isFile() && preg_match( '/^.+\.(jpe?g|gif|png)$/i', $file->getFilename())) {
					$filePath = $file->getRealPath();
					if (!is_writable($filePath)) {
						continue;
					}
					
					$files[md5($filePath)] = $filePath;
					
				}
			}
		
		}
		
		
		$toAdd = array_diff_key($files, $inIndex);
		
		$resource = Mage::getResourceModel('apptrian_imageoptimizer/file');
		
		$result1 = $resource->deleteFiles($toDelete);
		$result2 = $resource->updateFilesOptimizedField($toUpdate);
		$result3 = $resource->addFiles($toAdd);
		
		if ($result1 === true && $result2 === true && $result3 === true) {
			return true;
		} else {
			return false;
		}
		
	}
	
	
}