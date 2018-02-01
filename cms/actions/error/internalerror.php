<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function internalerror($lang) {
	head('title', translate('http_internal_error:title', $lang));
	head('robots', 'noindex, nofollow');

	$contact=true;
	$banner = build('banner', $lang, compact('contact'));

	$contact_page=url('contact', $lang);
	$content = view('error/internalerror', $lang, compact('contact_page'));

	$output = layout('standard', compact('header', 'banner', 'content'));

	header('HTTP/1.1 500 Internal Error');

	return $output;
}
