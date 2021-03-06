CREATE TABLE user (
  user_id VARCHAR(20) NOT NULL PRIMARY KEY,
  password VARCHAR(255) NOT NULL,
  nickname VARCHAR(20) NOT NULL,
  money INT default 0,
  created_at TIMESTAMP NOT NULL default CURRENT_TIMESTAMP
) DEFAULT CHARSET UTF8 COMMENT 'userTable';

CREATE TABLE fitness (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  level INT NOT NULL,
  category INT NOT NULL,
  user_id VARCHAR(20) NOT NULL,
  delete_flag BOOLEAN NOT NULL default false,
  created_at TIMESTAMP NOT NULL default CURRENT_TIMESTAMP
) DEFAULT CHARSET UTF8 COMMENT 'fitnessTable';

CREATE TABLE reward (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  price INT NOT NULL,
  user_id  VARCHAR(20) NOT NULL,
  delete_flag BOOLEAN NOT NULL default false,
  created_at TIMESTAMP NOT NULL default CURRENT_TIMESTAMP
) DEFAULT CHARSET UTF8 COMMENT 'rewardTable';

ALTER TABLE fitness ADD FOREIGN KEY fk_user_id(user_id) REFERENCES user(user_id);

ALTER TABLE reward ADD FOREIGN KEY fk_user_id(user_id) REFERENCES user(user_id);