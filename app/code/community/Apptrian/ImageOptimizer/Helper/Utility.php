<?php
/**
 * @category   Apptrian
 * @package    Apptrian_ImageOptimizer
 * @author     Apptrian
 * @copyright  Copyright (c) 2015 Apptrian (http://www.apptrian.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Apptrian_ImageOptimizer_Helper_Utility extends Mage_Core_Helper_Abstract {
	
	/**
	 * Path to utilities.
	 * 
	 * @var null|string
	 */
    protected $utilPath = null;
    
    /**
     * extension (for win binaries)
     * 
     * @var null|string
     */
    protected $utilExt  = null;

    /**
     * Checks if server OS is Windows
     *
     * @return bool
     */
    protected function isWindows()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Alias for getUtil() and .gif
     * 
     * @param string $filePath
     * @return string
     */
    public function getGifUtil($filePath) 
    {
        return $this->getUtil('gif', $filePath);
    }
    
    /**
     * Alias for getUtil() and .jpg
     *
     * @param string $filePath
     * @return string
     */
    public function getJpgUtil($filePath)
    {
    	return $this->getUtil('jpg', $filePath);
    }
    
    /**
     * Alias for getUtil() and .png
     * 
     * @param string $filePath
     * @return string
     */
    public function getPngUtil($filePath) 
    {
        return $this->getUtil('png', $filePath);
    }

    /**
     * Formats and returns the shell command string for an image optimization utility
     *
     * @param string $type - This is image type. Valid values gif|jpg|png
     * @param string $filePath - Path to the image to be optimized
     * @return string
     */
    protected function getUtil($type, $filePath) 
    {
    	
    	$cmd = $this->getUtilPath() . DS . Mage::getConfig()->getNode('apptrian_imageoptimizer/utility/' . $type, 'default') . $this->getUtilExt() . ' ' . Mage::getConfig()->getNode('apptrian_imageoptimizer/utility/' . $type . '_options', 'default') . ' ' . $filePath;
    	
        if (Mage::getConfig()->getNode('apptrian_imageoptimizer/utility/' . $type, 'default') == 'jpegtran') {
            $cmd .= ' ' . $filePath;
        }
        
        return $cmd;
    }
    
    /**
     * Gets and stores utility extension.
     * Checks server OS and determine utility extension.
     *
     * @return string
     */
    protected function getUtilExt()
    {
    	if ($this->utilExt === null) {
    		 
    		$this->utilExt = $this->isWindows() ? '.exe' : '';
    
    	}
    	
    	return $this->utilExt;
    }
    
    /**
     * Gets and stores path to utilities.
     * Checks server OS and config to determine the path where image optimization utilities are.
     *
     * @return string
     */
    protected function getUtilPath() 
    {
        if ($this->utilPath === null) {
        	
            if ((int) Mage::getConfig()->getNode('apptrian_imageoptimizer/utility/use64bit', 'default')) {
            	$bit = '64';
            } else {
            	$bit = '32';
            }
            
            $os = $this->isWindows() ? 'win' . $bit : 'elf' . $bit;
            
            $pathString = trim(trim(Mage::getConfig()->getNode('apptrian_imageoptimizer/utility/path', 'default')), '/');
            $dirs       = explode('/', $pathString);
            $path       = implode(DS, $dirs);
            
            $this->utilPath = Mage::getBaseDir() . DS . $path . DS . $os;
            
        }
        
        return $this->utilPath;
    }
    
    
}