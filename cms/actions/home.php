<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function home($lang) {
	$languages='home';
	$contact=$account=true;
	$validate=url('home', $lang);

	$banner = build('banner', $lang, compact('languages', 'contact', 'account', 'validate'));

	$contact_page=url('contact', $lang);
	$footer = view('footer', $lang, compact('contact_page'));

	$username = isset($_SESSION['user']) ? $_SESSION['user']['name'] : false;

	$content = view('home', $lang, compact('username'));

	head('title', translate('home:title', $lang));

	$output = layout('standard', compact('banner', 'footer', 'content'));

	return $output;
}
