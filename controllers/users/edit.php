<?php
$method = $_SERVER['REQUEST_METHOD'];
$usersManager = new UsersManager($dbhandler);

if (isset($_GET['id']) && is_numeric($_GET['id']))
	$user = $usersManager->get($_GET['id']);

if ($method == 'POST' && isset($_POST["edit_user"]))
{
	$user = $usersManager->get($_POST['edit_user']);

	if ($user != False && $user != NULL)
	{
		$username = $_POST["username"];
		$email = $_POST["email"];
		$enabled = $_POST["enabled"];
		$locked = $_POST["locked"];
		$roles = array();
		foreach ($roles_array as $role)
		{
			if (isset($_POST[$role]))
				$roles[] = $role;
		}
		if (!empty($roles))
			$roles = implode(",", $roles);

		$user->setUsername($username);
		$user->setEmail($email);
		$user->setEnabled($enabled);
		$user->setLocked($locked);
		$user->setRoles($roles);

		$usersManager->update($user);

		redirection(link_to_route("users"), 1000);
	}
}
?>