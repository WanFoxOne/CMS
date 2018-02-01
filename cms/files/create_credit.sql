CREATE TABLE IF NOT EXISTS `credits` (
  `user_id` INT(11) NOT NULL,
  `credit`  INT(11) NOT NULL,
  PRIMARY KEY (`user_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;