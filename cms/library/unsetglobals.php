<?php

/**
 *
 * @copyright	2010 frasq.org
 * @version		1
 * @link		http://www.frasq.org
 */

function unset_globals() {
	if (ini_get('register_globals')) {
		$allowed = array('_ENV', '_GET', '_POST', '_COOKIE', '_FILES', '_SERVER', '_REQUEST', 'GLOBALS');
		foreach ($GLOBALS as $key => $value) {
			if (!in_array($key, $allowed)) {
				unset($GLOBALS[$key]);
			}
		}
	}
}

