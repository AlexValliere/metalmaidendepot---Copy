<span class="anchor" id="tank_shells"></span>
<div class="row">
	<div class="col-lg-12 requirements_block">
		<h4 class="page-header">Armors</small></h4>
		<button type="button" id="setArmor_legend_visibility" onClick="setArmor_legend_visibility();">Legend of armor icons [ Click to expand ]</button>
		<div id="armor_legend" style="display: none;">
		<?php
		foreach (array_keys($pw_armor_description) as $property_value)
		{
			echo '<img src="' . ARMORS_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . strip_tags($pw_armor_description[$property_value]) . '" /> ' . $pw_armor_description[$property_value] . '<br />';
		}
		?>
		<br />
		</div>

		<div style="text-align: center;">
		<?php
		$armors_list = $armorsManager->get_by_category($pw_tank_armor_by_categories[$view_tank->getCategory()]);

		if (!empty($view_tank->getArmor_ids()))
		{
			foreach ($armors_list as $armor)
			{
				if (in_array($armor->getId(), $view_tank->getArmor_ids()))
				{
					?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
						<div class="">
							<table class="table table-bordered">
							<tr>
								<td style="width: 30px; vertical-align: middle;">
									<div class="armor_icon">
										<img
											src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $armor->getTier() . ".png"; ?>"
											alt="Tech rank"
											class="tech"
										/>
									</div>
								</td>
								<td style="max-width: 75px; width: 75px; vertical-align: middle;">
									<div class="armor_icon">
										<img
											src="<?php echo strtolower(ARMORS_DIR . $armor->getCategory()) . '/tech_'.$armor->getTier() . '/' . $armor->getName() . '.png'; ?>"
											alt="<?php echo $armor->getName().' icon'; ?>"
											class="img-responsive"
										/>
									</div>
								</td>
								<td>
									<?php
									foreach (array_keys($pw_armor_description) as $property_value)
									{
										if ($armor->{"get".ucfirst($property_value)}())
											echo '<img src="' . ARMORS_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px; title="' . strip_tags($pw_armor_description[$property_value]) . '" /> ';
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
				$last_armor_tier = $armor->getTier();
			}
		}
		?>
		</div>
	</div>
</div>

<script type="text/javascript">
var armor_legend_is_visible = false;
function setArmor_legend_visibility() {
	if (armor_legend_is_visible) {
		$button = $('button[id=setArmor_legend_visibility]');
		$button.text("Legend of armor icons [ Click to expand ]");
		document.getElementById('armor_legend').style.display = 'none';
	} else {
		$button = $('button[id=setArmor_legend_visibility]');
		$button.text("Legend of armor icons [ Click to hide ]");
		document.getElementById('armor_legend').style.display = 'block';
	}
	armor_legend_is_visible = !armor_legend_is_visible;
}
</script>