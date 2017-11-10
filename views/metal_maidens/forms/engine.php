<fieldset>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
			<legend>Current engines</legend>
		</div>

		<div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
			<?php
			$engines_list = $enginesManager->get_all();

			foreach ($engines_list as $engine)
			{
				if (in_array($engine->getId(), $tank->getEngine_ids()))
				{
					?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
						<div class="table-responsive">
							<table class="table table-bordered" style="text-align: center;">
							<tr>
								<td style="width: 30px;">
									<img
										src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $engine->getTier() . ".png"; ?>"
										alt="Tech rank"
										style="max-height: 35px;"
									/>
								</td>
								<td style="width: 100px;">
									<img
										src="<?php echo strtolower(ENGINES_DIR) . '/tech_'.$engine->getTier() . '/' . $engine->getName() . '.png'; ?>"
										alt="<?php echo $engine->getName().' icon'; ?>"
										style="max-height: 35px;"
									/>
								</td>
								<td>
									<?php
									foreach (array_keys($pw_engine_description) as $property_value)
									{
										if ($engine->{"get".ucfirst($property_value)}())
											echo '<img src="' . ENGINES_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . ucfirst($property_value) . '" /> ';
									}
									?>
									<?php echo $engine->getName(); ?>
									<br />
									<?php
									if ($engine->getDurability() != NULL && $engine->getDurability() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'durability.png" alt="Durability icon" style="height: 1.5em;" /> ' . $engine->getDurability() . ' ';
									if ($engine->getEvasion() != NULL && $engine->getEvasion() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'evasion.png" alt="Evasion icon" style="height: 1.5em;" /> ' . $engine->getEvasion() . ' ';
									if ($engine->getStealth() != NULL && $engine->getStealth() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'stealth.png" alt="Stealth icon" style="height: 1.5em;" /> ' . $engine->getStealth() . ' ';
									if ($engine->getTargeting() != NULL && $engine->getTargeting() != 0)
										echo '<img src="'.TANK_ATTRIBUTES_DIR.'targeting.png" alt="Targeting icon" style="height: 1.5em;" /> ' . $engine->getTargeting() . ' ';
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
			<legend>Update engines</legend>
		</div>

		<div class="col-sm-12 col-sm-offset-0 col-lg-8 col-lg-offset-2 col-md-offset-1 col-xs-offset-2">
			<form class="form-inline" action="<?php echo link_to_route("edit_metal_maiden_engines"); ?>&amp;tank=<?php echo $tank->getTank_slug(); ?>" method="post" enctype="multipart/form-data">
				<?php
				// $engine_list = $enginesManager->get_all();
				$engine_list = $tank->getEngines();
				
				echo '<div class="row">';
				echo '<br /><br />';

				foreach ($engine_list as $engine)
				{
					if ($engine->getTier() != NULL)
					{
						?>
						<div class="col-xs-12 col-md-6">
							<label style="font-weight: normal;">
								<input type="checkbox" name="engine_ids[]" value="<?php echo $engine->getId(); ?>" <?php if (in_array($engine->getId(), $tank->getEngine_ids())) echo 'checked="checked"'; ?>>
								<img
									src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $engine->getTier() . ".png"; ?>"
									alt="Tech rank"
									style="max-height: 35px;"
								/>
								<img src="<?php echo strtolower(ENGINES_DIR).'/tech_'.$engine->getTier().'/'.$engine->getName().'.png'; ?>" alt="<?php echo $engine->getName(); ?>'s icon" style="max-height: 35px;" />
								<?php echo $engine->getName(); ?> :
								<?php
								foreach (array_keys($pw_engine_description) as $property_value)
								{
									if ($engine->{"get".ucfirst($property_value)}())
										echo '<img src="' . ENGINES_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . ucfirst($property_value) . '" /> ';
								}
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
				<input type="hidden" name="update_engine" value="1" />
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<button type="submit" class="btn btn-primary">Update Metal Maiden engines</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</fieldset>