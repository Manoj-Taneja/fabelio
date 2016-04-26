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



class Mirasvit_Fpc_Helper_Debug extends Mage_Core_Helper_Abstract
{
    public function appendDebugInformation(&$content, $isHit = 0)
    {
        if (!Mage::getSingleton('fpc/config')->isDebugInfoEnabled()) {
            return $this;
        }

        $time = round(microtime(true) - $_SERVER['FPC_TIME'], 3);
        $hit = 'Cache Hit';
        if ($isHit == 0) {
            $hit = 'Cache Miss';
        }

        $info = '
        <div style="width: 370px;min-height: 115px;position: fixed;bottom: 10px;left: 10px;background: #47bbb3;color: #fff;z-index: 100000;font-family:Arial;">
            <h1 style="font-family:Arial;background: rgba(255, 255, 255, 0.1);color: #fff;padding: 3px 5px;font-size: 14px;font-weight: bold;text-align:center;">Full Page Cache</h1>
            <div style="padding: 2px 5px 10px 5px;">
                <h2 style="font-family:Arial;padding:0px;margin: 5px 0px 0px 0px;text-align: center;font-size: 30px;font-weight: 400;color: rgba(255, 255, 255, 0.95);text-transform:none;">'.$hit.'</h2>
                <h2 style="font-family:Arial;padding:0px;margin: 5px 0px 5px 0px;text-align: center;font-size: 25px;font-weight: 400;color: rgba(255, 255, 255, 0.5);text-transform:none;">Response Time</h2>
                <div style="font-family:Arial;text-transform: uppercase;font-size: 76px;font-weight: 700;line-height: 65px;text-align:center;">'.$time.'</div>
                <div style="font-family:Arial;color: rgba(255, 255, 255, 0.7);font-size: 15px;text-align:center;">second(s)</div>
            </div>
        </div>';

        $content .= $info;

        return $this;
    }

    public function appendDebugInformationToBlock(&$content, $container, $fromCache, $startTime)
    {
        if (!Mage::getSingleton('fpc/config')->isDebugHintsEnabled()) {
            return $this;
        }

        $hit = 'Cache Hit';
        if (!$fromCache) {
            $hit = 'Cache Miss';
        }

        $hit .= ' '.round(microtime(true) - $startTime, 3).' s.';

        $definition = $container->getDefinition();
        $infoText = $definition['block'].' ('.$hit.')'.'<br>'.hash('crc32', $container->getCacheId());
        $info = '<div style="position:absolute; left:0; top:0; padding:2px 5px; background:#faa; color:#333; font:normal 9px Arial;
        text-align:left !important; z-index:998;text-transform:none;">'.$infoText.'</div>';
        $content = '<div style="position:relative; border:1px dotted red; margin:6px 2px; padding:18px 2px 2px 2px; zoom:1;">'.$info.$content.'</div>';
    }
}
