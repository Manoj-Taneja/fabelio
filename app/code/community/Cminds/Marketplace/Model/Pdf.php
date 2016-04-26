<?php
class Cminds_Marketplace_Model_Pdf extends Mage_Sales_Model_Order_Pdf_Abstract {

    const CONFIG_GLOBAL = 'marketplace_shipping_labels';
    const XML_FONTSIZE = 'font_size';
    const XML_PAGEWIDTH = 'page_width';
    const XML_PAGEHEIGHT = 'page_height';
    const XML_TOPMARGIN = 'top_margin';
    const XML_SIDEMARGIN = 'side_margin';
    const XML_NUMBERDOWN = 'number_down';
    const XML_NUMBERACROSS = 'number_across';
    const XML_VERTICALPITCH = 'vertical_pitch';
    const XML_HORIZONTALPITCH = 'horizontal_pitch';
    const XML_BOLDNAME = 'bold_name';
    const XML_STARTFROM = 'start_from';
    const XML_TOPPADDING = 'top_padding';
    const XML_LEFTPADDING = 'left_padding';
    
    protected $_configSettings = array();
    protected $_currLabel;
    protected $_currRow;
    protected $_currColumn;
    protected $_carrier;
    protected $x;
    protected $orderId;

    public function setCarrier($carrier) {
        $this->_carrier = $carrier;
    }

    protected function _config($config) {

        if(!$this->_carrier) {
            throw new Exception("No carrier code provided");
        }

        $space = self::CONFIG_GLOBAL . '/' . $this->_carrier . '/' . $config;
        if (!isset($this->_configSettings[$space])) {
            $this->_configSettings[$space] = Mage::getStoreConfig($space);
        }
        return $this->_configSettings[$space];
    }
    protected function _convertInchToPoints($inch) {
        return floor($inch * 72);
    }
    protected function _setFontRegular($object, $size = 8)
    {
        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA); 
        $object->setFont($font, $size);
        return $font;
    }
    protected function _setFontBold($object, $size = 8)
    {
        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA_BOLD); 
        $object->setFont($font, $size);
        return $font;
    }
    
    protected function _getConfigFontSize() {
        return (float)$this->_config(self::XML_FONTSIZE);
    }
    protected function _moveRow($keepColPos = false) {
        $this->_currRow++;
        $this->y -= floor($this->_convertInchToPoints((float)$this->_config(self::XML_VERTICALPITCH))) - $this->_getConfigFontSize();
        if (!$keepColPos) {
            $this->x = floor($this->_convertInchToPoints((float)$this->_config(self::XML_SIDEMARGIN)));
        }
        return $this;
    }
    protected function _moveColumn() {
        $this->_currColumn++;
        $this->x += floor($this->_convertInchToPoints($this->_config(self::XML_HORIZONTALPITCH)));
        return $this;
    }
    public function setOrderId($orderId) {
        $this->orderId = $orderId;
    }
    public function newPage(array $settings = array()) {
        $pageWidth = $this->_convertInchToPoints((float)$this->_config(self::XML_PAGEWIDTH));
        $pageHeight = $this->_convertInchToPoints((float)$this->_config(self::XML_PAGEHEIGHT));
        $settings = array('page_size' => $pageWidth.":".$pageHeight.":");
        $page = parent::newPage($settings);
        $this->x = floor($this->_convertInchToPoints((float)$this->_config(self::XML_SIDEMARGIN)));
        $this->y = floor($pageHeight - $this->_convertInchToPoints((float)$this->_config(self::XML_TOPMARGIN))) - $this->_getConfigFontSize();
        $page->setFillColor(new Zend_Pdf_Color_GrayScale(0));
        $this->_setFontRegular($page, $this->_getConfigFontSize());
        $this->_currLabel = 1;
        $this->_currRow = 1;
        $this->_currColumn = 1;
        return $page;
    }
    public function getPdf() {
        $fontSize = $this->_getConfigFontSize();
        $this->_beforeGetPdf();
        $pdf = new Zend_Pdf();
        $this->_setPdf($pdf);
        $style = new Zend_Pdf_Style();
        $this->_setFontRegular($style, $fontSize);
        $page = $this->newPage();
        $numberAcross = (int)$this->_config(self::XML_NUMBERACROSS);
        $numberDown = (int)$this->_config(self::XML_NUMBERDOWN);
        $totalInSheet = $numberAcross * $numberDown;
        $startRow = 1;
        $startCol = 1;
        $startFrom = trim($this->_config(self::XML_STARTFROM));
        if ($startFrom != "") {
            list($startRow, $startCol) = explode(',', $startFrom);
        }
        $adjusted = false;
        $order = Mage::getModel('sales/order')->load($this->orderId);
        
        if ($order->getIsVirtual()) {
            return;
        }
        
        $adjusted1 = false;
        if (!$adjusted) {
            while ($this->_currRow < $startRow || $this->_currColumn < $startCol) {
                if ($this->_currRow < $startRow) {
                    $this->_moveRow(true);
                    $this->_currLabel += $numberAcross;
                }
                if ($this->_currColumn < $startCol) {
                    $this->_moveColumn();
                    $this->_currLabel += 1;
                }
                if ($this->_currLabel > 1000) {
                    Mage::throwException('Error');
                }
                $adjusted = $adjusted1 = true;
            }
        }
        
        if ($this->_currLabel > $totalInSheet) {
            $page = $this->newPage();
        }
        
        if (!$adjusted1 && $this->_currLabel > 1 && ($this->_currLabel - 1) % $numberAcross == 0) {
            $this->_moveRow();
        }

        $tempY = $this->y;
        $tempX = $this->x;

        $shippingAddress = $this->_formatAddress($order->getShippingAddress()->format('pdf'));
        $this->y -= $this->_convertInchToPoints((float)$this->_config(self::XML_TOPPADDING));
        $this->x += $this->_convertInchToPoints((float)$this->_config(self::XML_LEFTPADDING));
        $firstLine = true;
        foreach ($shippingAddress as $value){
            if ($this->_config(self::XML_BOLDNAME)) {
                if ($firstLine) {
                    $this->_setFontBold($page, $this->_getConfigFontSize());
                    $firstLine = false;
                }
                else {
                    $this->_setFontRegular($page, $this->_getConfigFontSize());
                }
            }
            if ($value!=='') {
                $page->drawText(strip_tags(ltrim($value)), $this->x, $this->y, 'UTF-8');
                $this->y -= $fontSize + ($fontSize * 0.2);
            }
        }
        $this->y = $tempY;
        $this->x = $tempX;
        
        /* Move column */
        $this->_moveColumn();

        /* Increase label count */
        $this->_currLabel++;
        $this->_afterGetPdf();
        return $pdf;
    }
}