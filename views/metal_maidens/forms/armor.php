<fieldset>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
			<legend>Current armors</legend>
		</div>

		<div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
			<?php
			$armors_list = $armorsManager->get_by_category($pw_tank_armor_by_categories[$tank->getCategory()]);

			foreach ($armors_list as $armor)
			{
				if (in_array($armor->getId(), $tank->getArmor_ids()))
				{
					?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
						<div class="table-responsive">
							<table class="table table-bordered" style="text-align: center;">
							<tr>
								<td style="width: 30px;">
									<img
										src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $armor->getTier() . ".png"; ?>"
										alt="Tech rank"
										style="max-height: 35px;"
									/>
								</td>
								<td style="width: 100px;">
									<img
										src="<?php echo strtolower(ARMORS_DIR . $armor->getCategory()) . '/tech_'.$armor->getTier() . '/' . $armor->getName() . '.png'; ?>"
										alt="<?php echo $armor->getName().' icon'; ?>"
										style="max-height: 35px;"
									/>
								</td>
								<td>
									<?php
									$properties_array = ["cast", "composite", "hardened", "riveted", "spaced", "tempered", "wedge", "welded"];

									foreach ($properties_array as $property_value)
									{
										if ($armor->{"get".ucfirst($property_value)}())
											echo '<img src="' . ARMORS_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . ucfirst($property_value) . '" /> ';
									}
									?>
									<?php echo $armor->getName(); ?>
									<br />
									<?php
									if ($armor->getArmor() != NULL && $armor->getArmor() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'armor.png" alt="Armor icon" style="height: 1.5em;" /> ' . $armor->getArmor() . ' ';
									if ($armor->getDurability() != NULL && $armor->getDurability() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'durability.png" alt="Durability icon" style="height: 1.5em;" /> ' . $armor->getDurability() . ' ';
									if ($armor->getEvasion() != NULL && $armor->getEvasion() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'evasion.png" alt="Evasion icon" style="height: 1.5em;" /> ' . $armor->getEvasion() . ' ';
									if ($armor->getStealth() != NULL && $armor->getStealth() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'stealth.png" alt="Stealth icon" style="height: 1.5em;" /> ' . $armor->getStealth() . ' ';
									if ($armor->getTargeting() != NULL && $armor->getTargeting() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'targeting.png" alt="Targeting icon" style="height: 1.5em;" /> ' . $armor->getTargeting() . ' ';
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
			<legend>Update armors</legend>
		</div>

		<div class="col-sm-12 col-sm-offset-0 col-lg-8 col-lg-offset-2 col-md-offset-1 col-xs-offset-2">
			<form class="form-inline" action="<?php echo link_to_route("edit_metal_maiden_armors"); ?>&amp;tank=<?php echo $tank->getTank_slug(); ?>" method="post" enctype="multipart/form-data">
				<?php
				$armor_list = $armorsManager->get_by_category($pw_tank_armor_by_categories[$tank->getCategory()]);
				
				echo '<div class="row">';
				echo ucfirst($pw_tank_armor_by_categories[$tank->getCategory()]) . " armors :";
				echo '<br /><br />';

				foreach ($armor_list as $armor)
				{
					if ($armor->getTier() != NULL)
					{
						?>
						<div class="col-xs-12 col-md-6">
							<label style="font-weight: normal;">
								<input type="checkbox" name="armor_ids[]" value="<?php echo $armor->getId(); ?>" <?php if (in_array($armor->getId(), $tank->getArmor_ids())) echo 'checked="checked"'; ?>>
								<img
									src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $armor->getTier() . ".png"; ?>"
									alt="Tech rank"
									style="max-height: 35px;"
								/>
								<img src="<?php echo strtolower(ARMORS_DIR.$armor->getCategory()).'/tech_'.$armor->getTier().'/'.$armor->getName().'.png'; ?>" alt="<?php echo $armor->getName(); ?>'s icon" style="max-height: 35px;" />
								<?php echo str_replace("Heavy ", "", $armor->getName()); ?> :
								<?php
								foreach (array_keys($pw_armor_description) as $property_value)
								{
									if ($armor->{"get".ucfirst($property_value)}())
										echo '<img src="' . ARMORS_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . ucfirst($property_value) . '" /> ';
								}
								echo ' ' . $armor->getArmor();
								?>
							</label>
						</div>
						<?php
					}
				}

				echo '</div>';
				echo '<br /><br />';
				?>
				<input type="hidden" name="edit_tank" value="<?php echo $tank->getTank_slug(); ?>" />
				<input type="hidden" name="update_armor" value="1" />
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<button type="submit" class="btn btn-primary">Update Metal Maiden armors</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</fieldset>