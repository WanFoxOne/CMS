CREATE TABLE node_content (
node_id int( 10 ) unsigned NOT NULL ,
content_id int( 10 ) unsigned NOT NULL ,
content_type enum( 'text' ) CHARACTER SET ascii NOT NULL DEFAULT 'text',
`number` int( 3 ) unsigned NOT NULL ,
PRIMARY KEY ( node_id , content_id , content_type )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

