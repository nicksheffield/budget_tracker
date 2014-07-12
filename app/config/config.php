<?php

/**
*
*	@todo Proper documentation
*
*/

$config['default_controller']  = 'site';
$config['base_url']            = '';

$config['autoload']['libs']    = array('json');
$config['autoload']['models']  = array('item_model', 'item_collection', 'category_collection');

$config['db']['hostname']      = 'localhost';
$config['db']['username']      = '';
$config['db']['password']      = '';
$config['db']['database']      = '';

require(APP_URL.'/config/db_creds.php'); #gitignore
$config['db']['username']      = DB_USERNAME; #gitignore
$config['db']['password']      = DB_PASSWORD; #gitignore
$config['db']['database']      = DB_DATABASE; #gitignore