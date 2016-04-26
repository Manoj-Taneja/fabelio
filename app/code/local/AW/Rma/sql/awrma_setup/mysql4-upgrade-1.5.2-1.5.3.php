<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Rma
 * @version    1.5.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


$installer = $this;
$installer->startSetup();

$sql = "UPDATE {$this->getTable('awrma/entity_status')}
           SET `to_customer` = \"<p>Your RMA {{var request.getTextId()}} has been approved.</p>\r\n{{depend request.getNotifyPrintlabelAllowed()}}<p>You can print a RMA label with return address and other information by clicking the following link:</p>{{var request.getPrintlabelLink()}}<p>The RMA label must be enclosed inside your package; you may want to keep a copy of the label for your records.</p>{{/depend}}\r\n<p>Please send your package to:</p>\r\n<p>{{var request.getNotifyRmaAddress()}}</p>{{depend request.getConfirmShippingIsRequired()}}<p>and click the \\\"Confirm Sending\\\" button after.</p>{{/depend}}\"
         WHERE `name` = 'Approved'
           AND `to_customer` LIKE \"<p>Your_RMA_{{var_request.getTextId()}}_has_been_approved.</p>\r\n{{depend_request.getNotifyPrintlabelAllowed()}}<p>You_can_print_a%Return_Shipping_Authorization%label_with_return_address_and_other_information_by_pressing_link_above%A%Return_Shipping_Authorization%label_must_be_enclosed_inside_your_package%you_may_want_to_keep_a_copy_of%Return_Shipping_Authorization%label_for_your_records%</p>\r\n{{/depend}}\r\n<p>Please_send_your_package_to_</p>\r\n<p>{{var_request.getNotifyRmaAddress()}}</p>\r\n{{depend_request.getConfirmShippingIsRequired()}}<p>and_press%Confirm_Sending%button_after_</p>{{/depend}}\"
         ;";
$installer->run($sql);

$sql = "UPDATE {$this->getTable('awrma/entity_status')}
           SET `to_chatbox` = \"Your RMA {{var request.getTextId()}} has been approved.\r\n{{depend request.getNotifyPrintlabelAllowed()}}You can print a RMA label with return address and other information by clicking the following link:\r\n{{var request.getPrintLabelUrl()}}\r\nThe RMA label must be enclosed inside your package; you may want to keep a copy of the label for your records.{{/depend}}\r\nPlease send your package to:\r\n{{var request.getNotifyRmaAddress()}}{{depend request.getConfirmShippingIsRequired()}}\r\nand click the \\\"Confirm Sending\\\" button after.{{/depend}}\"
         WHERE `name` = 'Approved'
           AND `to_chatbox` LIKE \"Your_RMA_has_been_approved.\r\n{{depend_request.getNotifyPrintlabelAllowed()}}You_can_print_a%Return_Shipping_Authorization%label_with_return_address_and_other_information_by_pressing_link_above._A%Return_Shipping_Authorization%label_must_be_enclosed_inside_your_package%you_may_want_to_keep_a_copy_of%Return Shipping Authorization%label_for_your_records.\r\n{{/depend}}\r\nPlease_send_your_package_to%{{var_request.getNotifyRmaAddress()}}%and_press%Confirm_Sending%button_after%\"
         ;";
$installer->run($sql);

$sql = "UPDATE {$this->getTable('awrma/status_template')} SET
          `to_customer`=(SELECT `to_customer` FROM {$this->getTable('awrma/entity_status')} WHERE `name` = 'Approved'),
          `to_chatbox`=(SELECT `to_chatbox` FROM {$this->getTable('awrma/entity_status')} WHERE `name` = 'Approved')
        WHERE `name` = 'Approved'
        ;";
$installer->run($sql);

$sql = "ALTER TABLE {$this->getTable('awrma/entity_types')} ADD `removed` TINYINT(1) NOT NULL DEFAULT '0';
        ALTER TABLE {$this->getTable('awrma/entity_reason')} ADD `removed` TINYINT(1) NOT NULL DEFAULT '0';
        ";
$installer->run($sql);

$installer->endSetup();