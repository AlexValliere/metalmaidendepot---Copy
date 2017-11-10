<span class="anchor" id="tank_shells"></span>
<div class="row">
	<div class="col-lg-12 requirements_block">
		<h4 class="page-header">Engines</small></h4>
		<button type="button" id="setEngine_legend_visibility" onClick="setEngine_legend_visibility();">Legend of engine icons [ Click to expand ]</button>
		<div id="engine_legend" style="display: none;">
		<?php
		foreach (array_keys($pw_engine_description) as $property_value)
		{
			echo '<img src="' . ENGINES_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . strip_tags($pw_engine_description[$property_value]) . '" /> ' . $pw_engine_description[$property_value] . '<br />';
		}
		?>
		<br />
		</div>

		<?php
		if (empty($engines_override))
		{
			?>
<!-- 			<div class="alert alert-warning" role="alert">
				<p>This section has been determined by an algorithm and may contains errors.</p>
			</div> -->
			<?php
		}
		?>
		
		<div style="text-align: center;">
		<?php
		if (!empty($engines_override) || (!empty($engines_available) && count($engines_available) <= 6))
		{
			if (!empty($engines_override))
			{
				$engines_available = $engines_override;
			}

			foreach ($engines_available as $engine)
			{
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div class="">
						<table class="table table-bordered">
						<tr>
							<td style="width: 30px; vertical-align: middle;">
								<div class="armor_icon">
									<img
										src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $engine->getTier() . ".png"; ?>"
										alt="Tech rank"
										class="tech"
									/>
								</div>
							</td>
							<td style="max-width: 75px; width: 75px; vertical-align: middle;">
								<div class="armor_icon">
									<img
										src="<?php echo strtolower(ENGINES_DIR) . 'tech_'.$engine->getTier() . '/' . $engine->getName() . '.png'; ?>"
										alt="<?php echo $engine->getName().' icon'; ?>"
										class="img-responsive"
									/>
								</div>
							</td>
							<td>
								<?php
								foreach (array_keys($pw_engine_description) as $property_value)
								{
									if ($engine->{"get".ucfirst($property_value)}())
										echo '<img src="' . ENGINES_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" title="' . strip_tags($pw_engine_description[$property_value]) . '" style="max-height: 28px; title="' . strip_tags($pw_engine_description[$property_value]) . '" /> ';
								}
								?>
								<?php echo $engine->getName(); ?>
								<br />
								<?php
								if ($engine->getDetection() != NULL && $engine->getDetection() != 0)
									echo '<img src="'.TANK_ATTRIBUTES_DIR.'detection.png" alt="Detection icon" style="height: 1.5em;" /> ' . $engine->getDetection() . ' ';
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
				$last_engine_tier = $engine->getTier();
			}
		}
		?>
		</div>
	</div>
</div>

<script type="text/javascript">
var engine_legend_is_visible = false;
function setEngine_legend_visibility() {
	if (engine_legend_is_visible) {
		$button = $('button[id=setEngine_legend_visibility]');
		$button.text("Legend of engine icons [ Click to expand ]");
		document.getElementById('engine_legend').style.display = 'none';
	} else {
		$button = $('button[id=setEngine_legend_visibility]');
		$button.text("Legend of engine icons [ Click to hide ]");
		document.getElementById('engine_legend').style.display = 'block';
	}
	engine_legend_is_visible = !engine_legend_is_visible;
}
</script>