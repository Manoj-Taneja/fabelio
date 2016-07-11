-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `shipping_matrixrate`;
CREATE TABLE `shipping_matrixrate` (
  `pk` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `website_id` int(11) NOT NULL DEFAULT '0',
  `dest_country_id` varchar(4) NOT NULL DEFAULT '0',
  `dest_region_id` int(10) NOT NULL DEFAULT '0',
  `dest_city` varchar(30) NOT NULL DEFAULT '',
  `dest_zip` varchar(10) NOT NULL DEFAULT '',
  `dest_zip_to` varchar(10) NOT NULL DEFAULT '',
  `condition_name` varchar(20) DEFAULT '',
  `condition_from_value` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `condition_to_value` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `cost` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `sku` varchar(255) NOT NULL,
  `stock` int(10) NOT NULL,
  `express_fee_enabled` int(1) NOT NULL,
  `dest_location` varchar(255) NOT NULL,
  `express_fee` int(10) NOT NULL,
  `standard_fee` int(10) NOT NULL,
  `express_number_of_days` int(10) NOT NULL,
  `standard_number_of_days` int(10) NOT NULL,
  `delivery_type` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`pk`),
  UNIQUE KEY `dest_country` (`website_id`,`dest_country_id`,`dest_region_id`,`dest_city`,`dest_zip`,`dest_zip_to`,`condition_name`,`condition_from_value`,`condition_to_value`,`delivery_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `shipping_matrixrate` (`pk`, `website_id`, `dest_country_id`, `dest_region_id`, `dest_city`, `dest_zip`, `dest_zip_to`, `condition_name`, `condition_from_value`, `condition_to_value`, `price`, `cost`, `sku`, `stock`, `express_fee_enabled`, `dest_location`, `express_fee`, `standard_fee`, `express_number_of_days`, `standard_number_of_days`, `delivery_type`) VALUES
(8,	1,	'IN',	0,	'',	'',	'',	NULL,	12160.0000,	12160.0000,	55.0000,	0.0000,	'EMOST004081',	3,	1,	'jakarta',	55,	25,	0,	1,	'Express'),
(9,	1,	'IN',	0,	'',	'',	'',	NULL,	12160.0000,	12160.0000,	0.0000,	0.0000,	'EMOST004081',	3,	0,	'jakarta',	55,	25,	0,	1,	'Standard'),
(10,	1,	'0',	0,	'',	'',	'',	'',	0.0000,	0.0000,	55.0000,	0.0000,	'EMOCE00804',	0,	1,	'',	55,	25,	1,	5,	'Express'),
(11,	1,	'IN',	0,	'',	'',	'',	'',	0.0000,	0.0000,	25.0000,	0.0000,	'EMOCE00804',	0,	0,	'',	55,	25,	1,	5,	'Standard');

-- 2016-06-08 11:38:49

ALTER TABLE sales_flat_order_item ADD day_of_month varchar(244);
ALTER TABLE sales_flat_order_item ADD delivery_type varchar(244);

