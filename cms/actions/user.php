<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function user($lang) {
	$login = build('login', $lang);
	if (true === $login) {
		$next_page = url('home', $lang);

		header("Location: $next_page");
		return false;
	}

	$banner = build('banner', $lang);
	$content = view('user', $lang, compact('login'));

	head('title', translate('user:title', $lang));
	head('description', false);
	head('keywords', false);
	head('robots', 'noindex, nofollow');

	$output = layout('standard', compact('banner', 'content'));

	return $output;
}
