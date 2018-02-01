<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function readarg($s, $trim=true) {
	if ($trim) {
		$s = trim($s);
	}
	return get_magic_quotes_gpc() ? stripslashes($s) : $s;
}
