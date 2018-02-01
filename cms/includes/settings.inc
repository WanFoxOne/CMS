<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

ini_set('arg_separator.output',		'&amp;');
ini_set('magic_quotes_runtime',		0);
ini_set('magic_quotes_sybase',		0);
ini_set('register_globals',			0);
ini_set('session.cache_expire',		180);
ini_set('session.cache_limiter',	'none');
ini_set('session.cookie_lifetime',	0);
ini_set('session.gc_maxlifetime',	1440);
ini_set('session.name',				'');
ini_set('session.save_handler',		'files');
ini_set('session.use_cookies',		1);
ini_set('session.use_only_cookies',	1);
ini_set('session.use_trans_sid',	0);
ini_set('url_rewriter.tags',		'');

ini_set('error_reporting',			E_ALL | E_STRICT);
ini_set('display_errors',			1);
ini_set('log_errors',				0);
