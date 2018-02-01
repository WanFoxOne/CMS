<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function user_is_identified() {
	return isset($_SESSION['user']);
}

