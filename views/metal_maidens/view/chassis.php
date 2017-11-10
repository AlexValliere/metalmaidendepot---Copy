<span class="anchor" id="tank_shells"></span>
<div class="row">
	<div class="col-lg-12 requirements_block">
		<h4 class="page-header">Chassis</small></h4>
		<button type="button" id="setChassis_legend_visibility" onClick="setChassis_legend_visibility();">Legend of chassis icons [ Click to expand ]</button>
		<div id="chassis_legend" style="display: none;">
		<?php
		foreach (array_keys($pw_chassis_description) as $property_value)
		{
			echo '<img src="' . CHASSIS_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . strip_tags($pw_chassis_description[$property_value]) . '" /> ' . $pw_chassis_description[$property_value] . '<br />';
		}
		?>
		<br />
		</div>

		<div style="text-align: center;">
		<?php
		$chassis_list = $chassisManager->get_all();

		if (!empty($view_tank->getChassis_ids()))
		{
			foreach ($chassis_list as $chassis)
			{
				if (in_array($chassis->getId(), $view_tank->getChassis_ids()))
				{
					?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
						<div class="table-responsive">
							<table class="table table-bordered">
							<tr>
								<td style="width: 30px;">
									<div class="armor_icon">
										<img
											src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $chassis->getTier() . ".png"; ?>"
											alt="Tech rank"
											class="tech"
										/>
									</div>
								</td>
								<td style="width: 100px;">
									<div class="armor_icon">
										<img
											src="<?php echo CHASSIS_DIR . '/tech_'.$chassis->getTier() . '/' . $chassis->getName() . '.png'; ?>"
											alt="<?php echo $chassis->getName().' icon'; ?>"
										/>
									</div>
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
				$last_chassis_tier = $chassis->getTier();
			}
		}
		?>
		</div>
	</div>
</div>

<script type="text/javascript">
var chassis_legend_is_visible = false;
function setChassis_legend_visibility() {
	if (chassis_legend_is_visible) {
		$button = $('button[id=setChassis_legend_visibility]');
		$button.text("Legend of chassis icons [ Click to expand ]");
		document.getElementById('chassis_legend').style.display = 'none';
	} else {
		$button = $('button[id=setChassis_legend_visibility]');
		$button.text("Legend of chassis icons [ Click to hide ]");
		document.getElementById('chassis_legend').style.display = 'block';
	}
	chassis_legend_is_visible = !chassis_legend_is_visible;
}
</script>