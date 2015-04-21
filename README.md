# ShortenUrl
Web Application that gives you a shorten URL

1)Run composer install
2)Copy config.php.dist to config.php and fill your parameters
3)Create your database
4)Create table  :

CREATE TABLE `url_match` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `long_url` varchar(255) NOT NULL DEFAULT '',
  `short_url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `long_url` (`long_url`)
  )
