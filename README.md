# HELPER
Helpers for codeigniter framework

SQL FOR GETMODUL

CREATE TABLE `modul` ( `id` int(2) NOT NULL AUTO_INCREMENT, `name` varchar(16) DEFAULT NULL, `parentId` int(2) DEFAULT NULL, `dateCreated` datetime DEFAULT NULL, `dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, `order` int(2) DEFAULT NULL, `url` varchar(128) DEFAULT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1
