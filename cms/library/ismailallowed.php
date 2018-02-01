<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function is_mail_allowed($mail) {
	static $blacklist = array('frasq@frasq.org', 'webmaster@frasq.org', 'keymaster@frasq.org');

	return !in_array($mail, $blacklist);
}
