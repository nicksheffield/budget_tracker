<?php

/**
*
*	@todo Proper documentation
*
*/

$config['default_controller']  = 'site';
$config['base_url']            = '';

$config['autoload']['libs']    = array('form', 'sticky', 'error');
$config['autoload']['models']  = array('category_model', 'category_collection', 'item_model', 'item_collection');

$config['db']['hostname']      = 'localhost';
$config['db']['username']      = '';
$config['db']['password']      = '';
$config['db']['database']      = '';