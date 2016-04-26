<?php
/**
 * Copyright 2015 HELLOPAY SINGAPORE PTE. LTD.
 *
 * You are hereby granted a non-exclusive, worldwide, royalty-free license to
 * use, copy, modify, and distribute this software in source code or binary
 * form for use in connection with the web services and APIs provided by
 * helloPay.
 *
 * As with any software that integrates with the helloPay platform, your use
 * of this software is subject to the helloPay Developer Principles and
 * Policies [https://www.hellopay.com.sg/privacy-policy.html]. This copyright notice
 * shall be included in all copies or substantial portions of the software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 */

namespace HelloPay;

use HelloPay\Exceptions\HelloPaySDKException;
use HelloPay\Helpers\NotificationParser;
use HelloPay\HttpClients\HelloPayCurlHttpClient;
use HelloPay\RequestParams\CancelTransaction;
use HelloPay\RequestParams\PurchaseCreate as PurchaseCreateRequestParams;
use HelloPay\Responses\NotificationData;
use HelloPay\Responses\PurchaseCreate as PurchaseCreateResponse;
use HelloPay\Responses\TransactionEvents as TransactionEventsResponse;
use HelloPay\RequestParams\TransactionEvents as TransactionEventsRequestParams;
use HelloPay\RequestParams\RefundAmount as RefundAmountRequestParams;

/**
 * Class HelloPay
 *
 * @package HelloPay
 */
class HelloPay
{
    /**
     * @const string Version number of the helloPay PHP SDK.
     */
    const VERSION = '1.0.0';

    /**
     * @const string The name of the environment variable that contains the shopConfig.
     */
    const HELLOPAY_SHOP_CONFIG = 'HELLOPAY_SHOP_CONFIG';

    /**
     * @const string the name of the environment variable that contains the apiUrl
     */
    const HELLOPAY_API_URL = 'HELLOPAY_API_URL';

    /**
     * @const string the name of api endpoint of purchase create
     */
    const API_ENDPOINT_PURCHASE_CREATE = 'purchaseCreate';

    /**
     * @const string the name of api endpoint of getting transaction events
     */
    const API_ENDPOINT_TRANSACTION_EVENTS = 'transactionEvents';

    /**
     * @const string the name of api endpoint of cancelling transaction
     */
    const API_ENDPOINT_CANCEL = 'cancel';

    /**
     * @const string the name of api endpoint of refunding amount
     */
    const API_ENDPOINT_REFUND = 'refund';

    /**
     * @var string The registered shop configuration id
     */
    protected $shopConfig;

    /**
     * @var string The api url of helloPay system
     */
    protected $apiUrl;

    /**
     * @var HelloPayCurlHttpClient
     */
    protected $httpClient;

    protected $lastMessage = '';

    /**
     * @var array api endpoints mapping
     */
    private $apiEndPoints = [
        self::API_ENDPOINT_PURCHASE_CREATE    => '/merchant/create',
        self::API_ENDPOINT_TRANSACTION_EVENTS => '/merchant/transaction-events',
        self::API_ENDPOINT_CANCEL             => '/merchant/cancel',
        self::API_ENDPOINT_REFUND             => '/merchant/refund'
    ];

    /**
     * Instantiates a new helloPay main object
     *
     * @param array $config
     *
     * @throws HelloPaySDKException
     */
    public function __construct(array $config = [])
    {
        $this->shopConfig = isset($config['shopConfig']) ? $config['shopConfig'] : getenv(static::HELLOPAY_SHOP_CONFIG);
        if (!$this->shopConfig) {
            throw new HelloPaySDKException('Required "shopConfig" key not supplied in config'
                . ' and could not find fallback environment variable "'
                . static::HELLOPAY_SHOP_CONFIG . '"');
        }

        $this->apiUrl = isset($config['apiUrl']) ? $config['apiUrl'] : getenv(static::HELLOPAY_API_URL);
        if (!$this->apiUrl) {
            throw new HelloPaySDKException('Required "apiUrl" key not supplied in config'
                . ' and could not find fallback environment variable "'
                . static::HELLOPAY_API_URL . '"');
        }

        $this->httpClient = new HelloPayCurlHttpClient(isset($config['sslEnabled']) ? $config['sslEnabled'] : true);
    }

    /**
     * Get the last message from helloPay
     *
     * @return string
     */
    public function getLastMessage()
    {
        return $this->lastMessage;
    }

    /**
     * @param array $purchaseData
     * @return bool|PurchaseCreateResponse
     * @throws HelloPaySDKException
     */
    public function createPurchase(array $purchaseData = [])
    {
        $requestParams = new PurchaseCreateRequestParams($purchaseData);
        $requestParams->setValue('shopConfig', $this->shopConfig);

        $response = $this->httpClient->send(
            $this->getApiEndPointUrl(static::API_ENDPOINT_PURCHASE_CREATE),
            'POST',
            $requestParams->getData()
        );

        if ($response->isSuccess()) {
            return new PurchaseCreateResponse(get_object_vars($response));
        }

        $this->lastMessage = $response->getMessage();
        return false;
    }

    /**
     * @param array $requestParams
     * @return bool|TransactionEventsResponse
     * @throws HelloPaySDKException
     */
    public function getTransactionEvents(array $requestParams = [])
    {
        $requestParams = new TransactionEventsRequestParams($requestParams);
        $requestParams->setValue('shopConfig', $this->shopConfig);

        $response = $this->httpClient->send(
            $this->getApiEndPointUrl(static::API_ENDPOINT_TRANSACTION_EVENTS),
            'POST',
            $requestParams->getData()
        );

        if ($response->isSuccess()) {
            return new TransactionEventsResponse($response->transactionEvents);
        }

        $this->lastMessage = $response->getMessage();
        return false;
    }

    /**
     * @param $transactionId
     * @return bool
     * @throws HelloPaySDKException
     */
    public function cancelTransaction($transactionId)
    {
        $requestParams = new CancelTransaction([
            'purchaseId' => $transactionId,
            'shopConfig' => $this->shopConfig
        ]);

        $response = $this->httpClient->send(
            $this->getApiEndPointUrl(static::API_ENDPOINT_CANCEL),
            'POST',
            $requestParams->getData()
        );

        $this->lastMessage = $response->getMessage();

        return $response->isSuccess();
    }

    /**
     * @param array $requestParams
     * @return bool
     * @throws HelloPaySDKException
     */
    public function refundAmount(array $requestParams)
    {
        $requestParams = new RefundAmountRequestParams($requestParams);
        $requestParams->setValue('shopConfig', $this->shopConfig);

        $response = $this->httpClient->send(
            $this->getApiEndPointUrl(static::API_ENDPOINT_REFUND),
            'POST',
            $requestParams->getData()
        );

        $this->lastMessage = $response->getMessage();

        return $response->isSuccess();
    }

    /**
     * @param string $payload
     * @return bool|array
     */
    public function parseNotificationPayload($payload)
    {
        $decodedData = NotificationParser::parsePayload($payload);

        if (!$decodedData) {
            $this->lastMessage = 'Wrong format type';
            return false;
        }

        $returnData = [];
        foreach ($decodedData as $item) {
            $returnData[] = new NotificationData($item);
        }

        return $returnData;
    }

    /**
     * @param string $name the given api endpoint name
     * @return string
     * @throws HelloPaySDKException
     */
    protected function getApiEndPointUrl($name)
    {
        if (!isset($this->apiEndPoints[$name])) {
            throw new HelloPaySDKException('The Api Endpoint URL of ' . $name . ' does not exist.');
        }

        return $this->apiUrl . $this->apiEndPoints[$name];
    }
}
