<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function notfound($lang) {
	head('title', translate('http_not_found:title', $lang));
	head('robots', 'noindex, nofollow');

	$contact=true;
	$banner = build('banner', $lang, compact('contact'));

	$contact_page=url('contact', $lang);
	$content = view('error/notfound', $lang, compact('contact_page'));

	$output = layout('standard', compact('banner', 'content'));

	header('HTTP/1.1 404 Not Found');

	return $output;
}
