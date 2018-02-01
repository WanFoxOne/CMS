<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function forbidden($lang) {
	head('title', translate('http_forbidden:title', $lang));
	head('robots', 'noindex, nofollow');

	$contact=true;
	$banner = build('banner', $lang, compact('contact'));

	$contact_page=url('contact', $lang);
	$content = view('error/forbidden', $lang, compact('contact_page'));

	$output = layout('standard', compact('header', 'banner', 'content'));

	header('HTTP/1.1 403 Forbidden');

	return $output;
}
