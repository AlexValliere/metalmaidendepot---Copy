<section class="edit_metal_maiden">
<?php
if (isset($shell) && $method != 'POST')
{
	?>
	<form class="form-horizontal" action="<?php echo link_to_route("edit_shell"); ?>" method="post" enctype="multipart/form-data">

		<input type="hidden" name="edit_shell" value="<?php echo $shell->getId(); ?>" />

		<div class="form-group">
			<label for="shell_category" class="col-sm-2 col-sm-offset-3 control-label">Category :</label>
			<div class="col-sm-3 col-lg-2">
				<select name="shell_category" id="shell_category" multiple class="form-control">
					<option value="AP"
					<?php if (isset($shell) && $shell->getCategory() == "AP") echo 'selected="selected"'; ?>
					>AP</option>
					<option value="APCR"
					<?php if (isset($shell) && $shell->getCategory() == "APCR") echo 'selected="selected"'; ?>
					>APCR</option>
					<option value="APDS"
					<?php if (isset($shell) && $shell->getCategory() == "APDS") echo 'selected="selected"'; ?>
					>APDS</option>
					<option value="HE"
					<?php if (isset($shell) && $shell->getCategory() == "HE") echo 'selected="selected"'; ?>
					>HE</option>
					<option value="Heat"
					<?php if (isset($shell) && $shell->getCategory() == "Heat") echo 'selected="selected"'; ?>
					>Heat</option>
					<option value="Hesh"
					<?php if (isset($shell) && $shell->getCategory() == "Hesh") echo 'selected="selected"'; ?>
					>Hesh</option>
					<option value="RP"
					<?php if (isset($shell) && $shell->getCategory() == "RP") echo 'selected="selected"'; ?>
					>RP</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label for="shell_name" class="col-sm-2 col-sm-offset-3 control-label">Name :</label>
			<div class="col-sm-3 col-lg-2">
				<input type="text" name="shell_name" id="shell_name" placeholder="Ex : APBC (S)" maxlength="30" class="form-control"
				<?php if (isset($shell)) echo 'value="' . $shell->getName() . '"'; ?>
				/>
			</div>
		</div>

		<div class="form-group">
			<label for="shell_tier" class="col-sm-2 col-sm-offset-3 control-label">Tier :</label>
			<div class="col-sm-3 col-lg-2">
				<select name="shell_tier" id="shell_tier" multiple class="form-control">
					<option value="1"
					<?php if (isset($shell) && $shell->getTier() == "1") echo 'selected="selected"'; ?>
					>1</option>
					<option value="2"
					<?php if (isset($shell) && $shell->getTier() == "2") echo 'selected="selected"'; ?>
					>2</option>
					<option value="3"
					<?php if (isset($shell) && $shell->getTier() == "3") echo 'selected="selected"'; ?>
					>3</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="shell_level" class="col-sm-2 col-sm-offset-3 control-label">Level :</label>
			<div class="col-sm-3 col-lg-2">
				<select name="shell_level" id="shell_level" multiple class="form-control">
					<option value="1"
					<?php if (isset($shell) && $shell->getLevel() == "1") echo 'selected="selected"'; ?>
					>1</option>
					<option value="2"
					<?php if (isset($shell) && $shell->getLevel() == "2") echo 'selected="selected"'; ?>
					>2</option>
					<option value="3"
					<?php if (isset($shell) && $shell->getLevel() == "3") echo 'selected="selected"'; ?>
					>3</option>
					<option value="4"
					<?php if (isset($shell) && $shell->getLevel() == "4") echo 'selected="selected"'; ?>
					>4</option>
					<option value="5"
					<?php if (isset($shell) && $shell->getLevel() == "5") echo 'selected="selected"'; ?>
					>5</option>
					<option value="6"
					<?php if (isset($shell) && $shell->getLevel() == "6") echo 'selected="selected"'; ?>
					>6</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="shell_firepower" class="col-sm-2 col-sm-offset-3 control-label">Firepower :</label>
			<div class="col-sm-3 col-lg-2">
				<input type="number" name="shell_firepower" id="shell_firepower" min="0" max="9999" step="1" class="form-control"
				value="<?php if (isset($shell)) echo $shell->getFirepower(); else echo "0"; ?>"
				/>
			</div>
		</div>

		<div class="form-group">
			<label for="shell_penetration" class="col-sm-2 col-sm-offset-3 control-label">Penetration :</label>
			<div class="col-sm-3 col-lg-2">
				<input type="number" name="shell_penetration" id="shell_penetration" min="0" max="9999" step="1" class="form-control"
				value="<?php if (isset($shell)) echo $shell->getPenetration(); else echo "0"; ?>"
				/>
			</div>
		</div>

		<div class="form-group">
			<label for="shell_targeting" class="col-sm-2 col-sm-offset-3 control-label">Targeting :</label>
			<div class="col-sm-3 col-lg-2">
				<input type="number" name="shell_targeting" id="shell_targeting" min="0" max="9999" step="1" class="form-control"
				value="<?php if (isset($shell)) echo $shell->getTargeting(); else echo "0"; ?>"
				/>
			</div>
		</div>

		<div class="form-group">
			<label for="shell_evasion" class="col-sm-2 col-sm-offset-3 control-label">Evasion :</label>
			<div class="col-sm-3 col-lg-2">
				<input type="number" name="shell_evasion" id="shell_evasion" min="0" max="9999" step="1" class="form-control"
				value="<?php if (isset($shell)) echo $shell->getEvasion(); else echo "0"; ?>"
				/>
			</div>
		</div>

		<div class="form-group">
			<label for="shell_stealth" class="col-sm-2 col-sm-offset-3 control-label">Stealth :</label>
			<div class="col-sm-3 col-lg-2">
				<input type="number" name="shell_stealth" id="shell_stealth" min="0" max="9999" step="1" class="form-control"
				value="<?php if (isset($shell)) echo $shell->getStealth(); else echo "0"; ?>"
				/>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<button type="submit" class="btn btn-primary">Update shell</button>
			</div>
		</div>
	</form>
	<?php
}
?>
</section>