<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<?php
		///////////////////////////////////////////////////////////////////////////////////////////////////
		//	Submenu
		///////////////////////////////////////////////////////////////////////////////////////////////////

		foreach ($pw_terrains as $terrain => $effects)
		{
			?>
		<div class="terrains_submenu <?php if (post_slug($terrain_name) == post_slug($terrain)) echo "selected"; ?>">
			<a href="<?php echo link_to_route("terrains") . "&amp;terrain=" . post_slug($terrain); ?>">
				<img
					src="<?php echo TERRAINS_DIR . post_slug($terrain) . '.png'; ?>"
					alt="<?php echo $terrain; ?>'s icon"
					class="img-responsive"
				/>
				<br />
				<?php echo ucfirst($terrain); ?>
			</a>
		</div>
			<?php
		}
		?>
		<br /><br />
		<?php
		///////////////////////////////////////////////////////////////////////////////////////////////////
		//	Content start
		///////////////////////////////////////////////////////////////////////////////////////////////////
		?>
		<h4 class="page-header"><?php echo ucfirst($terrain_name); ?></h4>
		<table class="table table-width-auto">
		<tr>
			<th style="border: 0;">Terrain effect</th>
			<th style="border: 0;">Counter</th>
			<th style="border: 0;">Terrain effect description</th>
		</tr>
		<?php
		///////////////////////////////////////////////////////////////////////////////////////////////////
		//	Display terrain effects
		///////////////////////////////////////////////////////////////////////////////////////////////////
		foreach ($terrain_effects as $terrain_effect)
		{
			?>
			<tr>
				<td style="border: 0;">
					<?php echo ucfirst($terrain_effect); ?>
				</td>
				<td style="border: 0;">
					<?php echo str_replace("_", " ", ucfirst($pw_terrains_counter[$terrain_effect])); ?>
				</td>
				<td style="border: 0;">
					<?php echo $pw_terrains_effect[$terrain_effect]; ?>
				</td>
			</tr>
			<?php
		}
		?>
		</table>

		<hr />

		<div class="alert alert-warning" role="alert">
			<p>Warning : This is only an approximation and a work-in-progress.</p>
			<ul>
				<li>Some metal maidens may have more than one type of engine/chassis and therefore can not accumulate all the bonuses from theirs engines/chassis at the same time.</li>
				<li>You also have to take into account the range of the ammo available for your metal maiden for each terrains</li>
			</ul>
		</div>

		<?php
		///////////////////////////////////////////////////////////////////////////////////////////////////
		//	Display tank list for the terrain
		///////////////////////////////////////////////////////////////////////////////////////////////////
		for ($i = $terrain_counter_effects_size; $i >= 0; $i--)
		{
			echo "<h4>Metal maidens with " . $i . " on " . $terrain_counter_effects_size . " suitable equipment :</h4>";
			$last_displayed_category = NULL;

			echo '<div class="row">';

			foreach ($tank_list as $tank_element)
			{
				$tank_number_of_counter_effect = 0;

				foreach ($terrain_counter_effects as $terrain_counter_effect)
				{
					if (in_array($terrain_counter_effect, $tank_element->getChassis_bonus_available()) || in_array($terrain_counter_effect, $tank_element->getEngine_bonus_available()))
					{
						++$tank_number_of_counter_effect;
					}
				}

				if ($tank_number_of_counter_effect == $i)
				{
					if ($last_displayed_category != $tank_element->getCategory())
					{
						if ($last_displayed_category != NULL)
						{
							echo "<br />";
						}

						$last_displayed_category = $tank_element->getCategory();
						?>
						<div class="col-lg-12 col-xs-12 tank_category_icon">
							<img
								src="<?php echo TANK_CATEGORIES_DIR . $tank_element->getCategory(); ?>.png"
								alt="<?php echo $tank_element->getCategory(); ?> icon"
							/>
						</div>
						<?php
						//echo '<h4>' . ucfirst($tank_element->getCategory()) . '</h4>';
					}
					?>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<table class="table table-responsive table-bordered terrains_tank_table">
						<tr>
							<td class="lifestyle_skills">
								<?php
								for ($k = 1; $k <= 3; ++$k)
								{
									if (isset($tank_element->getLifestyle_skills()["skill_$k"]) && $tank_element->getLifestyle_skills()["skill_$k"] != "null")
									{
										?>
										<img
											src="<?php echo LIFESTYLE_SKILLS . $tank_element->getLifestyle_skills()["skill_$k"]; ?>.png"
											alt="<?php echo $tank_element->getLifestyle_skills()["skill_$k"]; ?>'s icon"
										/>
										<?php echo $tank_element->getLifestyle_skills()["skill_".$k."_level"]; ?>
										<br />
										<?php
									}
								}
								?>
							</td>
							<td class="tank_portrait">
								<a href="index.php?route=metal_maiden&amp;tank=<?php echo $tank_element->getTank_slug(); ?>">
									<img
										src="<?php echo TANKS_DIR . "portrait/" . $tank_element->getImagename(); ?>.png"
										alt="<?php echo $tank_element->getTank(); ?> portrait"
										class="tank_portrait img-responsive"
									/>
								</a>
							</td>
							<td style="vertical-align: middle;">
								<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $tank_element->getTank_slug(); ?>" class="<?php echo $tank_element->getRarity(); ?>_rarity_text">
									N<?php echo ($tank_element->getBlueprint_rank() != 0) ? $tank_element->getBlueprint_rank() : "?"; ?>
									<?php echo $tank_element->getTank(); ?>
								</a>
								<br />
								<?php
								if ($tank_number_of_counter_effect < $terrain_counter_effects_size)
								{
									$j = 0;
									echo "<small>Missing :<br />";
									foreach ($terrain_counter_effects as $terrain_counter_effect)
									{
										if (!(in_array($terrain_counter_effect, $tank_element->getChassis_bonus_available()) || in_array($terrain_counter_effect, $tank_element->getEngine_bonus_available())))
										{
											$missing_counters[] = $terrain_counter_effect;

											if ($j > 0)
											{
												echo "<br />";
											}

											echo "- " . ucfirst(str_replace("_", " ", $terrain_counter_effect)) . " : " . $pw_terrains_effect_mini[array_flip($pw_terrains_counter)[$terrain_counter_effect]];

											++$j;
										}
										
									}
									echo "</small>";
								}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<?php
								foreach ($tank_element->getAmmo() as $missile => $value) {
									if ($value == "1")
									{
										?>
										<img
											src="<?php echo TANK_EQUIPMENTS_DIR . 'missiles/' . $missile . '.png'; ?>"
											alt="<?php echo $missile; ?> shell"
											class="shell_icon"
										/>
										<?php
									}
								}
								?>
							</td>
						</tr>
						</table>
					</div>
					<?php
					//echo '<a href="' . link_to_route("metal_maiden") . '&amp;tank=' . $tank_element->getTank_slug() . '">' . $tank_element->getTank() . '</a><br />';
				}
			}
			echo '</div><hr />';
			echo "<br /><br />";
		}
		?>
	</div>
</div>