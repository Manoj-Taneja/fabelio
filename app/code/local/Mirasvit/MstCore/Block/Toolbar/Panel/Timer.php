<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Full Page Cache
 * @version   1.0.1
 * @build     360
 * @copyright Copyright (C) 2015 Mirasvit (http://mirasvit.com/)
 */


class Mirasvit_MstCore_Block_Toolbar_Panel_Timer extends Mirasvit_MstCore_Block_Toolbar_Panel
{
    protected $timers;

    public function _construct()
    {
        parent::_construct(); 

        $this->timers = Varien_Profiler::getTimers();
    }

    public function _prepareLayout()
    {
        $this->setTemplate('mstcore/toolbar/panel/timer.phtml');
    }

    public function getIdentifier()
    {
        return 'timers';
    }

    public function getName() {
        return 'Timers';
    }

    public function colorInterval($interval)
    {
        if ($interval < 5) {
            return 'green';
        } elseif ($interval < 10) {
            return 'yellow';
        } else {
            return 'red';
        }
    }

    public function getTimers()
    {
        $timers = $this->timers;
        uasort($timers, function($a, $b) {
            return $a['sum'] < $b['sum'];
        });

        return $timers;
    }
}