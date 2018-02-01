<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    2
 * @link       http://www.frasq.org
 */

function password($lang) {
	head('title', translate('password:title', $lang));
	head('description', false);
	head('keywords', false);
	head('robots', 'noindex, nofollow');

	$banner = build('banner', $lang);

	$remindme = build('remindme', $lang);

	$content = view('password', $lang, compact('remindme'));

	$output = layout('standard', compact('banner', 'content'));

	return $output;
}

