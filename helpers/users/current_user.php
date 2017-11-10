<?php
function current_user() {
	$current_user = NULL;

	if (isset($_SESSION['user']))
	{
		try { $dbhandler = new PDOConfig(); $dbhandler->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); }
		catch(PDOException $e) { die('Unable to open database connection'); }

		$usersManager = new UsersManager($dbhandler);
		$current_user = unserialize($_SESSION['user']);
		$test = $usersManager->get($usersManager->username_exists($current_user->getUsername()));

		if (!($current_user == $test && $current_user !== $test))
			$current_user = NULL;
	}

	return ($current_user);
}

function current_user_roles() {
	$current_user = current_user();
	if ($current_user == NULL)
		return [];
	else
		return $current_user->getRoles();
}

function current_user_has_roles( $roles ) {
	if (empty($roles))
		return true;

	if (in_array($roles, current_user_roles()))
		return (true);

	return false;
}
?>