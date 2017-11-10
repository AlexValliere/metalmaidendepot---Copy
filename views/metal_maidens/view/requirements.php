<div class="row">
	<?php
	if ($view_tank->getRefactor() > 0)
	{
		?>
	<div class="col-lg-12 requirements_block">
		<h4 class="page-header">Refactor</h4>
		<p>Appears in BWMG Depot LV<?php echo $view_tank->getRefactor(); ?></p>
		<img
			class="img-responsive required_supply"
			src="<?php echo SUPPLY_DIR . 'bwmg.png'; ?>"
			alt="BWMG Depot image"
		/>
	</div>
		<?php
	}
	?>
	<?php
	if ($view_tank->getNaval_port() > 0)
	{
		?>
	<br />
	<div class="col-lg-12 requirements_block">
		<h4 class="page-header">Naval Port</h4>
		<p>Requires Naval Port LV<?php echo $view_tank->getNaval_port(); ?></p>
		<img
			class="img-responsive required_supply"
			src="<?php echo SUPPLY_DIR . 'naval_port.png'; ?>"
			alt="Naval Port image"
		/>
	</div>
		<?php
	}
	?>
	<?php
	if ($view_tank->getForge() == 1)
	{
		?>
	<br />

	<div class="col-lg-12 requirements_block">
		<h4 class="page-header">Source Forge</h4>
		<p>Can be obtained at Source Forge</p>
		<img
			class="img-responsive required_supply"
			src="<?php echo SUPPLY_DIR . 'source_forge.png'; ?>"
			alt="Source Forge image"
		/>
	</div>
	<?php
	}
	?>
	<?php
	if ($view_tank->getChapter() != NULL && array_search('1', $view_tank->getChapter()))
	{
		?>
	<br />

	<div class="col-lg-12 requirements_block">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="page-header">Can be obtained in the following volumes</h4>
			</div>
		</div>
		<div class="row">
			<?php
			foreach ($view_tank->getChapter() as $key => $value)
			{
				if ($value == "1")
				{
					?>
					<div class="col-xs-6 col-sm-3 col-lg-1">
						<p>Volume <?php echo str_replace("_", "-", $key); ?></p>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
	<?php
	}
	?>
	<?php
	$form_values_array = ["method_1", "method_2", "method_3", "develop", "research"];
	foreach($form_values_array as $form_value)
	{
		if ($view_tank->getRequirements($form_value) != NULL)
		{
			$metalMaidensManager = new MetalMaidensManager($dbhandler);
			?>
			<br />
			<div class="col-lg-12 requirements_block">
				<div class="row">
					<div class="col-lg-12">
						<h4 class="page-header"><?php echo ucfirst(str_replace("_", " ", $form_value)); ?></h4>
					</div>
				</div>
				<?php
				if ($view_tank->getRequirements($form_value)["commander_level"] != 0)
				{
					?>
					<div class="row">
						<div class="col-lg-12">
							<span class="label label-danger required_commander_level">
								Require Commander level <?php echo $view_tank->getRequirements($form_value)["commander_level"]; ?>
							</span>
						</div>
					</div>
					<?php
				}
				?>
				<div class="row">
					<?php
					for ($i = 1; $i <= 3; $i++)
					{
						if ($view_tank->getRequirements($form_value)["tank_" . $i] != NULL)
						{
							$tank_req = $metalMaidensManager->get($view_tank->getRequirements($form_value)["tank_" . $i]);
							?>
							<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $tank_req->getTank_slug(); ?>">
								<div class="col-xs-3 col-sm-2 col-lg-1 requirements_sub_block">
									<p class="required_tank_level <?php echo $tank_req->getRarity(); ?>_rarity_border">
										<small>
											Level <?php if ($view_tank->getRequirements($form_value)["tank_level_" . $i] != 0) echo $view_tank->getRequirements($form_value)["tank_level_" . $i]; else echo "?"; ?>
										</small>
									</p>
									<div class="tank_portrait">
										<img
											src="<?php echo TANKS_DIR . "portrait/" . $tank_req->getImagename(); ?>.png"
											alt="<?php echo $tank_req->getTank(); ?> portrait"
											class="img-responsive"
										/>
										<img
											src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $tank_req->getMax_rank() . ".png"; ?>"
											alt="Tech rank"
											class="tech"
										/>
									</div>
									<p>
										<small><?php echo $tank_req->getTank(); ?></small>
										<br />
										
									</p>
								</div>
							</a>
							<?php
						}
					}
					?>
				</div>
				<div class="row">
					<?php
					if ($view_tank->getRequirements($form_value)["dogtag"] != 0)
					{
						?>
						<div class="col-xs-3 col-sm-2 col-lg-1 requirements_sub_block">
							<img
								src="<?php echo PW_RESOURCES_DIR . "dogtag.png"; ?>"
								alt="Dogtag image"
								class="img-responsive required_item"
							/>
							<p class="item_quantity">
								x <?php echo $view_tank->getRequirements($form_value)["dogtag"]; ?>
							</p>
						</div>
						<?php
					}

					if (isset($view_tank->getRequirements($form_value)["voucher"]) && $view_tank->getRequirements($form_value)["voucher"] != 0)
					{
						?>
						<div class="col-xs-3 col-sm-2 col-lg-1 requirements_sub_block">
							<img
								src="<?php echo PW_RESOURCES_DIR . "voucher.png"; ?>"
								alt="Dogtag image"
								class="img-responsive required_item"
							/>
							<p class="item_quantity">
								x <?php echo $view_tank->getRequirements($form_value)["voucher"]; ?>
							</p>
						</div>
						<?php
					}

					?>
					<?php
					if ($view_tank->getRequirements($form_value)["resource_quantity"] != 0)
					{
						?>
						<div class="col-xs-3 col-sm-2 col-lg-1 requirements_sub_block">
							<img
								src="<?php echo PW_RESOURCES_DIR . $view_tank->getRequirements($form_value)["resource"] . ".png"; ?>"
								alt="Resource image"
								class="img-responsive required_item"
							/>
							<p class="item_quantity">
								x <?php echo $view_tank->getRequirements($form_value)["resource_quantity"]; ?>
							</p>
						</div>
						<?php
					}
					?>
					<?php
					if ($view_tank->getRequirements($form_value)["blueprint_quantity"] != 0)
					{
						?>
						<div class="col-xs-3 col-sm-2 col-lg-1 requirements_sub_block">
							<img
								src="<?php echo PW_RESOURCES_DIR . $view_tank->getRequirements($form_value)["blueprint"] . ".png"; ?>"
								alt="Blueprint image"
								class="img-responsive required_item"
							/>
							<p class="item_quantity">
								x <?php echo $view_tank->getRequirements($form_value)["blueprint_quantity"]; ?>
							</p>
						</div>
						<?php
					}
					?>
					<?php
					if ($view_tank->getRequirements($form_value)["equipment_quantity"] != 0)
					{
						$equipment = explode("_", $view_tank->getRequirements($form_value)["equipment"]);
						$slot = array_shift($equipment);
						$equipment = implode("_", $equipment);
						?>
						<div class="col-xs-3 col-sm-2 col-lg-1 requirements_sub_block">
							<img
								src="<?php echo TANK_EQUIPMENTS_DIR . "slot_items/" . $equipment . ".png"; ?>"
								alt="<?php echo ucfirst($equipment); ?> image"
								class="img-responsive required_item"
							/>
							<p class="item_rank">S<?php echo $view_tank->getRequirements($form_value)["equipment_rank"]; ?></p>
							<img
								src="<?php echo TANK_EQUIPMENTS_DIR . "slots/" . $slot . ".png"; ?>"
								alt="<?php echo ucfirst($slot); ?> image"
								class="item_slot"
							/>
							<p class="item_quantity">
								x <?php echo $view_tank->getRequirements($form_value)["equipment_quantity"]; ?>
							</p>
						</div>
						<?php
					}
					?>
				</div>
				<?php
				if ($view_tank->getRequirements($form_value)["silver"] != 0)
				{
					?>
					<div class="row">
						<div class="col-xs-3 col-sm-2 col-lg-1 requirements_sub_block">
							<img
								src="<?php echo PW_RESOURCES_DIR . "silver.png"; ?>"
								alt="Silver image"
								class="img-responsive required_item"
							/>
							<p class="item_quantity">
								x <?php echo number_format($view_tank->getRequirements($form_value)["silver"], 0, ',', ' '); ?>
							</p>
						</div>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
	?>
</div>