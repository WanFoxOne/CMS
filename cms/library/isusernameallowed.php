<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function is_user_name_allowed($name) {
	static $blacklist = array('frasq');

	return !in_array($name, $blacklist);
}
