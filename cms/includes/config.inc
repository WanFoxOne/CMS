<?php

/**
 *
 * @copyright  2010-2014 frasq.org
 * @version    2
 * @link       http://www.frasq.org
 */

global $base_url, $base_path, $base_root;

global $sitename, $webmaster, $mailer;

$sitename = 'frasq.org';
$webmaster = 'nobody@frasq.org';
$mailer = 'Frasq';

global $signature;

$signature='frasq.org - https://www.frasq.org';

global $log_dir;

$log_dir = ROOT_DIR . DIRECTORY_SEPARATOR . 'log';

global $closing_time, $opening_time;

$closing_time=0;	// mktime(13, 0);
$opening_time=0;	// $closing_time+30*60;

global $supported_languages;

$supported_languages=array('fr', 'en');

global $track_db, $track_log;
global $track_visitor, $track_visitor_agent;

$track_db=false;
$track_log=true;
$track_visitor=false;
$track_visitor_agent=false;
