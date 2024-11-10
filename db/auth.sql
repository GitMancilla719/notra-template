CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(40) NOT NULL,
  `uid` int(11) NOT NULL,
  `expiredate` int(11) NOT NULL,
  `ip` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
);