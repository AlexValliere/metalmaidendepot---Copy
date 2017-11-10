<?php
function filter_validate_username($username) {
	if (preg_match('/^[A-Za-z0-9âàèêéìïôòûù]+(?:[ _-][A-Za-z0-9âàèêéìïôòûù]+)*$/', $username) != 0)
	{
		if (strlen($username) >= 3 AND strlen($username) <= 25)
			return true;
	}
	return false;
}