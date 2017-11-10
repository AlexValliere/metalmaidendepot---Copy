<?php
if (!($method == 'POST' && empty($form_errors)))
{
	?>
<?php
foreach ($form_errors as $key => $value)
{
	echo '<p>' . $value . '</p>';
}
?>
<div class="row">
	<div class="col-lg-offset-4 col-lg-4">
		<form method="post" action="<?php echo link_to_route("register"); ?>" enctype="multipart/form-data" id="register" class="form-horizontal">
			<div class="form-group">
				<label for="username" class="col-lg-4 control-label">Username :</label>
				<div class="col-lg-8">
					<input name="username" type="text" id="username" class="form-control" required />
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-lg-4 control-label">Email :</label>
				<div class="col-lg-8">
					<input type="text" name="email" id="email" class="form-control" required />
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-lg-4 control-label">Password :</label>
				<div class="col-lg-8">
					<input type="password" name="password" id="password" class="form-control" required />
				</div>
			</div>
			<div class="form-group">
				<label for="password_confirm" class="col-lg-4 control-label">Confirm password :</label>
				<div class="col-lg-8">
					<input type="password" name="password_confirm" id="confirm" class="form-control" required />
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-offset-4 col-lg-8">
					<input type="submit" value="Create account" />
				</div>
			</div>
		</form>
	</div>
</div>
	<?php
}
else
{
	?>
<p>Inscription OK</p>
	<?php
}
?>
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