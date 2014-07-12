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


# Because git makes it hard to ignore specific lines of a repo, and I can't use a .gitignore,
# I need to actually store my db credentials in a separate file that IS gitignored. 

# Feel free to delete this, and just enter your credentials as per usual in the $config['db'] array above.

require(APP_URL.'/config/db_creds.php');
$config['db']['username']      = DB_USERNAME;
$config['db']['password']      = DB_PASSWORD;
$config['db']['database']      = DB_DATABASE;