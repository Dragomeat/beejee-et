CREATE TABLE `tasks` (
  `id` varchar(255) NOT NULL,
  `performer_id` varchar(255) NOT NULL,
  `goal` text NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
