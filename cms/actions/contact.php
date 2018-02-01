<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    2
 * @link       http://www.frasq.org
 */

function contact($lang) {
	head('title', translate('contact:title', $lang));
	head('description', false);
	head('keywords', false);
	head('robots', 'noindex, nofollow');

	$banner = build('banner', $lang);

	$mailme = build('mailme', $lang);

	$content = view('contact', $lang, compact('mailme'));

	$output = layout('standard', compact('banner', 'content'));

	return $output;
}
