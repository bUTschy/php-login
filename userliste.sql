CREATE TABLE `userliste` (
  `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `upass` varchar(255) NOT NULL,
  `umail` varchar(255) NOT NULL,  
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `userliste` (`uid`, `uname`, `upass`, `umail`) VALUES
(1, 'Admin', 'passwort', 'demo@default.de');
