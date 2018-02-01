<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

require_once 'models/node.inc';

function nodecontent($lang, $node_id) {
	$contents = array();
	$r = node_get_contents($lang, $node_id);

	if ($r) {
		foreach ($r as $c) {	/* content_id content_number content_type content_text */
			$type=$c['content_type'];
			switch($type) {
				case 'text':
					$s=$c['content_text'];
					if (!empty($s)) {
						$text =	$s;
						$contents[] = compact('type', 'text');
					}
					break;
				default:
					break;
			}
		}
	}

	$output = view('nodecontent', false, compact('contents'));

	return $output;
}
