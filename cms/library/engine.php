<?php

/**
 *
 * @copyright	2010 frasq.org
 * @version		1
 * @link		http://www.frasq.org
 */

global $aliases;

$aliases = array();

@include 'aliases.inc';

require_once 'requesturi.php';
require_once 'translate.php';
require_once 'head.php';
require_once 'track.php';

define('ACTIONS_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'actions');
define('BLOCKS_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'blocks');
define('VIEWS_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'views');
define('LAYOUTS_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'layouts');

function url($action, $lang=false, $args=false) {
	global $base_path;

	return $base_path.'/'.alias($action, $lang, $args);
}

function alias($action, $lang=false, $args=false) {
	$path = detour($action, $lang);

	if ($args) {
		if ($path) {
			$path .= '/';
		}
		$path .= implode('/', $args);
	}

	return $lang ? $lang.'/'.$path : $path;
}

function detour($action, $lang=false) {
	global $aliases;

	if ($lang && array_key_exists($lang, $aliases)) {
		if (($path = array_search($action, $aliases[$lang]))) {
			return $path;
		}
	}
	if (array_key_exists(0, $aliases)) {
		if (($path = array_search($action, $aliases[0]))) {
			return $path;
		}
	}

	return false;
}

function route($query, $lang=false) {
	global $aliases;

	$args = array();

	if (empty($query)) {
		return array('home', false);
	}

	$s = explode('/', $query);

	while (count($s) > 0) {
		$p = implode('/', $s);
		if ($lang && array_key_exists($lang, $aliases) && array_key_exists($p, $aliases[$lang])) {
			return array($aliases[$lang][$p], $args);
		}
		if (array_key_exists(0, $aliases) && array_key_exists($p, $aliases[0])) {
			return array($aliases[0][$p], $args);
		}
		array_unshift($args, array_pop($s));
	}

	return false;
}

function dispatch($languages) {
	global $base_path;
	global $closing_time, $opening_time;
	global $track_visitor, $track_visitor_agent;

	$req = $base_path ? substr(request_uri(), strlen($base_path)) : request_uri();

	if ($track_visitor) {
		track($req, $track_visitor_agent);
	}

	$url = parse_url($req);
	$path = isset($url['path']) ? trim(urldecode($url['path']), '/') : false;
	$query = isset($url['query']) ? $url['query'] : false;

	if (empty($path)) {
		$path = false;
	}

	/* site language */
	$p = $path ? explode('/', $path) : false;
	$lang = $p ? $p[0] : false;

	if ($lang && in_array($lang, $languages, true)) {
		array_shift($p);
		$path = implode('/', $p);
	}
	else {
		require_once 'locale.php';

		$lang=locale();

		if (!$lang or !in_array($lang, $languages, true)) {
			$lang = $languages[0];
		}
	}

	$action=$args=$params=false;
	if ($closing_time and $closing_time <= time()) {
		$action='error/serviceunavailable';
		$args=array($closing_time, $opening_time);
	}
	else {
		$r = route($path, $lang);
		if (!$r) {
			$action='error/notfound';
		}
		else {
			list($action, $args) = $r;

			if ($query) {
				$params = array();
				foreach (explode('&', $query) as $q) {
					$p = explode('=', $q);
					if (count($p) == 2) {
						list($key, $value) = $p;
						if ($key) {
							$params[$key]=urldecode($value);
						}
					}
				}
			}
		}
	}

	$arglist = $args ? $params ? array_merge($args, $params) : $args : $params;

	run($action, $lang, $arglist);
}

function run($action, $lang=false, $arglist=false) {
	head('lang', $lang);
	head('title', translate('title', $lang));
	head('description', translate('description', $lang));
	head('keywords', translate('keywords', $lang));
	head('favicon', 'favicon');
	head('javascript', 'tools');

	$file = ACTIONS_DIR.DIRECTORY_SEPARATOR.$action.'.php';
	if (!is_file($file)) {
		$action = 'error/internalerror';
		$file = ACTIONS_DIR.DIRECTORY_SEPARATOR.$action.'.php';
		$arglist = false;
	}
	require_once $file;

	$func = basename($action);

	$farg = array();
	if ($lang) {
		$farg[] = $lang;
	}
	if ($arglist) {
		$farg[] = $arglist;
	}

	$output = call_user_func_array($func, $farg);

	if ($output) {
		echo $output;
	}

	exit;
}

function build($block) {
	$file = BLOCKS_DIR.DIRECTORY_SEPARATOR.$block.'.php';
	require_once $file;
	$func = basename($block);
	$args=func_get_args();
	array_shift($args);
	return call_user_func_array($func, $args);
}

function view($view, $lang=false, $vars=false) {
	$file = $lang ? VIEWS_DIR.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.$view.'.phtml' : VIEWS_DIR.DIRECTORY_SEPARATOR.$view.'.phtml';
	return render($file, $vars);
}

function layout($layout, $vars=false) {
	$head=view('head', false, head());
	if ($vars) {
		$vars['head'] = $head;
	}
	else {
		$vars = array('head' => $head);
	}
	$file = LAYOUTS_DIR.DIRECTORY_SEPARATOR.$layout.'.phtml';
	return render($file, $vars);
}

function render($file, $vars=false) {
	global $base_path, $base_url, $base_root;
	if ($vars) {
		extract($vars);
	}
	ob_start();
	require $file;
	return ob_get_clean();
}
