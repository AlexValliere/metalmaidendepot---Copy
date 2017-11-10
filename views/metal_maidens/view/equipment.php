<div class="col-lg-4">
	<p><strong>Slots :</strong></p>
	<?php
	foreach ($view_tank->getEquipment_slots() as $slot => $equipment_slot) {
		if ($equipment_slot != "null" && explode("_", $equipment_slot)[0] != "fate")
		{
			?>
			<img
				src="<?php echo TANK_EQUIPMENTS_DIR . 'slots/' . $equipment_slot . '.png'; ?>"
				alt="<?php echo $equipment_slot . "'s icon"; ?>"
				class="icon-size-2"
			/>
			<?php
		}
	}
	?>
	<br /><br />
	<p><strong>Fate slots :</strong></p>
	<?php
	foreach ($view_tank->getEquipment_slots() as $slot => $equipment_slot) {
		if ($equipment_slot != "null" && explode("_", $equipment_slot)[0] == "fate")
		{
			$equipment_slot = str_replace("fate_", "", $equipment_slot);
			?>
			<img
				src="<?php echo TANK_EQUIPMENTS_DIR . 'slots/' . $equipment_slot . '.png'; ?>"
				alt="<?php echo $equipment_slot . "'s icon"; ?>"
				class="icon-size-2"
			/>
			<?php
		}
	}
	?>
	<div class="row equipment-block">
		<div class="col-lg-12">
			<p><strong>Shells :</strong></p>
			<?php
			foreach ($view_tank->getAmmo() as $missile => $value) {
				if ($value == "1")
				{
					?>
					<img
						src="<?php echo TANK_EQUIPMENTS_DIR . 'missiles/' . $missile . '.png'; ?>"
						alt="<?php echo $missile . "'s icon"; ?>"
						class="missile-icon-size"
					/>
					<?php echo $pw_ammo_description[$missile]; ?>
					<br />
					<?php
				}
			}
			?>
			<div class="row equipment-block">
				<div class="col-lg-12">
					<p><strong>Engine bonus :</strong></p>
					<?php
					foreach ($view_tank->getEngine_bonus() as $engine_bonus => $value) {
						if ($value == "1")
						{
							?>
							<img
								src="<?php echo TANK_EQUIPMENTS_DIR . 'engine/' . $engine_bonus . '.png'; ?>"
								alt="<?php echo $engine_bonus . "'s icon"; ?>"
								class="icon-size-2"
							/>
							<?php echo $pw_engine_description[$engine_bonus]; ?>
							<br />
							<?php
						}
					}
					?>
					<div class="row equipment-block">
						<div class="col-lg-12">
							<p><strong>Chassis bonus :</strong></p>
							<?php
							foreach ($view_tank->getChassis_bonus() as $chassis_bonus => $value) {
								if ($value == "1")
								{
									?>
									<img
										src="<?php echo TANK_EQUIPMENTS_DIR . 'chassis/' . $chassis_bonus . '.png'; ?>"
										alt="<?php echo $chassis_bonus . "'s icon"; ?>"
										class="icon-size-2"
									/>
									<?php echo $pw_chassis_description[$chassis_bonus]; ?>
									<br />
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>