CREATE TABLE user (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  user_name VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  nickname VARCHAR(20) NOT NULL,
  exp INT default 0,
  money INT default 0,
  created_at TIMESTAMP NOT NULL default CURRENT_TIMESTAMP
) DEFAULT CHARSET UTF8 COMMENT 'userTable';

CREATE TABLE task (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  description VARCHAR(255) NOT NULL,
  level INT NOT NULL,
  user_id INT NOT NULL,
  complete_flag BOOLEAN NOT NULL default false,
  created_at TIMESTAMP NOT NULL default CURRENT_TIMESTAMP
) DEFAULT CHARSET UTF8 COMMENT 'taskTable';

CREATE TABLE reward (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  price INT NOT NULL,
  user_id INT NOT NULL,
  created_at TIMESTAMP NOT NULL default CURRENT_TIMESTAMP
) DEFAULT CHARSET UTF8 COMMENT 'rewardTable';

ALTER TABLE task ADD FOREIGN KEY fk_user_id(user_id) REFERENCES user(id);

ALTER TABLE reward ADD FOREIGN KEY fk_user_id(user_id) REFERENCES user(id);


# テストデータ挿入
INSERT INTO user (user_name, password, nickname) VALUES (
  'd.imabeppu', 'test', 'beppu'
);
INSERT INTO task (name, description, level, user_id) VALUES (
  '腹筋10回', 'これはテストタスクです.', 1, 1
);

INSERT INTO reward (name, price, user_id) VALUES (
  'アイス', 10, 1
);