<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function token_id() {
	return md5(uniqid(rand(), TRUE));
}
