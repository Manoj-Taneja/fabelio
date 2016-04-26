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
 * Class Base
 *
 * @package HelloPay
 */
abstract class Base
{
    protected $data = array();

    public function __construct(array $data)
    {
        foreach ($this->getAttributeKeys() as $key) {
            $this->data[$key] = null;
        }

        if (is_array($data)) {
            $this->setData($data);
        }
    }

    abstract public function getAttributeKeys();

    public function getData()
    {
        foreach ($this->data as $key => $value) {
            $this->checkValueOfMandatoryKey($key, $value);
        }

        return 'data=' . json_encode($this->data);
    }

    public function setData(array $data)
    {
        foreach ($data as $key => $value) {
            if ($this->hasKey($key)) {
                $this->setValue($key, $value);
            }
        }
    }

    public function getValue($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @throws HelloPayRequestParamException
     */
    public function setValue($key, $value)
    {
        $this->checkValueOfMandatoryKey($key, $value);

        $setterName = 'set' . ucfirst($key);
        if (method_exists($this, $setterName)) {
            $this->$setterName($value);
        } else {
            $this->data[$key] = $value;
        }
    }

    public function hasKey($key)
    {
        return in_array($key, (array) $this->getAttributeKeys());
    }

    public function __get($key)
    {
        return $this->getValue($key);
    }

    public function __set($key, $value)
    {
        $this->setValue($key, $value);
    }

    protected function getMandatoryKeys()
    {
        return array();
    }

    protected function isMandatoryKey($key)
    {
        return in_array($key, $this->getMandatoryKeys());
    }

    protected function checkValueOfMandatoryKey($key, $value)
    {
        if ($this->isMandatoryKey($key) && $value === null) {
            throw new HelloPayRequestParamException('Value for the key ' . $key . ' must not be empty!');
        }
    }
}
