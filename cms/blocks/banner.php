<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

require_once 'userisidentified.php';
require_once 'userhasrole.php';

function banner($lang, $components=false) {
	$home_page=url('home', $lang);
	$logo = view('logo', $lang, compact('home_page'));

	$menu=$contact=$login=$logout=$validate=false;
	$languages=false;
	$contact_page=$nobody_page=$validate_page=false;

	$is_identified = user_is_identified();
	$is_writer = user_has_role('writer');

	if ($is_identified) {
		$nobody_page=url('nobody', $lang);
		$logout = true;
	}

	if ($components) {
		foreach ($components as $v => $param) {
			switch ($v) {
				case 'account':
					if ($param) {
						if (!$is_identified) {
							$user_page=url('user', $lang);
							$login = true;
						}
					}
					break;
				case 'languages':
					if ($param) {
						$languages = build('languages', $lang, $param);
					}
					break;
				case 'contact':
					if ($param) {
						$contact_page=url('contact', $lang);
						$contact = true;
					}
					break;
				case 'validate':
					if ($param) {
						if ($is_writer) {
							$validate_page=$param;
							$validate=true;
						}
					}
					break;
				default:
					break;
			}
		}
	}

	if ($logout or $contact) {
		$menu = view('bannermenu', $lang, compact('contact', 'contact_page', 'validate', 'validate_page', 'logout', 'nobody_page', 'login', 'user_page'));
	}

	$output = view('banner', false, compact('logo', 'menu', 'languages'));

	return $output;
}
