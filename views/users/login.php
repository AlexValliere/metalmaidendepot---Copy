<form method="post" action="<?php echo link_to_route("login"); ?>" enctype="multipart/form-data" id="login">
	<h1 class="large">Login</h1>
	<fieldset>
		<input name="username" type="text" id="username" placeholder="username" required /><br />
		<input type="password" name="password" id="password" placeholder="password" required /><br />
	</fieldset>
	<input type="submit" value="Connexion" />
	<br /><br />
	<p><a href="<?php echo link_to_route("forgotten_password"); ?>">Forgot your password ?</a> - <a href="<?php echo link_to_route("register"); ?>">Register an account</a></p>
</form>
<?php
if (VERBOSE)
{
	if ($method == 'POST')
	{
		echo var_dump($dbhandler);
		echo var_dump($_POST);
		echo var_dump($user);
		echo var_dump($form_errors);
	}
}
?>