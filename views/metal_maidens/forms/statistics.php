<fieldset>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<legend>Statistics</legend>
		</div>
	</div>

	<div class="form-group">
		<label for="firepower" class="col-sm-2 col-sm-offset-0 col-lg-1 col-lg-offset-3 control-label">Firepower :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="firepower" id="firepower" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getFirepower(); else echo "0"; ?>"
			/>
		</div>

		<label for="penetration" class="col-sm-2 col-lg-1 control-label">Penetration :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="penetration" id="penetration" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getPenetration(); else echo "0"; ?>"
			/>
		</div>

		<label for="targeting" class="col-sm-2 col-lg-1 control-label">Targeting :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="targeting" id="targeting" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getTargeting(); else echo "0"; ?>"
			/>
		</div>
	</div>

	<div class="form-group">
		<label for="durability" class="col-sm-2 col-sm-offset-0 col-lg-1 col-lg-offset-3 control-label">Durability :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="durability" id="durability" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getDurability(); else echo "0"; ?>"
			/>
		</div>

		<label for="armor" class="col-sm-2 col-lg-1 control-label">Armor :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="armor" id="armor" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getArmor(); else echo "0"; ?>"
			/>
		</div>

		<label for="evasion" class="col-sm-2 col-lg-1 control-label">Evasion :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="evasion" id="evasion" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getEvasion(); else echo "0"; ?>"
			/>
		</div>
	</div>

	<div class="form-group">
		<label for="stealth" class="col-sm-2 col-sm-offset-0 col-lg-1 col-lg-offset-3 control-label">Stealth :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="stealth" id="stealth" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getStealth(); else echo "0"; ?>"
			/>
		</div>

		<label for="detection" class="col-sm-2 col-lg-1 control-label">Detection :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="detection" id="detection" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getDetection(); else echo "0"; ?>"
			/>
		</div>
	</div>

	<div class="form-group">
		<label for="min_range" class="col-sm-2 col-sm-offset-0 col-lg-1 col-lg-offset-3 control-label">Minimal range :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="min_range" id="min_range" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getMin_range(); else echo "0"; ?>"
			/>
		</div>

		<label for="max_range" class="col-sm-2 col-lg-1 control-label">Maximal range :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="max_range" id="max_range" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getMax_range(); else echo "0"; ?>"
			/>
		</div>
	</div>

	<div class="form-group">
		<label for="fire_resist" class="col-sm-2 col-sm-offset-0 col-lg-1 col-lg-offset-3 control-label">Fire resist :</label>
		<div class="col-sm-2 col-lg-1">
			<select name="fire_resist" id="fire_resist" class="form-control">
				<option value=""
				<?php if (!isset($tank) || (isset($tank) && empty($tank->getFire_resist()))) echo 'selected="selected"'; ?>
				>(empty)</option>
				<option value="S"
				<?php if (isset($tank) && $tank->getFire_resist() == "S") echo 'selected="selected"'; ?>
				>S</option>
				<option value="A"
				<?php if (isset($tank) && $tank->getFire_resist() == "A") echo 'selected="selected"'; ?>
				>A</option>
				<option value="B"
				<?php if (isset($tank) && $tank->getFire_resist() == "B") echo 'selected="selected"'; ?>
				>B</option>
				<option value="C"
				<?php if (isset($tank) && $tank->getFire_resist() == "C") echo 'selected="selected"'; ?>
				>C</option>
				<option value="D"
				<?php if (isset($tank) && $tank->getFire_resist() == "D") echo 'selected="selected"'; ?>
				>D</option>
			</select>
		</div>

		<label for="crit_resist" class="col-sm-2 col-lg-1 control-label">Crit resist :</label>
		<div class="col-sm-2 col-lg-1">
			<select name="crit_resist" id="crit_resist" class="form-control">
				<option value=""
				<?php if (!isset($tank) || (isset($tank) && empty($tank->getCrit_resist()))) echo 'selected="selected"'; ?>
				>(empty)</option>
				<option value="S"
				<?php if (isset($tank) && $tank->getCrit_resist() == "S") echo 'selected="selected"'; ?>
				>S</option>
				<option value="A"
				<?php if (isset($tank) && $tank->getCrit_resist() == "A") echo 'selected="selected"'; ?>
				>A</option>
				<option value="B"
				<?php if (isset($tank) && $tank->getCrit_resist() == "B") echo 'selected="selected"'; ?>
				>B</option>
				<option value="C"
				<?php if (isset($tank) && $tank->getCrit_resist() == "C") echo 'selected="selected"'; ?>
				>C</option>
				<option value="D"
				<?php if (isset($tank) && $tank->getCrit_resist() == "D") echo 'selected="selected"'; ?>
				>D</option>
			</select>
		</div>

		<label for="crit_defense" class="col-sm-2 col-lg-1 control-label">Crit defense :</label>
		<div class="col-sm-2 col-lg-1">
			<select name="crit_defense" id="crit_defense" class="form-control">
				<option value=""
				<?php if (!isset($tank) || (isset($tank) && empty($tank->getCrit_defense()))) echo 'selected="selected"'; ?>
				>(empty)</option>
				<option value="S"
				<?php if (isset($tank) && $tank->getCrit_defense() == "S") echo 'selected="selected"'; ?>
				>S</option>
				<option value="A"
				<?php if (isset($tank) && $tank->getCrit_defense() == "A") echo 'selected="selected"'; ?>
				>A</option>
				<option value="B"
				<?php if (isset($tank) && $tank->getCrit_defense() == "B") echo 'selected="selected"'; ?>
				>B</option>
				<option value="C"
				<?php if (isset($tank) && $tank->getCrit_defense() == "C") echo 'selected="selected"'; ?>
				>C</option>
				<option value="D"
				<?php if (isset($tank) && $tank->getCrit_defense() == "D") echo 'selected="selected"'; ?>
				>D</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="firepower_lvl60" class="col-sm-2 col-sm-offset-0 col-lg-1 col-lg-offset-3 control-label">Firepower LVL60 :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="firepower_lvl60" id="firepower_lvl60" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getFirepower_lvl60(); else echo "0"; ?>"
			/>
		</div>

		<label for="penetration_lvl60" class="col-sm-2 col-lg-1 control-label">Penetration LVL60 :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="penetration_lvl60" id="penetration_lvl60" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getPenetration_lvl60(); else echo "0"; ?>"
			/>
		</div>
	</div>

	<div class="form-group">
		<label for="durability_lvl60" class="col-sm-2 col-sm-offset-0 col-lg-1 col-lg-offset-3 control-label">Durability LVL60 :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="durability_lvl60" id="durability_lvl60" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getDurability_lvl60(); else echo "0"; ?>"
			/>
		</div>

		<label for="armor_lvl60" class="col-sm-2 col-lg-1 control-label">Armor LVL60 :</label>
		<div class="col-sm-2 col-lg-1">
			<input type="number" name="armor_lvl60" id="armor_lvl60" min="0" max="99999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getArmor_lvl60(); else echo "0"; ?>"
			/>
		</div>
	</div>

</fieldset>