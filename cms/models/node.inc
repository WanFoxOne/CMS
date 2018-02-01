<?php

/**
 *
 * @copyright  2010-2011 frasq.org
 * @version    2
 * @link       http://www.frasq.org
 */

function node_id($node) {
	if (!is_numeric($node)) {
		return false;
	}

	$tabnode=db_prefix_table('node');

	$sql="SELECT node_id FROM $tabnode WHERE node_id=$node LIMIT 1";

	$r = db_query($sql);

	return $r ? $r[0]['node_id'] : false;
}

function node_get($lang, $node_id) {
	$sqllang=db_sql_arg($lang, false);

	$tabnode=db_prefix_table('node');
	$tabnodelocale=db_prefix_table('node_locale');

	$sql="SELECT nloc.name AS node_name, nloc.title AS node_title, nloc.abstract AS node_abstract, nloc.cloud AS node_cloud, n.user_id AS node_user, UNIX_TIMESTAMP(n.created) AS node_created, UNIX_TIMESTAMP(n.modified) AS node_modified FROM $tabnode n JOIN $tabnodelocale nloc ON nloc.node_id=n.node_id AND nloc.locale=$sqllang WHERE n.node_id=$node_id LIMIT 1";

	$r = db_query($sql);

	return $r ? $r[0] : false;
}

function node_get_contents($lang, $node_id) {
	$sqllang=db_sql_arg($lang, false);

	$tabnodecontent=db_prefix_table('node_content');
	$tabcontenttext=db_prefix_table('content_text');

	$sql="SELECT nc.content_id AS content_id, nc.content_type AS content_type, nc.number AS content_number, ct.text AS content_text FROM $tabnodecontent nc JOIN $tabcontenttext ct ON nc.content_type='text' AND ct.content_id=nc.content_id AND ct.locale=$sqllang WHERE nc.node_id=$node_id ORDER BY nc.number";

	$r = db_query($sql);

	return $r;
}

