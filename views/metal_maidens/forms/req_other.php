<?php
$form_values_array = ["method_1", "method_2", "method_3", "develop", "research"];

foreach($form_values_array as $form_value)
{
	?>
	<fieldset>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
				<legend><?php echo ucfirst(str_replace('_', ' ', $form_value)); ?></legend>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
				<div class="row">
					<?php
					for ($i = 1; $i <= 3; $i++)
					{
						?>
						<div class="col-sm-4">
							<label class="control-label" for="<?php echo $form_value; ?>_tank_<?php echo $i; ?>">Tank <?php echo $i; ?> : </label>
							<select name="<?php echo $form_value; ?>_tank_<?php echo $i; ?>" id="<?php echo $form_value; ?>_tank_<?php echo $i; ?>" class="form-control">
								<option value="" <?php if (!isset($tank)) echo 'selected="selected"'; ?>>(empty)</option>
								<?php
								foreach ($tank_list as $tank_item)
								{
									?>
									<option
										value="<?php echo $tank_item->getId(); ?>"
										<?php
										if (isset($tank) && isset($tank->getRequirements($form_value)["tank_" . $i]) && $tank->getRequirements($form_value)["tank_" . $i] == $tank_item->getId())
											echo 'selected="selected"';
										?>
									><?php echo $tank_item->getTank(); ?></option>
									<?php
								}
								?>
							</select>
						</div>
						<?php
					}
					?>
				</div>

				<div class="row">
					<?php
					for ($i = 1; $i <= 3; $i++)
					{
						?>
						<div class="col-sm-4">
							<label class="control-label" for="<?php echo $form_value; ?>_tank_level_<?php echo $i; ?>">Tank <?php echo $i; ?> level : </label>
							<input type="number" name="<?php echo $form_value; ?>_tank_level_<?php echo $i; ?>" id="<?php echo $form_value; ?>_tank_level_<?php echo $i; ?>" min="0" max="99" step="1" class="form-control"
							value="<?php if (isset($tank) && isset($tank->getRequirements($form_value)["tank_level_" . $i])) echo $tank->getRequirements($form_value)["tank_level_" . $i]; else echo "0"; ?>"
							/>
						</div>
						<?php
					}
					?>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<label class="control-label" for="<?php echo $form_value; ?>_dogtag<?php echo $i; ?>">Dogtag : </label>
						<input type="number" name="<?php echo $form_value; ?>_dogtag" id="<?php echo $form_value; ?>_dogtag" min="0" max="999" step="1" class="form-control"
							value="<?php if (isset($tank) && isset($tank->getRequirements($form_value)["dogtag"])) echo $tank->getRequirements($form_value)["dogtag"]; else echo "0"; ?>"
						/>
					</div>

					<div class="col-sm-4">
						<label class="control-label" for="<?php echo $form_value; ?>_voucher<?php echo $i; ?>">Voucher : </label>
						<input type="number" name="<?php echo $form_value; ?>_voucher" id="<?php echo $form_value; ?>_voucher" min="0" max="999" step="1" class="form-control"
							value="<?php if (isset($tank) && isset($tank->getRequirements($form_value)["voucher"])) echo $tank->getRequirements($form_value)["voucher"]; else echo "0"; ?>"
						/>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<label class="control-label" for="<?php echo $form_value; ?>_resource">Resource : </label>
						<select name="<?php echo $form_value; ?>_resource" id="<?php echo $form_value; ?>_resource" class="form-control">
							<option value="" <?php if (!isset($tank)) echo 'selected="selected"'; ?>>(empty)</option>
							<?php
							foreach ($pw_resources["research"] as $resource)
							{
								if ($resource != "dogtag" && $resource != "voucher")
								{
									?>
									<option
										value="<?php echo $resource; ?>"
										<?php
										if (isset($tank) && isset($tank->getRequirements($form_value)["resource"]) && $tank->getRequirements($form_value)["resource"] == $resource)
											echo 'selected="selected"';
										?>
									><?php echo ucfirst(str_replace('_', ' ', $resource)); ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
					<div class="col-sm-4">
						<label class="control-label" for="<?php echo $form_value; ?>_resource_quantity">Resource quantity :</label>
						<input type="number" name="<?php echo $form_value; ?>_resource_quantity" id="<?php echo $form_value; ?>_resource_quantity" min="0" max="999" step="1" class="form-control"
							value="<?php if (isset($tank) && isset($tank->getRequirements($form_value)["resource_quantity"])) echo $tank->getRequirements($form_value)["resource_quantity"]; else echo "0"; ?>"
						/>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<label class="control-label" for="<?php echo $form_value; ?>_blueprint">Blueprint : </label>
						<select name="<?php echo $form_value; ?>_blueprint" id="<?php echo $form_value; ?>_blueprint" class="form-control">
							<option value="" <?php if (!isset($tank)) echo 'selected="selected"'; ?>>(empty)</option>
							<?php
							foreach ($pw_resources["blueprints"] as $blueprint)
							{
								?>
								<option value="<?php echo $blueprint; ?>"
									<?php
									if (isset($tank) && isset($tank->getRequirements($form_value)["blueprint"]) && $tank->getRequirements($form_value)["blueprint"] == $blueprint)
										echo 'selected="selected"';
									?>
									><?php echo ucfirst(str_replace('_', ' ', $blueprint)); ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div class="col-sm-4">
						<label class="control-label" for="<?php echo $form_value; ?>_blueprint_quantity">Blueprint quantity :</label>
						<input type="number" name="<?php echo $form_value; ?>_blueprint_quantity" id="<?php echo $form_value; ?>_blueprint_quantity" min="0" max="999" step="1" class="form-control"
							value="<?php if (isset($tank) && isset($tank->getRequirements($form_value)["blueprint_quantity"])) echo $tank->getRequirements($form_value)["blueprint_quantity"]; else echo "0"; ?>"
						/>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<label class="control-label" for="<?php echo $form_value; ?>_equipment">Equipment : </label>
						<select name="<?php echo $form_value; ?>_equipment" id="<?php echo $form_value; ?>_equipment" class="form-control">
							<option value="" <?php if (!isset($tank)) echo 'selected="selected"'; ?>>(empty)</option>
							<?php
							foreach ($pw_resources["equipment_by_slot"] as $slot => $equipements)
							{
								echo '<optgroup label=" ' . ucfirst($slot) . ' ">';
								foreach ($equipements as $equipement)
								{
									?>
									<option value="<?php echo $slot . "_" . $equipement; ?>"
										<?php
										if (isset($tank) && isset($tank->getRequirements($form_value)["equipment"]) && $tank->getRequirements($form_value)["equipment"] == $slot . "_" . $equipement)
											echo 'selected="selected"';
										?>
									><?php echo ucfirst(str_replace('_', ' ', $equipement)); ?></option>
									<?php
								}
								echo '</optgroup>';
							}
							?>
						</select>
					</div>
					<div class="col-sm-4">
						<label class="control-label" for="<?php echo $form_value; ?>_equipment_rank">Equipment rank :</label>
						<input type="number" name="<?php echo $form_value; ?>_equipment_rank" id="<?php echo $form_value; ?>_equipment_rank" min="0" max="19" step="1" class="form-control"
							value="<?php if (isset($tank) && isset($tank->getRequirements($form_value)["equipment_rank"])) echo $tank->getRequirements($form_value)["equipment_rank"]; else echo "0"; ?>"
						/>
					</div>
					<div class="col-sm-4">
						<label class="control-label" for="<?php echo $form_value; ?>_equipment_quantity">Equipment quantity :</label>
						<input type="number" name="<?php echo $form_value; ?>_equipment_quantity" id="<?php echo $form_value; ?>_equipment_quantity" min="0" max="999" step="1" class="form-control"
							value="<?php if (isset($tank) && isset($tank->getRequirements($form_value)["equipment_quantity"])) echo $tank->getRequirements($form_value)["equipment_quantity"]; else echo "0"; ?>"
						/>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<label class="control-label" for="<?php echo $form_value; ?>_commander_level<?php echo $i; ?>">Require commander level : </label>
						<input type="number" name="<?php echo $form_value; ?>_commander_level" id="<?php echo $form_value; ?>_commander_level" min="0" max="999" step="1" class="form-control"
							value="<?php if (isset($tank) && isset($tank->getRequirements($form_value)["commander_level"])) echo $tank->getRequirements($form_value)["commander_level"]; else echo "0"; ?>"
						/>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<label class="control-label" for="<?php echo $form_value; ?>_silver<?php echo $i; ?>">Silvers : </label>
						<input type="number" name="<?php echo $form_value; ?>_silver" id="<?php echo $form_value; ?>_silver" min="0" max="999999999" step="1" class="form-control"
							value="<?php if (isset($tank) && isset($tank->getRequirements($form_value)["silver"])) echo $tank->getRequirements($form_value)["silver"]; else echo "0"; ?>"
						/>
					</div>
				</div>
			</div>
		</div>

	</fieldset>
	<?php
}
?>