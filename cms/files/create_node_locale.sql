CREATE TABLE node_locale (
node_id int( 10 ) unsigned NOT NULL AUTO_INCREMENT ,
locale enum( 'fr', 'en' ) NOT NULL DEFAULT 'fr',
name varchar( 100 ) NOT NULL ,
title varchar( 100 ) NOT NULL ,
abstract text,
cloud text,
PRIMARY KEY ( node_id , locale )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

