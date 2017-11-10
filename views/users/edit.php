<section class="edit_user">
<?php
if (isset($user) && $method != 'POST')
{
	?>
	<form class="form-horizontal" action="<?php echo link_to_route("edit_user"); ?>" method="post" enctype="multipart/form-data">

		<input type="hidden" name="edit_user" value="<?php echo $user->getId(); ?>" />
		<div class="form-group">
			<label for="username" class="col-sm-2 col-sm-offset-3 control-label">Username :</label>
			<div class="col-sm-3 col-lg-2">
				<input type="text" name="username" id="username" placeholder="Username" maxlength="30" class="form-control"
				<?php if (isset($user)) echo 'value="' . $user->getUsername() . '"'; ?>
				/>
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-sm-2 col-sm-offset-3 control-label">Email :</label>
			<div class="col-sm-3 col-lg-2">
				<input type="text" name="email" id="email" placeholder="test@test.test" maxlength="30" class="form-control"
				<?php if (isset($user)) echo 'value="' . $user->getEmail() . '"'; ?>
				/>
			</div>
		</div>
		<div class="form-group">
			<label for="enabled" class="col-sm-2 col-sm-offset-3 control-label">Is enabled ?</label>
			<div class="col-sm-3 col-lg-2">
				<label class="radio-inline" for="isEnabled"><input type="radio" name="enabled" value="1" id="isEnabled"
				<?php if (isset($user) && $user->getEnabled() == "1") echo 'checked="checked"'; ?>
				/> Yes</label><br />
				<label class="radio-inline" for="isNotEnabled"><input type="radio" name="enabled" value="0" id="isNotEnabled"
				<?php if (!isset($user) || (isset($user) && $user->getEnabled() == "0")) echo 'checked="checked"'; ?>
				/> No</label>
			</div>
		</div>
		<div class="form-group">
			<label for="locked" class="col-sm-2 col-sm-offset-3 control-label">Is locked ?</label>
			<div class="col-sm-3 col-lg-2">
				<label class="radio-inline" for="isLocked"><input type="radio" name="locked" value="1" id="isLocked"
				<?php if (isset($user) && $user->getLocked() == "1") echo 'checked="checked"'; ?>
				/> Yes</label><br />
				<label class="radio-inline" for="isNotLocked"><input type="radio" name="locked" value="0" id="isNotLocked"
				<?php if (!isset($user) || (isset($user) && $user->getLocked() == "0")) echo 'checked="checked"'; ?>
				/> No</label>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2 col-lg-6 col-lg-offset-3">
				<p>Roles :</p>
				<div class="row">
					<?php
					foreach ($roles_array as $role)
					{
						?>
						<div class="col-sm-3">
							<label class="checkbox-inline">
								<input
									type="checkbox"
									name="<?php echo $role; ?>"
									id="<?php echo $role; ?>"
									<?php
									if (isset($user) && $user->has_roles($role) == true)
										echo 'checked="checked"';
									?>
								/>
								<?php echo $role; ?>
							</label>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<button type="submit" class="btn btn-primary">Update user</button>
			</div>
		</div>
	</form>
	<?php
}
?>
</section>