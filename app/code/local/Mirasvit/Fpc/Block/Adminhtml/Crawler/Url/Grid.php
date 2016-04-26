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



class Mirasvit_Fpc_Block_Adminhtml_Crawler_Url_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected $_sortByPageTypeCount;
    protected $_sortByProductAttributeCount;
    protected $_sortCrawlerUrls;

    public function __construct()
    {
        $this->_sortByPageTypeCount = count(Mage::getSingleton('fpc/config')->getSortByPageType());
        $this->_sortByProductAttributeCount = count(Mage::getSingleton('fpc/config')->getSortByProductAttribute());
        $this->_sortCrawlerUrls = Mage::getSingleton('fpc/config')->getSortCrawlerUrls();

        parent::__construct();
        $this->setId('grid');
        if (Mage::getSingleton('fpc/config')->getSortCrawlerUrls() == 'popularity') {
            $this->setDefaultSort('rate');
            $this->setDefaultDir('DESC');
        } else {
            $this->setDefaultSort('cache_status');
        }
        $this->setSaveParametersInSession(true);
    }

    protected function _setCollectionOrder($column)
    {
        $collection = $this->getCollection();
        if ($collection) {
            $columnIndex = $column->getFilterIndex() ?
                $column->getFilterIndex() : $column->getIndex();

            if ($this->_sortCrawlerUrls == 'popularity'
                || ($this->_sortCrawlerUrls == 'custom_order' && strpos(Mage::helper('core/url')->getCurrentUrl(), '/sort/') !== false)) {
                $collection->setOrder($columnIndex, strtoupper($column->getDir()));
            } elseif ($this->_sortCrawlerUrls == 'custom_order' && $this->_sortByPageTypeCount > 0 && $this->_sortByProductAttributeCount > 0) {
                $collection->getSelect()->order(Mage::helper('fpc')->getOrderSql(true));
            } elseif ($this->_sortCrawlerUrls == 'custom_order' && $this->_sortByPageTypeCount > 0) {
                $collection->getSelect()->order(Mage::helper('fpc')->getOrderSql(false));
            } elseif ($this->_sortCrawlerUrls == 'custom_order' && $this->_sortByProductAttributeCount > 0) {
                $collection->getSelect()->order(array('sort_by_product_attribute asc', 'rate desc'));
            } else {
                $collection->getSelect()->order('rate desc');
            }
        }

        return $this;
    }

    protected function _prepareCollection()
    {
        if ($this->_sortCrawlerUrls == 'custom_order' && strpos(Mage::helper('core/url')->getCurrentUrl(), '/sort/') === false) {
            $_SESSION['adminhtml']['gridsort'] = 'cache_status';
        }

        $collection = Mage::getModel('fpc/crawler_url')
            ->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('url_id', array(
            'header' => Mage::helper('fpc')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'url_id',
            )
        );

        $this->addColumn('url', array(
            'header' => Mage::helper('fpc')->__('URL'),
            'index' => 'url',
            )
        );

        $this->addColumn('cache_id', array(
            'header' => Mage::helper('fpc')->__('Cache Id'),
            'index' => 'cache_id',
            )
        );

        $this->addColumn('rate', array(
            'header' => Mage::helper('fpc')->__('Popularity (number of visits)'),
            'index' => 'rate',
            'align' => 'right',
            'width' => '100px',
            'type' => 'number',
            )
        );

        $this->addColumn('sort_by_page_type', array(
            'header' => Mage::helper('fpc')->__('Sort by page type'),
            'index' => 'sort_by_page_type',
            'width' => '150px',
            )
        );

        $this->addColumn('sort_by_product_attribute', array(
            'header' => Mage::helper('fpc')->__('Sort by product attribute'),
            'index' => 'sort_by_product_attribute',
            'align' => 'right',
            'width' => '100px',
            )
        );

        $this->addColumn('cache_status', array(
            'header' => Mage::helper('fpc')->__('Cache Status'),
            'index' => 'url',
            'renderer' => 'Mirasvit_Fpc_Block_Adminhtml_Crawler_Url_Grid_Renderer_Cache',
            'filter' => false,
            'sortable' => false,
            )
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('url_id');
        $this->getMassactionBlock()->setFormFieldName('url_id');
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('fpc')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('fpc')->__('Are you sure?'),
        ));
        $this->getMassactionBlock()->addItem('warm', array(
            'label' => Mage::helper('fpc')->__('Warm cache'),
            'url' => $this->getUrl('*/*/massWarm'),
        ));
        $this->getMassactionBlock()->addItem('clear', array(
            'label' => Mage::helper('fpc')->__('Clear cache'),
            'url' => $this->getUrl('*/*/massClear'),
        ));

        return $this;
    }

    protected function _urlFilter($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return $this;
        }
        $value = base64_encode($value);
        $value = substr($value, 0, strlen($value) - 3);

        $this->getCollection()
            ->addFieldToFilter($column->getIndex(), array('like' => '%'.$value.'%'));

        return $this;
    }
}
