<?php
$method = $_SERVER['REQUEST_METHOD'];
$form_errors = array();

if ($current_user == NULL && $method == 'POST')
{	
	try { $dbhandler = new PDOConfig(); $dbhandler->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); }
	catch(PDOException $e) { die('Unable to open database connection'); }

	$usersManager = new UsersManager($dbhandler);

	$user = array(
		'username' => $_POST['username'],
		'email' => $_POST['email'],
		'enabled' => 0,
		'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
		'locked' => 0,
		'roles' => 'users'
	);
	$user = new User($user);

	if ($user->validUser() == False)
		$form_errors[] = 'Le nom d\'utilisateur ou l\'adresse email ne respecte pas le format attendu.';
	else
	{
		if ($usersManager->username_canonical_exists($user->getUsername_canonical()) == True)
			$form_errors[] =  'Le nom d\'utilisateur est deja pris.';
		if ($usersManager->email_exists($user->getEmail_canonical()) == True)
			$form_errors[] =  'L\'adresse email est deja utilisé.';
	}

	$form_errors = array_filter($form_errors);

	if (empty($form_errors))
			$usersManager->add($user);
}
else if ($current_user != NULL)
	redirection(link_to_route("home"), 0);
?>