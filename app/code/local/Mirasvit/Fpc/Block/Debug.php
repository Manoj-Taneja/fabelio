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



class Mirasvit_Fpc_Block_Debug extends Mage_Core_Block_Template
{
    public static $processedPlaceholders = array();
    public static $inPagePlaceholders = array();
    public static $defaultPlaceholders = array();

    public function _toHtml()
    {
        if (!Mirasvit_Fpc_Model_Config::isDebug()) {
            return;
        }

        $processor = Mage::getSingleton('fpc/processor');

        $data['Now'] = date('d.m.Y H:i:s');
        $data['Request Id'] = $processor->getRequestId();
        // $data['Request Cache Id'] = $processor->getRequestCacheId();
        $data['Cache Id'] = $this->getCacheId();
        // $data['Request Tags']     = implode(', ', $processor->getRequestTags());
        $data['Can Process Request'] = $processor->canProcessRequest() ? 'Yes' : 'No';
        $data['Is Allowed'] = $processor->isAllowed() ? 'Yes' : 'No';
        $data['Is From Cache'] = $processor->getCache()->load($this->getCacheId()) ? 'Yes' : 'No';

        $meta = $processor->getCache()->getFrontend()->getMetadatas(strtoupper($this->getCacheId()));
        if ($meta) {
            $data['Created At'] = date('d.m.Y H:i:s', $meta['mtime']);
            $data['Expired At'] = date('d.m.Y H:i:s', $meta['expire']);
            // $data['Tags']       = implode(', ', $meta['tags']);
        }

        foreach (self::$processedPlaceholders as $item) {
            $data['Processed Placeholders'][] = array(
                'block' => $item->getAttribute('block'),
                'template' => $item->getAttribute('template'),
                'container' => $item->getAttribute('container'),
            );
        }

        foreach (self::$inPagePlaceholders as $item) {
            $data['In Page Placeholders'][] = array(
                'block' => $item->getAttribute('block'),
                'template' => $item->getAttribute('template'),
                'container' => $item->getAttribute('container'),
            );
        }

        foreach (self::$defaultPlaceholders as $item) {
            $data['Default Placeholders'][] = array(
                'block' => $item->getAttribute('block'),
                'template' => $item->getAttribute('template'),
                'container' => $item->getAttribute('container'),
            );
        }

        if ($processor->canProcessRequest()) {
            return '<div style="position:fixed;bottom:5px;right:5px;border:1px solid #ccc;">'.$this->arrToTable($data).'</div>';
        }
    }

    public function arrToTable($data)
    {
        $html = '<table cellspacing="0" cellpadding="0" style="background:#fff; font-size:11px; color:#333;">';

        foreach ($data as $key => $value) {
            $html .= '<tr>';
            if (!is_numeric($key)) {
                $html .= '<td style="padding:1px 10px;">'.$key.'</td>';
            }
            if (is_array($value)) {
                $html .= '<td style="padding:1px 10px;">'.$this->arrToTable($value).'</td>';
            } else {
                $html .= '<td style="padding:1px 10px;">'.$value.'</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';

        return $html;
    }

    public function getCacheId()
    {
        $processor = Mage::getSingleton('fpc/processor');
        $subprocessorClass = $processor->getMetadata('cache_subprocessor');
        if (!$subprocessorClass) {
            return '-';
        }
        $subprocessor = new $subprocessorClass();
        $cacheId = $processor->prepareCacheId($subprocessor->getPageIdWithoutApp($processor));

        return $cacheId;
    }
}
