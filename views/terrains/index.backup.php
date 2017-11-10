<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<?php
		///////////////////////////////////////////////////////////////////////////////////////////////////
		//	Submenu
		///////////////////////////////////////////////////////////////////////////////////////////////////

		foreach ($pw_terrains as $terrain => $effects)
		{
			?>
		<div style="display: inline-block; border: 1px solid white; padding: 5px;">
			<a href="<?php echo link_to_route("terrains") . "&amp;terrain=" . post_slug($terrain); ?>">
				<?php echo $terrain; ?>
			</a>
		</div>
			<?php
		}

		echo "<br /><br />";

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

		<?php
		///////////////////////////////////////////////////////////////////////////////////////////////////
		//	Display tank list for the terrain
		///////////////////////////////////////////////////////////////////////////////////////////////////
		for ($i = $terrain_counter_effects_size; $i >= 0; $i--)
		{
			echo "<h4>Metal maidens with " . $i . " on " . $terrain_counter_effects_size . " suitable equipment :</h4>";
			$last_displayed_rarity = NULL;
			$last_displayed_category = NULL;

			echo '<div class="row">';

			foreach ($tank_list as $tank_element)
			{
				if ($last_displayed_rarity != $tank_element->getRarity())
				{
					if ($last_displayed_rarity != NULL)
					{
						echo "<br />";
					}

					$last_displayed_rarity = $tank_element->getRarity();
					echo '<div class="col-lg-12"><h4 class="' . $tank_element->getRarity() . '_rarity_text">' . ucfirst($tank_element->getRarity()) . '</h4></div>';
				}

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
						?><div class="col-lg-12">
						<img
							src="<?php echo TANK_CATEGORIES_DIR . $tank_element->getCategory(); ?>.png"
							alt="<?php echo $tank_element->getCategory(); ?> icon"
							style="max-height: 2.5em"
						/><br /></div>
						<?php
						//echo '<h4>' . ucfirst($tank_element->getCategory()) . '</h4>';
					}
					?>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<table class="table table-responsive table-bordered">
						<tr>
							<td style="width: 80px">
								<a href="index.php?route=metal_maiden&amp;tank=<?php echo $tank_element->getTank_slug(); ?>">
									<img
										src="<?php echo TANKS_DIR . "portrait/" . $tank_element->getImagename(); ?>.png"
										alt="<?php echo $tank_element->getTank(); ?> portrait"
										style="height: 50px;"
									/>
								</a>
							</td>
							<td style="vertical-align: middle;">
								<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $tank_element->getTank_slug(); ?>" class="<?php echo $tank_element->getRarity(); ?>_rarity_text">
									<?php echo $tank_element->getTank(); ?>
								</a>
								<br />
								<?php
								if ($tank_number_of_counter_effect < $terrain_counter_effects_size)
								{
									$j = 0;
									echo "<small>Missing : ";
									foreach ($terrain_counter_effects as $terrain_counter_effect)
									{
										if (!(in_array($terrain_counter_effect, $tank_element->getChassis_bonus_available()) || in_array($terrain_counter_effect, $tank_element->getEngine_bonus_available())))
										{
											$missing_counters[] = $terrain_counter_effect;

											if ($j > 0)
											{
												echo " -";
											}

											echo " " . ucfirst(str_replace("_", " ", $terrain_counter_effect));

											++$j;
										}
										
									}
									echo "</small>";
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