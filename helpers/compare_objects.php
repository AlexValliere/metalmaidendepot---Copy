<?php
function bool2str($bool)
{
	if ($bool === false)
		return 'FALSE';
	else
		return 'TRUE';
}

function compare_objects(&$o1, &$o2)
{
	echo 'o1 == o2 : '.bool2str($o1 == $o2) . "<br />";
	echo 'o1 != o2 : '.bool2str($o1 != $o2) . "<br />";
	echo 'o1 === o2 : '.bool2str($o1 === $o2) . "<br />";
	echo 'o1 !== o2 : '.bool2str($o1 !== $o2) . "<br />";
}
?>