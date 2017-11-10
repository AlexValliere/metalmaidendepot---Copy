<fieldset>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
			<legend>Current shells</legend>
		</div>

		<div class="col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
			<?php
			foreach($tank->getAmmo() as $shell_category => $availabe)
			{
				if ($availabe)
				{
					echo $pw_ammo_description[$shell_category];

					$shells_list = $shellsManager->get_by_category($shell_category);

					echo '<table class="table table-bordered">';
					echo '<tr>';
					echo '<th>Shell</th>';
					echo '<th>Attributes</th>';
					echo '<th>Range</th>';
					echo '<th>Properties & Modifiers</th>';
					echo '</tr>';

					foreach ($shells_list as $shell)
					{
						if (in_array($shell->getId(), $tank->getShell_ids()))
						{
							?>
							<tr>
								<td>
									<img src="<?php echo strtolower(SHELLS_DIR.$shell->getCategory()).'/tech_'.$shell->getTier().'/'.$shell->getName().'_icon.png'; ?>" alt="<?php echo $shell->getName(); ?>'s icon" style="max-height: 35px; display: inline-block;" />
									<?php echo $shell->getName(); ?>
									<br />
									Tier <?php echo $shell->getTier(); ?>
									<br />
									Level <?php echo $shell->getLevel(); ?>
								</td>
								<td>
									<table>
									<?php
									if ($shell->getFirepower() != NULL)
										echo '<tr><td><img src="'.TANK_ATTRIBUTES_DIR.'firepower.png" alt="Firepower icon" style="height: 2em;" /></td><td>' . $shell->getFirepower() . '</td></tr>';
									if ($shell->getPenetration() != NULL)
										echo '<tr><td><img src="'.TANK_ATTRIBUTES_DIR.'penetration.png" alt="Firepower icon" style="height: 2em;" /></td><td>' . $shell->getPenetration() . '</td></tr>';
									if ($shell->getTargeting() != NULL)
										echo '<tr><td><img src="'.TANK_ATTRIBUTES_DIR.'targeting.png" alt="Firepower icon" style="height: 2em;" /></td><td>' . $shell->getTargeting() . '</td></tr>';
									if ($shell->getEvasion() != NULL)
										echo '<tr><td><img src="'.TANK_ATTRIBUTES_DIR.'evasion.png" alt="Firepower icon" style="height: 2em;" /></td><td>' . $shell->getEvasion() . '</td></tr>';
									if ($shell->getStealth() != NULL)
										echo '<tr><td><img src="'.TANK_ATTRIBUTES_DIR.'stealth.png" alt="Firepower icon" style="height: 2em;" /></td><td>' . $shell->getStealth() . '</td></tr>';
									?>
									</table>
								</td>
								<td>
									<?php echo $shell_ids[$shell->getId()]["shell_range"]; ?>
								</td>
								<td>
									<?php
									foreach ($shell->getShell_properties_ids() as $shell_property_id)
									{
										$shell_property_id--;
										echo '<img src="'. SHELLS_DIR . 'properties/' . $shell_properties[$shell_property_id]["icon_file_name"] . '" alt="' . $shell_properties[$shell_property_id]["name"] . " : " . $shell_properties[$shell_property_id]["description"] . '" title="' . $shell_properties[$shell_property_id]["name"] . " : " . $shell_properties[$shell_property_id]["description"] . '" style="height: 2em;" /> ';
									}
									?>
									<?php
									foreach ($shell->getShell_modifiers_ids() as $shell_modifier_id)
									{
										$shell_modifier_id--;
										echo '<img src="'. SHELLS_DIR . 'modifiers/' . $shell_modifiers[$shell_modifier_id]["icon_file_name"] . '" alt="' . $shell_modifiers[$shell_modifier_id]["description"] . '" title="' . $shell_modifiers[$shell_modifier_id]["description"] . '" style="height: 2em;" /> ';
									}
									?>
								</td>
							</tr>
							<?php
						}
					}
					echo '</table>';
				}
			}
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
			<legend>Update shells</legend>
		</div>

		<div class="col-sm-12 col-sm-offset-0 col-lg-8 col-lg-offset-2">
			<form class="form-inline" action="<?php echo link_to_route("edit_metal_maiden_shells"); ?>&amp;tank=<?php echo $tank->getTank_slug(); ?>" method="post" enctype="multipart/form-data">
				<label for="ammo_game_version" class="col-xs-3 col-xs-offset-3 control-label">Ammo list from game version :</label>
				<div class="col-xs-6">
					<select name="ammo_game_version" id="ammo_game_version" multiple class="form-control">
						<?php
						foreach ($pw_game_versions as $pw_game_version) {
							echo '<option value="'.$pw_game_version.'" ';

							if (isset($tank) && ($tank->getAmmo_game_version() == $pw_game_version)
								|| (end($pw_game_versions) == $pw_game_version && empty($tank->getAmmo_game_version())))
								echo 'selected="selected"';

							echo '>'.$pw_game_version.'</option>';
						}
						?>
					</select>
				</div>
				<?php
				foreach($tank->getAmmo() as $shell_category => $availabe)
				{
					if ($availabe)
					{
						$shells_list = $shellsManager->get_by_category($shell_category);
						
						echo '<div class="row">';
						echo $pw_ammo_description[$shell_category];
						echo '<br /><br />';

						foreach ($shells_list as $shell)
						{
							if ($shell->getTier() != NULL)
							{
								?>
								<div class="col-xs-6">
									<label style="font-weight: normal;">
										<input type="checkbox" name="shell_ids[]" value="<?php echo $shell->getId(); ?>" <?php if (in_array($shell->getId(), $tank->getShell_ids())) echo 'checked="checked"'; ?>>
										<img src="<?php echo strtolower(SHELLS_DIR.$shell->getCategory()).'/tech_'.$shell->getTier().'/'.$shell->getName().'_icon.png'; ?>" alt="<?php echo $shell->getName(); ?>'s icon" style="max-height: 35px;" />
										Range :
										<input name="shell_<?php echo $shell->getId(); ?>_range" type="number" min="0" max="99999" step="1" value="<?php if (isset($shell_ids[$shell->getId()])) echo $shell_ids[$shell->getId()]["shell_range"]; else echo "0"; ?>" class="form-control" />
										<?php echo $shell->getName(); ?> :
										<img src="<?php echo TANK_ATTRIBUTES_DIR . "firepower.png"; ?>" alt="Firepower icon" style="height: 2em;" />
										<?php echo $shell->getFirepower(); ?>
										<img src="<?php echo TANK_ATTRIBUTES_DIR . "penetration.png"; ?>" alt="Penetration icon" style="height: 2em;" />
										<?php echo $shell->getPenetration(); ?>
									</label>
								</div>
								<?php
							}
						}

						echo '</div>';
						echo '<br /><br />';
					}
				}
				?>
				<input type="hidden" name="edit_tank" value="<?php echo $tank->getTank_slug(); ?>" />
				<input type="hidden" name="update_shell" value="1" />
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<button type="submit" class="btn btn-primary">Update Metal Maiden shells</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</fieldset>