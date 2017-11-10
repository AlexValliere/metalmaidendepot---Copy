<div class="row profile">
	<div class="col-xs-12 col-sm-5 col-lg-3">
		<img
			src="<?php echo TANKS_DIR . "portrait/" . $view_tank->getImagename(); ?>.png"
			alt="Portrait of <?php echo $view_tank->getTank(); ?>"
		/>
		<br /><br />
		<table>
			<tr>
				<td>
					<img
						src="<?php echo TANK_CATEGORIES_DIR . $view_tank->getCategory(); ?>.png"
						alt="<?php echo $view_tank->getCategory(); ?> category"
						class="category-icon"
					/>
				</td>
				<td><span class="tank"><?php echo $view_tank->getTank(); ?></span></td>
			</tr>
			<tr>
				<td>
					<img
						src="<?php echo NATIONAL_FLAGS_DIR . $view_tank->getNation(); ?>.png"
						alt="<?php echo $view_tank->getNation(); ?> flag"
						class="flag-icon"
					/>
				</td>
				<td><?php echo $view_tank->getName(); ?></td>
			</tr>
		</table>
	</div>

	<div class="col-xs-12 col-sm-7 col-lg-9">
		<strong>Unlocks</strong><br />
		<?php
		foreach ($view_tank_rd as $tank)
		{
			?>
			<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $tank->getTank_slug(); ?>" style="text-decoration: none;">
				<div class="research_sub_block">
					<div class="tank_portrait">
						<img
							src="<?php echo TANKS_DIR . "portrait/" . $tank->getImagename(); ?>.png"
							alt="<?php echo $tank->getTank(); ?> portrait"
							class="img-responsive tank_portrait"
						/>
						<img
							src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $tank->getMax_rank() . ".png"; ?>"
							alt="Tech rank"
							class="tech"
						/>
					</div>
					<p>
						<small><?php echo strtoupper($tank->getCategory()); ?></small>
						<small class="<?php echo $tank->getRarity(); ?>_rarity_text"><?php echo $tank->getTank(); ?></small>
						<br />
						
					</p>
				</div>
			</a>
			<?php
		}
		if (empty($view_tank_rd))
			echo "<p>Nothing</p>";
		?>
	</div>
</div>



<div class="row">
	<div class="col-xs-12 col-sm-12 col-lg-3 block-wrapper">
		<table class="row2">
			<tr>
				<th>Category</th>
				<td><?php echo $pw_tank_categories[$view_tank->getCategory()]; ?></td>
			</tr>
			<tr>
				<th>Armor</th>
				<td><?php echo ucfirst($pw_tank_armor_by_categories[$view_tank->getCategory()]); ?></td>
			</tr>
			<tr>
				<th>Nation</th>
				<td><?php echo ucfirst($view_tank->getNation()); ?></td>
			</tr>
			<tr>
				<th>Rarity</th>
				<td><span class="<?php echo $view_tank->getRarity(); ?>_rarity_text"><?php echo ucfirst($view_tank->getRarity()); ?></span></td>
			</tr>
			<tr>
				<th>Live2D</th>
				<td><?php echo ($view_tank->getLive2d() == "1" ? "Available" : "Not available"); ?></td>
			</tr>
		</table>

		<br />

		<strong>Talents</strong><br />
		<table class="row2">
		<?php
		for ($i = 1; $i <= 3; ++$i)
		{
			if (isset($view_tank->getLifestyle_skills()["skill_$i"]) && $view_tank->getLifestyle_skills()["skill_$i"] != "null")
			{
				?>
				<tr>
					<td>
						<img
							src="<?php echo LIFESTYLE_SKILLS . $view_tank->getLifestyle_skills()["skill_$i"]; ?>.png"
							alt="<?php echo $view_tank->getLifestyle_skills()["skill_$i"]; ?> talent icon"
							class="lifestyle-skill-icon"
						/>
					</td>
					<td>
						<?php echo ucfirst($view_tank->getLifestyle_skills()["skill_$i"]); ?>
					</td>
					<td>
						<?php echo $view_tank->getLifestyle_skills()["skill_".$i."_level"]; ?>
					</td>
				</tr>
				<?php
			}
		}
		?>
		</table>

		<br />

		<strong>Slots</strong><br />
		<?php
		foreach ($view_tank->getEquipment_slots() as $slot => $equipment_slot)
		{
			if ($equipment_slot != "null" && explode("_", $equipment_slot)[0] != "fate")
			{
				?>
				<img
					src="<?php echo TANK_EQUIPMENTS_DIR . 'slots/' . $equipment_slot . '.png'; ?>"
					alt="<?php echo $equipment_slot . " slot"; ?>"
					class="slot-icon"
				/>
				<?php
			}
		}
		?>

		<br /><br />

		<strong>Fate slots</strong><br />
		<?php
		$fate_slot_is_null = TRUE;
		foreach ($view_tank->getEquipment_slots() as $slot => $equipment_slot)
		{
			if ($equipment_slot != "null" && explode("_", $equipment_slot)[0] == "fate")
			{
				$fate_slot_is_null = FALSE;
				$equipment_slot = str_replace("fate_", "", $equipment_slot);
				if ($equipment_slot != "none")
				{
					?>
					<img
						src="<?php echo TANK_EQUIPMENTS_DIR . 'slots/' . $equipment_slot . '.png'; ?>"
						alt="<?php echo $equipment_slot . " slot"; ?>"
						class="slot-icon"
					/>
					<?php
				}
				else
				{
					echo "No extra slot";
				}
			}
		}

		if ($fate_slot_is_null)
		{
			echo "Unknown";
		}
		?>

		<br /><br />

		<strong>Shells</strong><br />
		<table class="row2">
			<?php
			foreach ($view_tank->getAmmo() as $missile => $value) {
				if ($value == "1")
				{
					?>
					<tr>
						<td>
							<img
								src="<?php echo TANK_EQUIPMENTS_DIR . 'missiles/' . $missile . '.png'; ?>"
								alt="<?php echo $missile; ?> shell"
								class="shell-icon"
							/>
						</td>
						<td>
							<?php echo $pw_ammo_description[$missile]; ?><br />
						</td>
					</tr>
					<?php
				}
			}
			?>
		</table>

	</div>

	<div class="col-xs-12 col-sm-12 col-lg-9 block-wrapper">
		<div class="row">
			<p>
				<strong>Statistics :</strong>
				[ <span class="attribute-lvl60">Value at level 60</span> ]
				[ <a href="<?php echo link_to_route("statistics") . "&amp;category=" . $view_tank->getCategory(); ?>"><span class="attribute-rank">Rank in <?php echo strtoupper($view_tank->getCategory()); ?> category</span></a> <small><span class="attribute-delta-median">&Delta;</span> &plusmn; delta median</small> ]
			</p>
		</div>
		<div class="row">
			<?php
			foreach ($pw_tank_attributes as $attribute)
			{

				?>
				<div class="col-xs-12 col-sm-4 col-md-6 col-lg-4">
					<div class="table-responsive">
						<table class="table table-bordered attribute">
							<tr>
								<td>
									<?php echo number_format($view_tank->getAttribute($attribute), 0, ',', ' '); ?><br />
									<?php
									if (in_array($attribute . "_lvl60", $pw_tank_attributes_lvl60))
									{
										?>
										<span class='attribute-lvl60'><?php echo $view_tank->getAttribute($attribute . "_lvl60"); ?></span>
										<?php
									}
									?>
								</td>
								<td>
									<img
										src="<?php echo TANK_ATTRIBUTES_DIR . $attribute . ".png"; ?>"
										alt="<?php echo ucfirst($attribute); ?> icon"
									/>
								</td>
								<td>
									<?php echo ucfirst($attribute); ?>
									<br />
									<span class="attribute-rank">
										<?php echo $metalMaidensManager->get_attribute_rank_for_id_in_category($view_tank->getId(), $view_tank->getCategory(), $attribute)["rank"]; ?>
									</span>
									<small>
										<span class="attribute-delta-median">&Delta;</span>
										<?php echo sprintf("%+d", $metalMaidensManager->get_attribute_rank_for_id_in_category($view_tank->getId(), $view_tank->getCategory(), $attribute)["delta_median"]); ?>
									</small>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<?php
			}
			?>
		</div>

		<div class="row">
			<?php
			foreach ($pw_tank_hidden_attributes as $attribute)
			{
				?>
				<div class="col-xs-12 col-sm-4 col-md-6 col-lg-4">
					<div class="table-responsive">
						<table class="table table-bordered attribute">
							<tr>
								<td class="hidden-attribute">
									<?php echo $view_tank->getAttribute($attribute); ?><br />
								</td>
								<td colspan="2">
									<?php echo str_replace("Crit", "Critical", str_replace("resist", "resistance", str_replace("_", " ", ucfirst($attribute)))); ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>






<div class="row">
	<div class="col-xs-12 col-sm-12 col-lg-6 block-wrapper">
		<strong>Chassis properties</strong><br />
		<table class="row2">
			<?php
			foreach ($view_tank->getChassis_bonus() as $chassis_bonus => $value)
			{
				if ($value == "1")
				{
					?>
					<tr>
						<td>
							<img
								src="<?php echo TANK_EQUIPMENTS_DIR . 'chassis/' . $chassis_bonus . '.png'; ?>"
								alt="<?php echo $chassis_bonus; ?> chassis bonus"
								class="chassis-property-icon"
							/>
						</td>
						<td>
							<span style="color: #5cb85c;"><?php echo ucfirst(str_replace("_", " ", $chassis_bonus)); ?></span>
							<br />
							<small><?php echo explode("</span> ", $pw_chassis_description[$chassis_bonus])[1]; ?></small>
							<br />
							<?php
							if (isset(explode(" : ", $pw_chassis_description[$chassis_bonus])[1]))
							{
								?>
								<small><?php echo explode(" : ", $pw_chassis_description[$chassis_bonus])[1]; ?></small>
								<?php
							}
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>
		</table>
	</div>

	<div class="col-xs-12 col-sm-12 col-lg-6 block-wrapper">
		<strong>Engine properties</strong><br />
		<table class="row2">
			<?php
			foreach ($view_tank->getEngine_bonus() as $engine_bonus => $value)
			{
				if ($value == "1")
				{
					?>
					<tr>
						<td>
							<img
								src="<?php echo TANK_EQUIPMENTS_DIR . 'engine/' . $engine_bonus . '.png'; ?>"
								alt="<?php echo $engine_bonus; ?> engine bonus"
								class="chassis-property-icon"
							/>
						</td>
						<td>
							<span style="color: #5cb85c;"><?php echo ucfirst(str_replace("_", " ", $engine_bonus)); ?></span>
							<br />
							<small><?php echo explode("</span> ", $pw_engine_description[$engine_bonus])[1]; ?></small>
							<br />
							<?php
							if (isset(explode(" : ", $pw_engine_description[$engine_bonus])[1]))
							{
								?>
								<small><?php echo explode(" : ", $pw_engine_description[$engine_bonus])[1]; ?></small>
								<?php
							}
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>
		</table>
	</div>
</div>