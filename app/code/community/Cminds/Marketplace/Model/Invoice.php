<?php
    class Cminds_Marketplace_Model_Invoice extends Mage_Sales_Model_Service_Order {
        public function prepareInvoice($qtys = array()) {
            $this->updateLocaleNumbers($qtys);
            $invoice = $this->_convertor->toInvoice($this->_order);
            $totalQty = 0;

            $subtotal = 0;
            $baseSubtotal = 0;
            $subtotalInclTax = 0;
            $baseSubtotalInclTax = 0;
            $totalWeeeDiscount = 0;
            $totalBaseWeeeDiscount = 0;
            $tax = 0;
            $baseTax = 0;
            $hiddenTax = 0;
            $baseHiddenTax = 0;
            $discount = 0;
            $baseDiscount = 0;

            $itemCount = count($this->_order->getAllItems());
            $oneItemPrice = $this->_order->getShippingAmount() / $itemCount;
            $shippingCost = 0;
            foreach ($this->_order->getAllItems() as $orderItem) {
                if (!$this->_canInvoiceItem($orderItem, array()) ||
                    !isset($qtys[$orderItem->getId()])
                ) {
                    continue;
                }
                $item = $this->_convertor->itemToInvoiceItem($orderItem);
                if ($orderItem->isDummy()) {
                    $qty = $orderItem->getQtyOrdered() ? $orderItem->getQtyOrdered() : 1;
                } else if (!empty($qtys)) {
                    if (isset($qtys[$orderItem->getId()])) {
                        $qty = (float) $qtys[$orderItem->getId()];
                        if($qtys[$orderItem->getId()] > 0) {
                            $subtotal       += $orderItem->getRowTotal();
                            $baseSubtotal   += $orderItem->getBaseRowTotal();
                            $subtotalInclTax+= $orderItem->getRowTotalInclTax();
                            $baseSubtotalInclTax += $orderItem->getBaseRowTotalInclTax();
                            $totalWeeeDiscount += $orderItem->getDiscountAppliedForWeeeTax();
                            $totalBaseWeeeDiscount += $orderItem->getBaseDiscountAppliedForWeeeTax();
                            $tax            += $orderItem->getTaxAmount() - $orderItem->getTaxInvoiced();
                            $baseTax        += $orderItem->getBaseTaxAmount() - $orderItem->getBaseTaxInvoiced();
                            $hiddenTax      += $orderItem->getHiddenTaxAmount() - $orderItem->getHiddenTaxInvoiced();
                            $baseHiddenTax  += $orderItem->getBaseHiddenTaxAmount() - $orderItem->getBaseHiddenTaxInvoiced();

                            $discount  += $orderItem->getDiscountAmount();
                            $baseDiscount  += $orderItem->getBaseDiscountAmount();

                            $shippingCost += $oneItemPrice;
                        }
                    }
                } else {
                    $qty = $orderItem->getQtyToInvoice();
                }
                $totalQty += $qty;
                $item->setQty($qty);
                $invoice->addItem($item);
            }
            $invoice->setTotalQty($totalQty);
            $invoice->collectTotals();



            $invoice->setShippingAmount($shippingCost);
            $invoice->setBaseShippingAmount($shippingCost);
            $invoice->setShippingInclTax($shippingCost);
            $invoice->setBaseShippingInclTax($shippingCost);

            $invoice->setSubtotal($subtotal);
            $invoice->setBaseSubtotal($baseSubtotal);
            $invoice->setSubtotalInclTax($subtotalInclTax);
            $invoice->setBaseSubtotalInclTax($baseSubtotalInclTax);

            $invoice->setGrandTotal($subtotalInclTax + $oneItemPrice - $discount + $tax);
            $invoice->setBaseGrandTotal($baseSubtotalInclTax + $oneItemPrice - $baseDiscount + $baseTax);

            $invoice->setTaxAmount($tax);
            $invoice->setBaseTaxAmount($baseTax);
            $invoice->setHiddenTaxAmount($hiddenTax);
            $invoice->setBaseHiddenTaxAmount($baseHiddenTax);

            $invoice->setDiscountAmount(-$discount);
            $invoice->setBaseDiscountAmount(-$baseDiscount);

            $this->_order->getInvoiceCollection()->addItem($invoice);
            return $invoice;
        }
    }