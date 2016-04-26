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



/**
 * Mirasvit.
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 *
 * @version   1.0.0
 * @revision  92
 *
 * @copyright Copyright (C) 2013 Mirasvit (http://mirasvit.com/)
 */
class Mirasvit_Fpc_Test_Model_ProcessorTest extends EcomDev_PHPUnit_Test_Case
{
    protected function setUp()
    {
        $this->_model = new Mirasvit_Fpc_Model_Processor();

        return parent::setUp();
    }

    /**
     * @test
     * @cover getRequestId
     *
     * @dataProvider getRequestIdTestProvider
     */
    public function getRequestIdTest($server, $cookie, $expected)
    {
        $_SERVER = array_merge($_SERVER, $server);
        $_COOKIE = array_merge($_COOKIE, $cookie);

        $this->assertEquals($expected, $this->_model->getRequestId());
    }

    public function getRequestIdTestProvider()
    {
        return array(
            array(
                array(
                    'HTTP_HOST' => 'example.com',
                    'REQUEST_URI' => '/checkout/cart/',
                ),
                array(
                    'store' => 'base',
                    'currency' => 'USD',
                ),
                'example.com/checkout/cart/_base_usd',
            ),
        );
    }

    /**
     * @test
     * @cover canProcessRequest
     *
     * @dataProvider canProcessRequestTestProvider
     */
    public function canProcessRequestTest($server, $get, $expected)
    {
        Mage::app()->setCurrentStore(1);
        $_SERVER = array_merge($_SERVER, $server);
        $_GET = $get;

        $config = $this->getMock('Mirasvit_Fpc_Model_Config', array('getCacheableActions', 'getIgnoredPages', 'getAllowedPages', 'getMaxDepth'));
        $config->expects($this->any())
             ->method('getCacheableActions')
             ->will($this->returnValue(array('cms/index_index', 'catalog/product_view', 'catalog/category_view')));
        $config->expects($this->any())
             ->method('getIgnoredPages')
             ->will($this->returnValue(array('gclid')));
        $config->expects($this->any())
             ->method('getAllowedPages')
             ->will($this->returnValue(array('/\s*/')));
        $config->expects($this->any())
             ->method('getMaxDepth')
             ->will($this->returnValue(3));

        $processor = $this->getMock('Mirasvit_Fpc_Model_Processor', array('getConfig'));
        $processor->expects($this->any())
             ->method('getConfig')
             ->will($this->returnValue($config));

        $this->assertEquals($expected, $processor->canProcessRequest(null));
    }

    public function canProcessRequestTestProvider()
    {
        return array(
            array(
                array(
                    'HTTP_HOST' => 'example.com',
                    'REQUEST_URI' => '/catalog-search/',
                ),
                array(),
                false,
            ),
            array(
                array(
                    'HTTP_HOST' => 'example.com',
                    'REQUEST_URI' => '/catalog/product/view/1/',
                ),
                array(),
                true,
            ),
            array(
                array(
                    'HTTP_HOST' => 'example.com',
                    'REQUEST_URI' => '/catalog/product/view/1/no_cache',
                ),
                array(),
                false,
            ),
            array(
                array(
                    'HTTP_HOST' => 'example.com',
                    'REQUEST_URI' => '/abc',
                ),
                array(1, 2, 3, 4),
                false,
            ),
            array(
                array(
                    'HTTP_HOST' => 'example.com',
                    'REQUEST_URI' => '/abc',
                ),
                array(1, 2, 3),
                true,
            ),
        );
    }
}
