<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

require_once 'models/node.inc';

function node($lang, $arglist=false) {
	$node=false;

	if (is_array($arglist)) {
		if (isset($arglist[0])) {
			$node=$arglist[0];
		}
	}

	if (!$node) {
		return run('error/notfound', $lang);
	}

	$node_id = node_id($node);
	if (!$node_id) {
		return run('error/notfound', $lang);
	}

	$r = node_get($lang, $node_id);
	if (!$r) {
		return run('error/notfound', $lang);
	}
	extract($r); /* node_name node_title node_abstract node_cloud */

	head('title', $node_id);
	head('description', $node_abstract);
	head('keywords', $node_cloud);
	head('robots', 'noindex, nofollow');

	$banner = build('banner', $lang);

	$node_contents = build('nodecontent', $lang, $node_id);

	$content = view('node', $lang, compact('node_name', 'node_title', 'node_abstract', 'node_cloud', 'node_contents'));

	$output = layout('standard', compact('banner', 'content'));

	return $output;
}

