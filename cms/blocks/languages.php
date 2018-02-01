<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function languages($lang, $action) {
	$fr_page=url($action, 'fr');
	$en_page=url($action, 'en');

	$output = view('languages', $lang, compact('fr_page', 'en_page'));

	return $output;
}
