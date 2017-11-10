<fieldset>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<legend>Lifestyle skills</legend>
		</div>
	</div>

	<?php
	for($i = 1; $i <= 3; $i++)
	{
		?>
		<div class="form-group">
			<label for="lifestyle_skill_<?php echo $i; ?>" class="col-sm-2 col-sm-offset-1 col-lg-2 col-lg-offset-2 control-label">Lifestyle skill <?php echo $i; ?> :</label>
			<div class="col-sm-2">
				<select name="lifestyle_skill_<?php echo $i; ?>" id="lifestyle_skill_<?php echo $i; ?>" multiple class="form-control">
					<option value="null"
					<?php if ((isset($tank) && $tank->getLifestyle_skills()["skill_" . $i] == "null") || !isset($tank)) echo 'selected="selected"'; ?>
					>(empty)</option>
					<option value="artistry"
					<?php if (isset($tank) && $tank->getLifestyle_skills()["skill_" . $i] == "artistry") echo 'selected="selected"'; ?>
					>Artistry</option>
					<option value="cooking"
					<?php if (isset($tank) && $tank->getLifestyle_skills()["skill_" . $i] == "cooking") echo 'selected="selected"'; ?>
					>Cooking</option>
					<option value="crafting"
					<?php if (isset($tank) && $tank->getLifestyle_skills()["skill_" . $i] == "crafting") echo 'selected="selected"'; ?>
					>Crafting</option>
					<option value="nursing"
					<?php if (isset($tank) && $tank->getLifestyle_skills()["skill_" . $i] == "nursing") echo 'selected="selected"'; ?>
					>Nursing</option>
					<option value="performing"
					<?php if (isset($tank) && $tank->getLifestyle_skills()["skill_" . $i] == "performing") echo 'selected="selected"'; ?>
					>Performing</option>
					<option value="sports"
					<?php if (isset($tank) && $tank->getLifestyle_skills()["skill_" . $i] == "sports") echo 'selected="selected"'; ?>
					>Sports</option>
				</select>
			</div>

			<label for="lifestyle_skill_<?php echo $i; ?>_level" class="col-sm-2 col-lg-1 control-label">Level :</label>
			<div class="col-sm-2 col-lg-1">
				<input type="number" name="lifestyle_skill_<?php echo $i; ?>_level" id="lifestyle_skill_<?php echo $i; ?>_level" min="0" max="3" step="1" class="form-control"
				value="<?php if (isset($tank)) echo $tank->getLifestyle_skills()["skill_" . $i . "_level"]; else echo "0"; ?>"
				/>
			</div>
		</div>
		<?php
	}
	?>
</fieldset>