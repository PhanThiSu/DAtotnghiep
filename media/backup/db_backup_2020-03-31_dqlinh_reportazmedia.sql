DROP TABLE IF EXISTS logs;

CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `event` text NOT NULL,
  `status` int(11) NOT NULL,
  `ip` text NOT NULL,
  `location` text NOT NULL,
  `browser` text NOT NULL,
  `os` text NOT NULL,
  `agent` text NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

INSERT INTO logs VALUES("1","2020-03-27 16:41:22","4","Login","1","115.73.112.217"," Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36&quot;","16","106","2020-03-27 04:41:22","2020-03-27 04:41:22",""),
("2","2020-03-27 16:44:16","4","Logout","1","115.73.112.217"," Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36&quot;","16","106","2020-03-27 04:44:16","2020-03-27 04:44:16",""),
("3","2020-03-27 16:44:39","4","Login","1","115.73.112.217"," Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36&quot;","16","106","2020-03-27 04:44:39","2020-03-27 04:44:39",""),
("4","2020-03-27 21:48:55","0","Login","0","72.12.194.92","West Lafayette United States","Chrome","Windows 10","&quot;Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36&quot;","40.444","-86.9237","2020-03-27 09:48:55","2020-03-27 09:48:55","munozpatrick@yahoo.com"),
("5","2020-03-27 21:48:55","0","Login","0","70.113.252.69"," United States","Chrome","Windows 10","&quot;Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36&quot;","37.751","-97.822","2020-03-27 09:48:55","2020-03-27 09:48:55","abradley@yahoo.com"),
("6","2020-03-27 21:48:55","0","Login","0","72.12.194.92","West Lafayette United States","Chrome","Windows 10","&quot;Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36&quot;","40.444","-86.9237","2020-03-27 09:48:55","2020-03-27 09:48:55","munozpatrick@yahoo.com"),
("7","2020-03-27 21:48:55","0","Login","0","70.113.252.69"," United States","Chrome","Windows 10","&quot;Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36&quot;","37.751","-97.822","2020-03-27 09:48:55","2020-03-27 09:48:56","abradley@yahoo.com"),
("8","2020-03-27 21:48:56","0","Login","0","72.12.194.94","West Lafayette United States","Chrome","Windows 10","&quot;Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36&quot;","40.444","-86.9237","2020-03-27 09:48:56","2020-03-27 09:48:56","munozpatrick@yahoo.com"),
("9","2020-03-27 21:48:56","0","Login","0","70.113.252.69"," United States","Chrome","Windows 10","&quot;Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36&quot;","37.751","-97.822","2020-03-27 09:48:56","2020-03-27 09:48:56","abradley@yahoo.com"),
("10","2020-03-30 09:29:48","4","Login","1","116.110.246.130","Da Nang Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36&quot;","16.0678","108.2208","2020-03-30 09:29:48","2020-03-30 09:29:48",""),
("11","2020-03-30 09:44:51","0","Login","0","116.110.246.130","Da Nang Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36&quot;","16.0678","108.2208","2020-03-30 09:44:51","2020-03-30 09:44:51","nguyenthimy20101998@gmail.com"),
("12","2020-03-30 10:25:48","0","Login","0","171.231.241.133"," Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36&quot;","16","106","2020-03-30 10:25:49","2020-03-30 10:25:49","pacificsoftdev@gmail.com"),
("13","2020-03-30 10:29:50","0","Login","0","171.231.241.133"," Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36&quot;","16","106","2020-03-30 10:29:50","2020-03-30 10:29:50","mynguyen@gmail.com"),
("14","2020-03-30 10:37:41","0","Login","0","171.231.241.133"," Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36&quot;","16","106","2020-03-30 10:37:41","2020-03-30 10:37:41","mynguyen@gmail.com"),
("15","2020-03-30 10:38:07","0","Login","0","171.231.241.133"," Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36&quot;","16","106","2020-03-30 10:38:07","2020-03-30 10:38:07","softdevelopinc@gmail.com"),
("16","2020-03-30 10:42:23","4","Login","1","116.110.246.130","Da Nang Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36&quot;","16.0678","108.2208","2020-03-30 10:42:23","2020-03-30 10:42:23",""),
("17","2020-03-30 11:38:34","2","Login","0","116.110.246.130","Da Nang Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16.0678","108.2208","2020-03-30 11:38:34","2020-03-30 11:38:34","haiduongdana@gmail.com"),
("18","2020-03-30 11:38:51","2","Login","0","116.110.246.130","Da Nang Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16.0678","108.2208","2020-03-30 11:38:51","2020-03-30 11:38:51","haiduongdana@gmail.com"),
("19","2020-03-30 12:00:26","3","Login","1","116.110.246.130","Da Nang Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16.0678","108.2208","2020-03-30 12:00:26","2020-03-30 12:00:26",""),
("20","2020-03-30 13:34:50","0","Login","0","171.231.241.133"," Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36&quot;","16","106","2020-03-30 01:34:50","2020-03-30 01:34:50","pacificsoftdev@gmail.com"),
("21","2020-03-30 13:39:53","3","Login","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 01:39:53","2020-03-30 01:39:53",""),
("22","2020-03-30 14:59:59","3","Login","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 02:59:59","2020-03-30 02:59:59",""),
("23","2020-03-30 14:59:59","3","Login","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 02:59:59","2020-03-30 02:59:59",""),
("24","2020-03-30 16:22:40","6","Login","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:22:40","2020-03-30 04:22:40",""),
("25","2020-03-30 16:23:57","6","Login","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:23:57","2020-03-30 04:23:57",""),
("26","2020-03-30 16:25:05","6","Login","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:25:05","2020-03-30 04:25:05",""),
("27","2020-03-30 16:25:55","6","Login","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:25:55","2020-03-30 04:25:55",""),
("28","2020-03-30 16:27:32","6","Login","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:27:32","2020-03-30 04:27:32",""),
("29","2020-03-30 16:29:11","6","Login","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:29:11","2020-03-30 04:29:11",""),
("30","2020-03-30 16:33:35","6","Login","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:33:35","2020-03-30 04:33:35",""),
("31","2020-03-30 16:34:38","6","Add report","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:34:38","2020-03-30 04:34:38","8"),
("32","2020-03-30 16:34:50","6","Edit report","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:34:50","2020-03-30 04:34:50","8"),
("33","2020-03-30 16:34:56","6","Delete report","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:34:56","2020-03-30 04:34:56","8"),
("34","2020-03-30 16:37:02","6","Edit profile","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:37:02","2020-03-30 04:37:02",""),
("35","2020-03-30 16:37:33","6","Update password","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:37:33","2020-03-30 04:37:33",""),
("36","2020-03-30 16:39:33","6","Add report","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:39:33","2020-03-30 04:39:33","9"),
("37","2020-03-30 16:40:31","6","Add report","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:40:31","2020-03-30 04:40:31","10"),
("38","2020-03-30 16:41:32","6","Add report","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:41:32","2020-03-30 04:41:32","11"),
("39","2020-03-30 16:44:29","6","Delete report","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:44:29","2020-03-30 04:44:29","11"),
("40","2020-03-30 16:48:04","6","Add report","1","171.231.241.133"," Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16","106","2020-03-30 04:48:04","2020-03-30 04:48:04","12"),
("41","2020-03-30 21:57:33","6","Login","1","1.52.205.200","Ho Chi Minh City Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","10.8142","106.6438","2020-03-30 09:57:33","2020-03-30 09:57:33",""),
("42","2020-03-30 22:34:10","6","Delete report","1","1.52.205.200","Ho Chi Minh City Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","10.8142","106.6438","2020-03-30 10:34:10","2020-03-30 10:34:10","12"),
("43","2020-03-30 22:35:22","6","Delete report","1","1.52.205.200","Ho Chi Minh City Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","10.8142","106.6438","2020-03-30 10:35:22","2020-03-30 10:35:22","9"),
("44","2020-03-30 23:11:36","6","Add request","1","1.52.205.200","Ho Chi Minh City Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","10.8142","106.6438","2020-03-30 11:11:36","2020-03-30 11:11:36","1"),
("45","2020-03-30 23:12:16","6","Add request","1","1.52.205.200","Ho Chi Minh City Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","10.8142","106.6438","2020-03-30 11:12:16","2020-03-30 11:12:16","2"),
("46","2020-03-30 23:13:11","6","Add request","1","1.52.205.200","Ho Chi Minh City Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","10.8142","106.6438","2020-03-30 11:13:11","2020-03-30 11:13:11","3"),
("47","2020-03-30 23:14:16","6","Add request","1","1.52.205.200","Ho Chi Minh City Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","10.8142","106.6438","2020-03-30 11:14:16","2020-03-30 11:14:16","4"),
("48","2020-03-30 23:17:50","6","Add request","1","1.52.205.200","Ho Chi Minh City Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","10.8142","106.6438","2020-03-30 11:17:50","2020-03-30 11:17:50","5"),
("49","2020-03-31 10:59:14","3","Login","1","116.110.246.22","Da Nang Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36&quot;","16.0678","108.2208","2020-03-31 10:59:14","2020-03-31 10:59:14",""),
("50","2020-03-31 11:30:07","3","Add request","1","116.110.246.22","Da Nang Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36&quot;","16.0678","108.2208","2020-03-31 11:30:07","2020-03-31 11:30:07","6"),
("51","2020-03-31 13:33:01","6","Login","1","116.110.246.22","Da Nang Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16.0678","108.2208","2020-03-31 01:33:01","2020-03-31 01:33:01",""),
("52","2020-03-31 14:42:59","3","Login","1","116.110.246.22","Da Nang Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16.0678","108.2208","2020-03-31 02:42:59","2020-03-31 02:42:59",""),
("53","2020-03-31 14:42:59","3","Login","1","116.110.246.22","Da Nang Vietnam","Firefox","Ubuntu","&quot;Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:74.0) Gecko/20100101 Firefox/74.0&quot;","16.0678","108.2208","2020-03-31 02:42:59","2020-03-31 02:42:59",""),
("54","2020-03-31 14:47:24","4","Login","1","116.110.246.22","Da Nang Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36&quot;","16.0678","108.2208","2020-03-31 02:47:24","2020-03-31 02:47:24",""),
("55","2020-03-31 14:47:39","4","Login","1","116.110.246.22","Da Nang Vietnam","Chrome","Linux","&quot;Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36&quot;","16.0678","108.2208","2020-03-31 02:47:39","2020-03-31 02:47:39","");



DROP TABLE IF EXISTS reports;

CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_report` date NOT NULL,
  `job` text NOT NULL,
  `group_id` int(11) NOT NULL,
  `time_start` datetime DEFAULT NULL,
  `work_time` float NOT NULL,
  `time_end` datetime NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `notes` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

INSERT INTO reports VALUES("5","6","2020-03-30","training","1","2019-09-25 00:00:00","9","2019-09-26 00:00:00","ip","","2020-03-30 03:41:22","2020-03-30 03:41:22"),
("13","9","2020-03-31","training","1","2020-03-31 00:00:00","8","2020-04-01 00:00:00","d","","2020-03-31 02:12:26","2020-03-31 02:12:26"),
("15","9","2020-03-31"," training ","1","2020-03-31 00:00:00","8","2020-04-30 00:00:00","ip","  ","2020-03-31 02:23:47","2020-03-31 02:23:47"),
("16","9","2020-03-31","training","1","2020-03-31 00:00:00","12","2020-03-31 00:00:00","ip","","2020-03-31 03:26:03","2020-03-31 03:26:03"),
("17","9","2020-03-31","  traa","1","2020-04-01 00:00:00","9","2020-04-01 00:00:00","ip","  ","2020-03-31 03:26:52","2020-03-31 03:26:52"),
("18","10","2020-03-31","training","1","2020-03-31 00:00:00","8","2020-03-31 00:00:00","ip","","2020-03-31 03:48:56","2020-03-31 03:48:56");



DROP TABLE IF EXISTS requests;

CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `datetime_start` datetime NOT NULL,
  `datetime_end` datetime NOT NULL,
  `reason` text NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO requests VALUES("11","10","2020-04-01 00:00:00","2020-04-02 00:00:00","jjkjk","0","2020-03-31 04:04:22","2020-03-31 04:04:22"),
("12","10","2020-03-31 00:00:00","2020-03-31 00:00:00","ff","0","2020-03-31 04:04:39","2020-03-31 04:04:39");



