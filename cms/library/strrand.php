<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function strrand($charset, $len) {
	$max=strlen($charset)-1;
	$s = '';

	srand();

	for ($i=0; $i < $len; $i++) {
		$s .= $charset[rand(0, $max)];
	}

	return $s;
}

