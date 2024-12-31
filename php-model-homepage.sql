CREATE TABLE `user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50),
  `email` varchar(100),
  `password` varchar(250),
  `master` boolean,
  `active` boolean,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `page` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(30),
  `active` boolean,
  `created_at` timestamp,
  `id_user` int,
  `updated_at` timestamp
);

CREATE TABLE `page_detail` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(30),
  `active` boolean,
  `position` int,
  `order` int,
  `created_at` timestamp,
  `id_page` int,
  `updated_at` timestamp
);

CREATE TABLE `page_attached` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `content` text,
  `active` boolean,
  `position` int,
  `order` int,
  `created_at` timestamp,
  `id_page_detail` int,
  `updated_at` timestamp
);

ALTER TABLE `page` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

ALTER TABLE `page_detail` ADD FOREIGN KEY (`id_page`) REFERENCES `page` (`id`);

ALTER TABLE `page_attached` ADD FOREIGN KEY (`id_page_detail`) REFERENCES `page_detail` (`id`);
