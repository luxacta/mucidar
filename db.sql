CREATE TABLE users (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_token` varchar(64) DEFAULT NULL,
  `verification_token_expiry` datetime DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;