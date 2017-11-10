<section class="advanced_search">
	<form class="form-horizontal" action="<?php echo link_to_route("advanced_search"); ?>" method="get" enctype="multipart/form-data">

		<div class="alert alert-info" role="alert">
			<p>Category (ht, mt, lt...) filter uses an OR operator. All the others filters use an AND operator.</p>
		</div>

		<div class="row" style="display: none;">
			<div class="col-xs-12" id="checkboxes">
				<h4>Debug :</h4>
				<div class="row">
					<div class="col-lg-3">
						<?php
						foreach ($pw_tank_categories as $tank_category_acronym => $tank_category_name)
						{
							?>
							<input
								type="checkbox"
								name="tank_categories[]"
								value="<?php echo $tank_category_acronym; ?>"
								input-id="<?php echo $tank_category_acronym; ?>"
							/>
							<?php echo $tank_category_name; ?><br />
							<?php
						}
						?>
					</div>
					<div class="col-lg-3">
						<?php
						foreach ($pw_nations as $nation)
						{
							?>
							<input
								type="checkbox"
								name="nations[]"
								value="<?php echo $nation; ?>"
								input-id="<?php echo $nation; ?>"
							/>
							<?php echo ucfirst($nation); ?><br />
							<?php
						}
						?>
					</div>
					<div class="col-lg-3">
						<?php
						foreach ($pw_ammo as $ammo_acronym => $ammo_name)
						{
							?>
							<input
								type="checkbox"
								name="ammo[]"
								value="<?php echo $ammo_acronym; ?>"
								input-id="<?php echo $ammo_acronym; ?>"
							/>
							<?php echo $ammo_name; ?><br />
							<?php
						}
						?>
					</div>

					<div class="col-lg-3">
						<?php
						foreach ($pw_talents as $talent)
						{
							?>
							<input
								type="checkbox"
								name="talents[]"
								value="<?php echo $talent; ?>"
								input-id="<?php echo $talent; ?>"
							/>
							<?php echo ucfirst($talent); ?><br />
							<?php
						}
						?>
					</div>

				</div>
				<div class="row">

					<div class="col-lg-3">
						<?php
						foreach ($pw_chassis_description as $chassis_name => $chassis_description)
						{
							?>
							<input
								type="checkbox"
								name="chassis[]"
								value="<?php echo $chassis_name; ?>"
								input-id="<?php echo $chassis_name; ?>"
							/>
							<?php echo str_replace("_", "-", ucfirst($chassis_name)); ?><br />
							<?php
						}
						?>
					</div>

					<div class="col-lg-3">
						<?php
						foreach ($pw_engine_description as $engine_name => $engine_description)
						{
							?>
							<input
								type="checkbox"
								name="engines[]"
								value="<?php echo $engine_name; ?>"
								input-id="<?php echo $engine_name; ?>"
							/>
							<?php echo str_replace("_", " ", ucfirst($engine_name)); ?><br />
							<?php
						}
						?>
					</div>

					<div class="col-lg-3">
						<?php
						foreach ($pw_tank_rarities as $tank_rarity => $tank_rarity_numeric)
						{
							?>
							<input
								type="checkbox"
								name="rarity[]"
								value="<?php echo $tank_rarity; ?>"
								input-id="<?php echo $tank_rarity; ?>"
							/>
							<?php echo str_replace("_", " ", ucfirst($tank_rarity)); ?><br />
							<?php
						}
						?>
					</div>

					<div class="col-lg-3">
						<?php
						$blueprint_rank_array = ["unknown", "1-3", "4", "5", "6"];

						foreach ($blueprint_rank_array as $blueprint_rank)
						{
							?>
							<input
								type="checkbox"
								name="blueprint_rank_filter[]"
								value="<?php echo $blueprint_rank; ?>"
								input-id="<?php echo $blueprint_rank; ?>"
							/>
							<?php echo $blueprint_rank; ?><br />
							<?php
						}
						?>
					</div>

				</div>
				<br />
				<div class="row">
					
					<?php
					foreach ( array_keys( $pw_ammo ) as $shell_category )
					{
						if ( array_key_exists( $shell_category, $shell_list ) )
						{
							echo '<div class="col-lg-3">';
							echo '<strong>' . strtoupper( $shell_category ) . '</strong> :<br />';
							
							foreach ( $shell_list[$shell_category] as $shell )
							{
								?>
								<input
									type="checkbox"
									name="shell_ids[]"
									value="<?php echo $shell->getId(); ?>"
									input-id="<?php echo $shell->getId(); ?>"
								/>
								<?php echo $shell->getName(); ?><br />
								<?php
							}

							echo '</div>';
						}
					}
					?>


				</div>
			</div>
		</div>

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Category :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					foreach ($pw_tank_categories as $tank_category_acronym => $tank_category_name)
					{
						?>
						<div class="filter_icon" filter-type="category" filter-id="<?php echo $tank_category_acronym; ?>">
							<img
								src="<?php echo TANK_CATEGORIES_DIR . $tank_category_acronym; ?>.png"
								alt="<?php echo ucfirst($tank_category_name); ?> icon"
								class="filter_icon_category"
							/>
							<p><?php echo summary(ucfirst($tank_category_name), 17); ?></p>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<br />

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Origin :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					foreach ($pw_nations as $nation)
					{
						?>
						<div class="filter_icon" filter-type="nation" filter-id="<?php echo $nation; ?>">
							<img
								src="<?php echo NATIONAL_FLAGS_DIR . $nation; ?>.png"
								alt="<?php echo ucfirst($nation); ?> icon"
								class="filter_icon_category"
							/>
							<p><?php echo summary(ucfirst($nation), 17); ?></p>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<br />

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Shell :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					foreach ($pw_ammo as $ammo_acronym => $ammo_name)
					{
						?>
						<div class="filter_icon" filter-type="ammo" filter-id="<?php echo $ammo_acronym; ?>">
							<img
								src="<?php echo TANK_EQUIPMENTS_DIR . 'missiles/' . strtolower($ammo_acronym) . '.png'; ?>"
								alt="<?php echo ucfirst($ammo_name); ?> icon"
								class="filter_icon_category"
							/>
							<p><?php echo summary(ucfirst($ammo_name), 17); ?></p>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<br />

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Talent :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					foreach ($pw_talents as $talent)
					{
						?>
						<div class="filter_icon" filter-type="talents" filter-id="<?php echo $talent; ?>">
							<img
								src="<?php echo LIFESTYLE_SKILLS . strtolower($talent) .'.png'; ?>"
								alt="<?php echo ucfirst($talent); ?> icon"
								class="filter_icon_category"
							/>
							<p><?php echo summary(ucfirst($talent), 17); ?></p>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<br />

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Chassis :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					foreach ($pw_chassis_description as $chassis_name => $chassis_description)
					{
						?>
						<div class="filter_icon" filter-type="chassis" filter-id="<?php echo $chassis_name; ?>">
							<img
								src="<?php echo TANK_EQUIPMENTS_DIR . 'chassis/' . strtolower($chassis_name) .'.png'; ?>"
								alt="<?php echo str_replace("_", " ", ucfirst($chassis_name)); ?> icon"
								class="filter_icon_category"
							/>
							<p><?php echo summary(str_replace("_", " ", ucfirst($chassis_name)), 17); ?></p>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<br />

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Engine :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					foreach ($pw_engine_description as $engine_name => $engine_description)
					{
						?>
						<div class="filter_icon" filter-type="engines" filter-id="<?php echo $engine_name; ?>">
							<img
								src="<?php echo TANK_EQUIPMENTS_DIR . 'engine/' . strtolower($engine_name) .'.png'; ?>"
								alt="<?php echo str_replace("_", " ", ucfirst($engine_name)); ?> icon"
								class="filter_icon_category"
							/>
							<p><?php echo summary(str_replace("_", " ", ucfirst($engine_name)), 17); ?></p>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Rarity :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					foreach ($pw_tank_rarities as $tank_rarity => $tank_rarity_numeric)
					{
						?>
						<div class="filter_icon" filter-type="rarity" filter-id="<?php echo $tank_rarity; ?>">
							<img
								src="<?php echo TANK_ATTRIBUTES_DIR . 'tech_' . $tank_rarity_numeric . '.png'; ?>"
								alt="<?php echo str_replace("_", " ", ucfirst($tank_rarity)); ?> icon"
								class="filter_icon_category"
							/>
							<p><?php echo summary(str_replace("_", " ", ucfirst($tank_rarity)), 17); ?></p>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Blueprint rank :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					// $blueprint_rank_array = ["unknown", "1-3", "4", "5", "6"];
					$blueprint_rank_array = ["1-3", "4", "5", "6"];

					foreach ($blueprint_rank_array as $blueprint_rank)
					{
						?>
						<div class="filter_icon" filter-type="blueprint_rank_filter" filter-id="<?php echo $blueprint_rank; ?>">
							<p>
								<?php if (is_numeric($blueprint_rank)) echo "N"; echo $blueprint_rank; ?>
							</p>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<br />

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				<span target="engine" class="show-single"><strong>Engine</strong> [ Display / Hide ] :</span><br />
			</div>
			<div class="row" id="engine" style="display: none;">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
						foreach ( $engine_list as $engine )
						{
							?>
							<div class="filter_icon filter_engine_icon" filter-type="engine_ids" filter-id="<?php echo $engine->getId(); ?>">
								<img
									src="<?php echo strtolower( ENGINES_DIR ) . '/tech_' . $engine->getTier() . '/' . $engine->getName() . '.png'; ?>"
									alt="<?php echo $engine->getName().' icon'; ?>"
									class="filter_icon_category"
								/>
								<p>
									<?php echo $engine->getName(); ?>
								</p>
							</div>
							<?php
						}
					?>
				</div>
			</div>
		</div>

		<br />

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				<div class="alert alert-warning" role="alert">
					<strong>Warning :</strong><br />
					Every search options below may return incomplete results as there are missing data for most blue and purple tanks and a few missing data for gold tanks.<br />
					Take a look on the <a href="<?php echo link_to_route("help_mmd"); ?>">help page</a> to get an idea of the referenced and missing data.
				</div>
			</div>
		</div>

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				<strong>Armors</strong> :<br />
				<div class="row">
					<div class="col-xs-12">
						<?php
						foreach ( $pw_armor as $armor_category )
						{
							if ( array_key_exists( $armor_category, $armor_list ) )
							{
								echo '<span target="' . $armor_category . '" class="show-single">' . ucfirst( $armor_category ) . ' [ Display / Hide ] :</span><br />';
								echo '<div id="' . $armor_category . '" style="display: none;">';

								foreach ( $armor_list[$armor_category] as $armor )
								{
									?>
									<div class="filter_icon filter_armor_icon" filter-type="armor_ids" filter-id="<?php echo $armor->getId(); ?>">
										<img
											src="<?php echo strtolower( ARMORS_DIR . $armor->getCategory()) . '/tech_' . $armor->getTier() . '/' . $armor->getName() . '.png'; ?>"
											alt="<?php echo $armor->getName().' icon'; ?>"
											class="filter_icon_category"
										/>
										<p>
											<?php echo $armor->getName(); ?>
										</p>
									</div>
									<?php
								}

								echo '<br /><br /></div>';
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<br />

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				<span target="chassis" class="show-single"><strong>Chassis</strong> [ Display / Hide ] :</span><br />
			</div>
			<div class="row" id="chassis" style="display: none;">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
						foreach ( $chassis_list as $chassis )
						{
							?>
							<div class="filter_icon filter_chassis_icon" filter-type="chassis_ids" filter-id="<?php echo $chassis->getId(); ?>">
								<img
									src="<?php echo strtolower( CHASSIS_DIR ) . '/tech_' . $chassis->getTier() . '/' . $chassis->getName() . '.png'; ?>"
									alt="<?php echo $chassis->getName().' icon'; ?>"
									class="filter_icon_category"
								/>
								<p>
									<?php echo $chassis->getName(); ?>
								</p>
							</div>
							<?php
						}
					?>
				</div>
			</div>
		</div>

		<br />

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				<strong>Shell</strong> :<br />

				<div class="row">
					<div class="col-xs-12">
						<?php
						foreach ( array_keys( $pw_ammo ) as $shell_category )
						{
							if ( array_key_exists( $shell_category, $shell_list ) )
							{
								echo '<span target="' . $shell_category . '" class="show-single">' . strtoupper( $shell_category ) . ' [ Display / Hide ] :</span><br />';
								echo '<div id="' . $shell_category . '" style="display: none;">';

								foreach ( $shell_list[$shell_category] as $shell )
								{
									?>
									<div class="filter_icon filter_shell_icon" filter-type="shell_ids" filter-id="<?php echo $shell->getId(); ?>">
										<img
											src="<?php echo strtolower( SHELLS_DIR . $shell->getCategory()) . '/tech_' . $shell->getTier() . '/' . $shell->getName() . '_icon.png'; ?>"
											alt="<?php echo $shell->getName(); ?>'s icon"
											class="filter_icon_category"
										/>
										<p>
											<?php echo $shell->getName(); ?>
										</p>
									</div>
									<?php
								}

								echo '<br /><br /></div>';
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>

<!-- 		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				<button type="submit" class="btn btn-primary">Search</button>
			</div>
		</div> -->

		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="row" id="advanced_search_detailed_results">
				</div>
			</div>
			
			<div class="col-lg-10 col-lg-offset-1">
				<div class="row" id="advanced_search_results">
				</div>
			</div>
		</div>
	</form>
</section>