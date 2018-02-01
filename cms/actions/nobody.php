<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function nobody($lang) {
	unset($_SESSION['user']);

	$next_page=url('home', $lang);
	header("Location: $next_page");

	return false;
}
