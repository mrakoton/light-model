DROP DATABASE orm;
CREATE DATABASE orm DEFAULT CHARSET UTF8 DEFAULT COLLATE utf8_unicode_ci;

USE orm;

CREATE TABLE user (
  id int PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  firstname VARCHAR(255),
  lastname VARCHAR(255),
  weight FLOAT,
  height INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO user (username, firstname, lastname, weight, height) VALUES
('ThomThom', 'Thomas', 'Johnson', 65.7, 180),
('Tonton', 'Janus', 'Palar', 114.5, 180);
