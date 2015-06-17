<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS mq_slides;

CREATE TABLE IF NOT EXISTS `mq_slides` (
  `slide_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `slide_url` varchar(500) NOT NULL DEFAULT '',
  `slide_target` varchar(255) NOT NULL DEFAULT '',
  `slide_content` text NOT NULL,
  `action_button_text` varchar(255) NOT NULL DEFAULT '',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `sort_order` tinyint(6) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

");



$installer->endSetup(); 