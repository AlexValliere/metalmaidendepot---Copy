<fieldset>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
			<legend>Current chassis</legend>
		</div>

		<div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
			<?php
			$chassis_list = $chassisManager->get_all();

			foreach ($chassis_list as $chassis)
			{
				if (in_array($chassis->getId(), $tank->getChassis_ids()))
				{
					?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
						<div class="table-responsive">
							<table class="table table-bordered" style="text-align: center;">
							<tr>
								<td style="width: 30px;">
									<img
										src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $chassis->getTier() . ".png"; ?>"
										alt="Tech rank"
										style="max-height: 35px;"
									/>
								</td>
								<td style="width: 100px;">
									<img
										src="<?php echo CHASSIS_DIR . '/tech_'.$chassis->getTier() . '/' . $chassis->getName() . '.png'; ?>"
										alt="<?php echo $chassis->getName().' icon'; ?>"
										style="max-height: 35px;"
									/>
								</td>
								<td>
									<?php
									foreach (array_keys($pw_chassis_description) as $property_value)
									{
										if ($chassis->{"get".ucfirst($property_value)}())
											echo '<img src="' . CHASSIS_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . strip_tags($pw_chassis_description[$property_value]) . '" /> ';
									}
									?>
									<?php echo $chassis->getName(); ?>
									<br />
									<?php
									if ($chassis->getArmor() != NULL && $chassis->getArmor() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'armor.png" alt="Armor icon" style="height: 1.5em;" /> ' . $chassis->getArmor() . ' ';
									if ($chassis->getDetection() != NULL && $chassis->getDetection() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'detection.png" alt="Detection icon" style="height: 1.5em;" /> ' . $chassis->getDetection() . ' ';
									if ($chassis->getDurability() != NULL && $chassis->getDurability() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'durability.png" alt="Durability icon" style="height: 1.5em;" /> ' . $chassis->getDurability() . ' ';
									if ($chassis->getEvasion() != NULL && $chassis->getEvasion() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'evasion.png" alt="Evasion icon" style="height: 1.5em;" /> ' . $chassis->getEvasion() . ' ';
									if ($chassis->getFirepower() != NULL && $chassis->getFirepower() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'firepower.png" alt="Firepower icon" style="height: 1.5em;" /> ' . $chassis->getFirepower() . ' ';
									if ($chassis->getPenetration() != NULL && $chassis->getPenetration() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'penetration.png" alt="Penetration icon" style="height: 1.5em;" /> ' . $chassis->getPenetration() . ' ';
									if ($chassis->getStealth() != NULL && $chassis->getStealth() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'stealth.png" alt="Stealth icon" style="height: 1.5em;" /> ' . $chassis->getStealth() . ' ';
									if ($chassis->getTargeting() != NULL && $chassis->getTargeting() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'targeting.png" alt="Targeting icon" style="height: 1.5em;" /> ' . $chassis->getTargeting() . ' ';
									?>
								</td>
							</tr>
							</table>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
			<legend>Update chassis</legend>
		</div>

		<div class="col-sm-12 col-sm-offset-0 col-lg-8 col-lg-offset-2 col-md-offset-1 col-xs-offset-2">
			<form class="form-inline" action="<?php echo link_to_route("edit_metal_maiden_chassis"); ?>&amp;tank=<?php echo $tank->getTank_slug(); ?>" method="post" enctype="multipart/form-data">
				<?php
				$chassis_list = $chassisManager->get_all();
				
				echo '<div class="row">';

				foreach ($chassis_list as $chassis)
				{
					if ($chassis->getTier() != NULL)
					{
						?>
						<div class="col-xs-12 col-md-5 col-md-offset-1" style="min-height: 100px;">
							<label style="font-weight: normal;">
								<table class="chassis_form">
								<tr>
									<th colspan="3">
										<img
											src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $chassis->getTier() . ".png"; ?>"
											alt="Tech rank"
											style="max-height: 35px;"
										/>
										<?php echo $chassis->getName(); ?>
									</th>
								</tr>
								<tr>
									<td>
										<input type="checkbox" name="chassis_ids[]" value="<?php echo $chassis->getId(); ?>" <?php if (in_array($chassis->getId(), $chassis_ids)) echo 'checked="checked"'; ?>>
									</td>

									<td>
										<img src="<?php echo CHASSIS_DIR.'/tech_'.$chassis->getTier().'/'.$chassis->getName().'.png'; ?>" alt="<?php echo $chassis->getName(); ?>'s icon" style="max-height: 50px;" />
									</td>
									<td>
										<?php
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'durability.png" alt="Durability icon" style="height: 1.8em;" /> ';
										echo $chassis->getDurability() . '<br />';
										foreach (array_keys($pw_chassis_description) as $property_value)
										{
											if ($chassis->{"get".ucfirst($property_value)}())
												echo '<img src="' . CHASSIS_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . strip_tags($pw_chassis_description[$property_value]) . '" /> ';
										}
										
										?>
									</td>
								</tr>
								</table>
							</label>
						</div>
						<?php
					}
				}

				echo '</div>';
				echo '<br /><br />';
				?>
				<input type="hidden" name="edit_tank" value="<?php echo $tank->getTank_slug(); ?>" />
				<input type="hidden" name="update_chassis" value="1" />
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<button type="submit" class="btn btn-primary">Update Metal Maiden chassis</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</fieldset>