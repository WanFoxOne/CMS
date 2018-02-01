<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

require_once 'strrand.php';
require_once 'strtag.php';

function captcha($lang) {
	$charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	$code = strrand($charset, 4);

	$_SESSION['captcha'] = $code;
	
	$img = strtag($code);

	header('Content-Type: image/png');
	header("Content-Disposition: inline; filename=captcha.png");

	imagepng($img);
	imagedestroy($img);

	return false;
}

