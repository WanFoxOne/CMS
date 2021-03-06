<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    1
 * @link       http://www.frasq.org
 */

function head($type=false) {
	static $head = array();

	if (!$type) {
		return $head;
	}

	$args=func_get_args();
	array_shift($args);

	switch ($type) {
		case 'lang':
			$head['lang'] = $args[0];
			break;
		case 'title':
			$head['title'] = $args[0];
			break;
		case 'description':
			$head['description'] = $args[0];
			break;
		case 'favicon':
			$head['favicon'] = $args[0];
			break;
		case 'keywords':
			$head['keywords'] = $args[0];
			break;
		case 'author':
			$head['author'] = $args[0];
			break;
		case 'robots':
			$head['robots'] = $args[0];
			break;
		case 'stylesheet':
			$name=$args[0];
			$media=isset($args[1]) ? $args[1] : 'all';
			if (!isset($head['stylesheets'])) {
				$head['stylesheets'] = array(compact('name', 'media'));
			}
			else {
				foreach ($head['stylesheets'] as $css) {
					if ($css['name'] == $name) {
						break 2;
					}
				}
				$head['stylesheets'][]=compact('name', 'media');
			}
			break;
		case 'javascript':
			$name=$args[0];
			if (!isset($head['javascripts'])) {
				$head['javascripts'] = array(compact('name'));
			}
			else {
				foreach ($head['javascripts'] as $js) {
					if ($js['name'] == $name) {
						break 2;
					}
				}
				$head['javascripts'][]=compact('name');
			}
			break;
		default:
			return false;
	}

	return true;
}
