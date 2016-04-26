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

namespace HelloPay\RequestParams;

use HelloPay\Exceptions\HelloPayRequestParamException;

/**
 * Class PurchaseCreate
 *
 * @package HelloPay
 */
class PurchaseCreate extends Base
{
    public function getAttributeKeys()
    {
        return array(
            'shopConfig',
            'priceAmount',
            'priceCurrency',
            'description',
            'merchantReferenceId',
            'purchaseSuccessUrl',
            'purchaseFailureUrl',
            'purchaseCancelUrl',
            'purchaseReturnUrl',
            'purchaseCallbackUrl',
            'basket',
            'shippingAddress',
            'billingAddress',
            'consumerData',
            'additionalData',
            'sendUserData',
            'addressRequired'
        );
    }

    public function getBasketAttributeKeys()
    {
        return array(
            'basketItems',
            'shipping',
            'totalAmount',
            'totalTaxAmount',
            'currency',
        );
    }

    public function getBasketMandatoryAttributeKeys()
    {
        return array(
            'basketItems',
            'totalAmount',
            'currency',
        );
    }

    public function getBasketItemsAttributeKeys()
    {
        return array(
            'itemType',
            'name',
            'description',
            'amount',
            'taxAmount',
            'currency',
            'imageUrl',
            'quantity',
        );
    }

    public function getBasketItemsMandatoryKeys()
    {
        return array(
            'name',
            'quantity',
            'amount',
            'imageUrl',
            'currency',
        );
    }

    public function getBillingAddressAttributeKeys()
    {
        return array(
            'name',
            'firstName',
            'lastName',
            'mobilePhoneNumber',
            'addressLine1',
            'houseNumber',
            'addressLine2',
            'province',
            'city',
            'district',
            'zip',
            'country',
        );
    }

    public function getBillingAddressAttributeMandatoryKeys()
    {
        return array(
            'name',
            'mobilePhoneNumber',
            'addressLine1',
            'city',
            'country',
        );
    }

    public function getShippingAddressAttributeKeys()
    {
        return $this->getBillingAddressAttributeKeys();
    }

    public function getShippingAddressAttributeMandatoryKeys()
    {
        return $this->getBillingAddressAttributeMandatoryKeys();
    }

    public function getConsumerDataAttributeKeys()
    {
        return array(
            "mobilePhoneNumber",
            "emailAddress",
            "country",
            "language",
            "dateOfBirth",
            "gender",
            "ipAddress",
            'name',
            "firstName",
            "lastName",
        );
    }

    public function getConsumerDataAttributeMandatoryKeys()
    {
        return array(
            "mobilePhoneNumber",
            "emailAddress",
            "country",
            "language",
            "ipAddress",
            'name',
        );
    }

    /**
     * Provides keys which values cannot get Empty
     *
     * @return array
     */
    public function getMandatoryKeys()
    {
        return array(
            'priceAmount',
            'priceCurrency',
            'description',
            'merchantReferenceId',
            'basket',
            'shippingAddress',
            'billingAddress',
            'consumerData',
        );
    }

    public function setAddressRequired($value)
    {
        $this->data['addressRequired'] = (bool) $value;
    }

    public function setSendUserData($value)
    {
        $this->data['sendUserData'] = (bool) $value;
    }

    protected function setBasket($basket)
    {
        if (!is_array($basket)) {
            throw new HelloPayRequestParamException('Value for basket has a wrong format!');
        }

        $basketAttributes = $this->getBasketAttributeKeys();
        $basketMandatoryAttributes = $this->getBasketMandatoryAttributeKeys();

        $basketNew = array();
        foreach ($basketAttributes as $basketItemKey) {
            if (isset($basket[$basketItemKey])
                && empty($basket[$basketItemKey])
                && in_array($basketItemKey, $basketMandatoryAttributes)
            ) {
                throw new HelloPayRequestParamException(
                    'Value for the basket key: ' . $basketItemKey . ' must not be empty!'
                );
            }
            if (isset($basket[$basketItemKey])) {
                if ($basketItemKey == 'basketItems') {
                    $basket[$basketItemKey] = array_map(
                        array($this, 'setBasketItems'),
                        $basket[$basketItemKey]
                    );
                }
                $basketNew[$basketItemKey] = $basket[$basketItemKey];
            }
        }

        $this->data['basket'] = $basketNew;
    }

    protected function setBasketItems($basketItems)
    {
        if (!is_array($basketItems)) {
            throw new HelloPayRequestParamException('Value for basketItems has a wrong format!');
        }

        $basketItemsAttributes = $this->getBasketItemsAttributeKeys();
        $basketItemsMandatory = $this->getBasketItemsMandatoryKeys();

        $basketItemsNew = array();
        foreach ($basketItemsAttributes as $basketItemKey) {
            if (isset($basketItems[$basketItemKey])
                && empty($basketItems[$basketItemKey])
                && in_array($basketItemKey, $basketItemsMandatory)
            ) {
                throw new HelloPayRequestParamException(
                    'Value for the basket basketItems key: ' . $basketItemKey . ' must not be empty!'
                );
            } elseif (isset($basketItems[$basketItemKey])) {
                $basketItemsNew[$basketItemKey] = $basketItems[$basketItemKey];
            }
        }

        return $basketItemsNew;
    }

    protected function setNestedValue($nestedKey, $value)
    {
        if (!is_array($value)) {
            throw new HelloPayRequestParamException("Value for $nestedKey has a wrong format!");
        }
        $getClassName = 'get' . ucfirst($nestedKey) . 'AttributeKeys';
        $getClassNameMandatory = 'get' . ucfirst($nestedKey) . 'AttributeMandatoryKeys';

        $attributes = $this->$getClassName();
        $attributesMandatory = $this->$getClassNameMandatory();

        $valueNew = array();
        foreach ($attributes as $itemKey) {
            if (isset($value[$itemKey]) && empty($value[$itemKey])
                && in_array($itemKey, $attributesMandatory)
            ) {
                throw new HelloPayRequestParamException(
                    "Value for the $nestedKey key: $itemKey  must not be empty!"
                );
            } elseif (isset($value[$itemKey])) {
                $valueNew[$itemKey] = $value[$itemKey];
            } else {
                $valueNew[$itemKey] = '';
            }
        }

        $this->data[$nestedKey] = $valueNew;
    }

    protected function setShippingAddress($value)
    {
        $this->setNestedValue('shippingAddress', $value);
    }

    protected function setBillingAddress($value)
    {
        $this->setNestedValue('billingAddress', $value);
    }
    protected function setConsumerData($value)
    {
        $this->setNestedValue('consumerData', $value);
    }
}
