<?php

/**
 *
 * @copyright	2010 frasq.org
 * @version		1
 * @link		http://www.frasq.org
 */

function user_agent() {
	if (isset($_SERVER['HTTP_USER_AGENT'])) {
		return $_SERVER['HTTP_USER_AGENT'];
	}

	return false;
}
