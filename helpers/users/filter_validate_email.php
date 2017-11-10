<?php
function filter_validate_email($email) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		return false;
	else
		return true;
}
?>