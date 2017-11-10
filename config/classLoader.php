<?php
function loadClass($classname)
{
	require_once(MODELS_DIR . $classname . '.class.php');
}

spl_autoload_register('loadClass');
?>