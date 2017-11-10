<fieldset>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<legend>Equipment</legend>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2 col-lg-6 col-lg-offset-3">
			<p>Ammunitions :</p>
			<div class="row">
				<?php
				$ammo_array = ["AP", "APCR", "APDS", "HE", "Heat", "Hesh", "RP"];
				foreach ($ammo_array as $ammo)
				{
					?>
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input
								type="checkbox"
								name="<?php echo strtolower($ammo); ?>"
								id="<?php echo strtolower($ammo); ?>"
								<?php
								if (isset($tank) && $tank->getAmmo()[strtolower($ammo)] == 1)
									echo 'checked="checked"';
								?>
							/>
							<?php echo $ammo; ?>
						</label>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2 col-lg-6 col-lg-offset-3">
			<p>Equipment slots :</p>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-12 col-sm-offset-0 col-lg-8 col-lg-offset-2">
			<?php
			for ($i = 1; $i <= 8; $i++)
			{
				?>
				<label for="equipment_slot_<?php echo $i; ?>" class="col-sm-2 col-lg-1 control-label">Slot <?php echo $i; ?> :</label>
				<div class="col-sm-2 col-lg-2">
					<select name="equipment_slot_<?php echo $i; ?>" id="equipment_slot_<?php echo $i; ?>" class="form-control">
						<optgroup label="Slot">
							<option value="null"
							<?php if (!isset($tank) || (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "null")) echo 'selected="selected"'; ?>
							>(empty)</option>
							<option value="turret"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "turret") echo 'selected="selected"'; ?>
							>Turret</option>
							<option value="mod"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "mod") echo 'selected="selected"'; ?>
							>Mod</option>
							<option value="cabin"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "cabin") echo 'selected="selected"'; ?>
							>Cabin</option>
							<option value="external"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "external") echo 'selected="selected"'; ?>
							>External</option>
							<option value="internal"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "internal") echo 'selected="selected"'; ?>
							>Internal</option>
							<option value="carriage"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "carriage") echo 'selected="selected"'; ?>
							>Carriage</option>
							<option value="special"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "special") echo 'selected="selected"'; ?>
							>Special</option>
						</optgroup>

						<optgroup label="Fate slot">
							<option value="fate_none"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "fate_none") echo 'selected="selected"'; ?>
							>No extra slot</option>
							<option value="fate_turret"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "fate_turret") echo 'selected="selected"'; ?>
							>Turret</option>
							<option value="fate_mod"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "fate_mod") echo 'selected="selected"'; ?>
							>Mod</option>
							<option value="fate_cabin"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "fate_cabin") echo 'selected="selected"'; ?>
							>Cabin</option>
							<option value="fate_external"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "fate_external") echo 'selected="selected"'; ?>
							>External</option>
							<option value="fate_internal"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "fate_internal") echo 'selected="selected"'; ?>
							>Internal</option>
							<option value="fate_carriage"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "fate_carriage") echo 'selected="selected"'; ?>
							>Carriage</option>
							<option value="fate_special"
							<?php if (isset($tank) && $tank->getEquipment_slots()["slot_" . $i] == "fate_special") echo 'selected="selected"'; ?>
							>Special</option>
						</optgroup>

					</select>
				</div>
				<?php
			}
			?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2 col-lg-6 col-lg-offset-3">
			<p>Engine bonus :</p>
			<div class="row">
				<?php
				$engine_bonus_array = ["C Proof", "D Proof", "H Proof", "S Proof", "W Proof", "Silent"];
				foreach ($engine_bonus_array as $engine_bonus)
				{
					?>
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input
								type="checkbox"
								name="<?php echo post_slug($engine_bonus); ?>"
								id="<?php echo post_slug($engine_bonus); ?>"
								<?php
								if (isset($tank) && $tank->getEngine_bonus()[post_slug($engine_bonus)] == 1)
									echo 'checked="checked"';
								?>
							/>
							<?php echo $engine_bonus; ?>
						</label>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2 col-lg-6 col-lg-offset-3">
			<p>Chassis bonus :</p>
			<div class="row">
				<?php
				$chassis_bonus_array = ["Angled", "Flat-top", "Front", "Light", "Low", "Rear", "Sloped", "Tires", "Treads"];
				foreach ($chassis_bonus_array as $chassis_bonus)
				{
					?>
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input
								type="checkbox"
								name="<?php echo post_slug($chassis_bonus); ?>"
								id="<?php echo post_slug($chassis_bonus); ?>"
								<?php
								if (isset($tank) && $tank->getChassis_bonus()[post_slug($chassis_bonus)] == 1)
									echo 'checked="checked"';
								?>
							/>
							<?php echo $chassis_bonus; ?>
						</label>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</fieldset>