-- --------------------------------------------------------

--
-- Table structure for table `shop_order`
--

DROP TABLE IF EXISTS `shop_order`;
CREATE TABLE `shop_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_id` int(11) DEFAULT NULL,
  `total_amount` double DEFAULT NULL COMMENT 'This amount is included site_commission',
  `site_commission` double DEFAULT NULL COMMENT 'This is is site commission amount for all item',
  `currency` varchar(100) DEFAULT NULL,
  `order_status` enum('draft','pending_payment','payment_completed','refund_requested','refund_completed','refund_rejected') DEFAULT 'draft',
  `pay_key` varchar(255) DEFAULT NULL,
  `tracking_id` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_response` text,
  `date_created` datetime DEFAULT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_item`
--

DROP TABLE IF EXISTS `shop_order_item`;
CREATE TABLE `shop_order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `item_owner_id` int(11) DEFAULT NULL,
  `item_amount` double DEFAULT NULL,
  `services_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `service_ids` varchar(255) DEFAULT NULL,
  `item_type` enum('product') DEFAULT 'product',
  `site_commission` double DEFAULT NULL,
  `seller_amount` double DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
