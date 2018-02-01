<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

require_once 'strrand.php';

function newpassword($len=6) {
	$charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

	return strrand($charset, $len);
}

