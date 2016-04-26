<?php

Class Eadesigndev_Romcity_Model_Eacore_Feed extends Mage_AdminNotification_Model_Feed
{

    protected $eadesignUrl;

    public function checkUpdate()
    {

        if (($this->getFrequency() + $this->getLastUpdate()) > time()) {
            return $this;
        }

        $this->getClientData();
        $feedData = array();

        $feedXml = $this->getFeedData();

        if ($feedXml && $feedXml->channel && $feedXml->channel->item) {
            foreach ($feedXml->channel->item as $item) {
                $feedData[] = array(
                    'severity' => (int)$item->severity,
                    'date_added' => $this->getDate((string)$item->pubDate),
                    'title' => (string)$item->title,
                    'description' => (string)$item->description,
                    'url' => (string)$item->link,
                );
            }


            if ($feedData) {
                Mage::getModel('adminnotification/inbox')->parse(array_reverse($feedData));
            }

        }

        $this->setLastUpdate();

        return $this;
    }


    /**
     * Retrieve Last update time
     *
     * @return int
     */
    public function getLastUpdate()
    {
        return Mage::app()->loadCache('eadesign_lastcheck');
    }

    /**
     * Set last update time (now)
     *
     * @return Mage_AdminNotification_Model_Feed
     */
    public function setLastUpdate()
    {
        Mage::app()->saveCache(time(), 'eadesign_lastcheck');
        return $this;
    }

    public function getFeedUrl()
    {
        if (is_null($this->eadesignUrl)) {
            $this->eadesignUrl = 'https://www.eadesign.ro/notifications.rss';
        }
        return $this->eadesignUrl;
    }


    public function getFeedData()
    {
        $curl = new Varien_Http_Adapter_Curl();
        $curl->setConfig(array(
            'timeout' => 3
        ));

        $curl->write(Zend_Http_Client::GET, $this->getFeedUrl(), '1.0');
        $data = $curl->read();
        if ($data === false) {
            return false;
        }
        $data = preg_split('/^\r?$/m', $data, 2);
        $data = trim($data[1]);
        $curl->close();

        try {
            $xml = new SimpleXMLElement($data);
        } catch (Exception $e) {
            return false;
        }

        return $xml;
    }

    public function getClientData()
    {
        $eadesignUrl = 'https://www.eadesign.ro/';

        $extension = 'Eadesigndev_Romcity';

        $moduleVersion = Mage::getConfig()->getModuleConfig($extension)->version;

        $baseUrl = 'track/index/update?url=' . Mage::getBaseUrl();
        $version = '&version=' . $moduleVersion;
        $moduleExtension = '&extension='.$extension;

        $url = $eadesignUrl.$baseUrl.$version.$moduleExtension;

        $curl = new Varien_Http_Adapter_Curl();
        $curl->setConfig(array(
            'timeout' => 3
        ));

        $curl->write(Zend_Http_Client::GET, $url, '1.0');
        $curl->read();
        $curl->close();
    }

}
