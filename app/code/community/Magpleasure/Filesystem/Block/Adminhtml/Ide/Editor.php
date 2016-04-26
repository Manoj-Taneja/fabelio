<?php
/**
 * MagPleasure Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magpleasure.com/LICENSE.txt
 *
 * @category   Magpleasure
 * @package    Magpleasure_Filesystem
 * @copyright  Copyright (c) 2011 Magpleasure Co. (http://www.magpleasure.com)
 * @license    http://www.magpleasure.com/LICENSE.txt
 */


class Magpleasure_Filesystem_Block_Adminhtml_Ide_Editor extends Mage_Adminhtml_Block_Abstract
{
    /**
     * Template path
     */
    const TEMPLATE_PATH = 'filesystem/ide/editor.phtml';
    
    protected function _construct() 
    {
        parent::_construct();
        $this->setTemplate(self::TEMPLATE_PATH);
    }
}