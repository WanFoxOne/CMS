CREATE TABLE content_text (
  content_id INT(10) UNSIGNED  NOT NULL AUTO_INCREMENT,
  locale     ENUM ('fr', 'en') NOT NULL DEFAULT 'fr',
  text       TEXT,
  PRIMARY KEY (content_id, locale)
)
  ENGINE = MYISAM
  DEFAULT CHARSET = utf8;

