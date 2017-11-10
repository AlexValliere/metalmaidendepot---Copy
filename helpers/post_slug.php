<?php
require_once(HELPERS_DIR . 'remove_accents.php');

function post_slug($str) 
{
	return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), 
	array('', '_', ''), remove_accents($str))); 
}
?>