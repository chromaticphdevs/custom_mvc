CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` enum('MALE','FEMALE') NOT NULL,
  `user_type` enum('supervisor','staff','admin','teacher','student','parent') DEFAULT 'staff',
  `address` text DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile` text DEFAULT NULL,
  `user_identification` varchar(50) DEFAULT NULL,
  `user_key_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8


INSERT INTO users(username,password)
VALUES('uat','1111');

INSERT INTO users(username,password)
VALUES('dev','1111');

alter table users 
  add column user_identification varchar(50);