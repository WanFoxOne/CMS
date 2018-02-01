<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function session_reopen() {
	session_close();
	session_open();
}

function session_open() {
	session_start();
}

function session_close() {
	session_destroy();
	$_SESSION=array();
}
