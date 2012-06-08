
CREATE TABLE IF NOT EXISTS `page`
(
  `page_id`       int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name`          varchar(32) NOT NULL,
  `title`         varchar(200) NOT NULL,
  `keywords`      varchar(400) NOT NULL,
  `created_time`  datetime NOT NULL,
  `active`        tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `page_content`
(
  `page_id`        int(10) unsigned NOT NULL,
  `lang`           varchar(5) DEFAULT NULL,
  `modified_time`  datetime NOT NULL,
  `content`        longtext NOT NULL,
  KEY `page_id` (`page_id`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

