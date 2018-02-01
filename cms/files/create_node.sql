CREATE TABLE node (
node_id int( 10 ) unsigned NOT NULL AUTO_INCREMENT ,
user_id int( 10 ) unsigned NOT NULL ,
created datetime NOT NULL ,
modified datetime NOT NULL ,
PRIMARY KEY ( node_id )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;
