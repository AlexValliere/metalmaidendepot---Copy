<?php
$method = $_SERVER['REQUEST_METHOD'];

if ($current_user == NULL && $method == 'POST')
{
	$form_errors = array();
	$user = NULL;

	$usersManager = new UsersManager($dbhandler);

	if ($usersManager->username_exists($_POST['username']))
	{
		$user = $usersManager->get($usersManager->username_exists($_POST['username']));

		if (!password_verify($_POST['password'], $user->getPassword()))
			$form_errors[] = "Les identifiants de connexions ne correspondent pas.";
		if ($user->getEnabled() == 0)
			$form_errors[] = "Votre compte n'a pas été activé, cliquez sur le lien de confirmation d'email qui vous a été envoyé par courrier électronique.";
	}
	else
		$form_errors[] = "L'utilisateur " . htmlentities($_POST['username']) . " n'existe pas.";

	$form_errors = array_filter($form_errors);

	if (empty($form_errors))
	{
		$_SESSION['user'] = serialize($user);
		redirection(link_to_route("home"), 2000);
	}
	else
		$user = NULL;
}
?>