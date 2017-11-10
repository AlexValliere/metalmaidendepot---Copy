<div class="form-group">
	<label for="name" class="col-sm-2 col-sm-offset-3 control-label">Name :</label>
	<div class="col-sm-3 col-lg-2">
		<input type="text" name="name" id="name" placeholder="Ex : Tactics Customization" class="form-control"
		<?php if (isset($passive_skill)) echo 'value="' . $passive_skill->getName() . '"'; ?>
		/>
	</div>
</div>


<div class="form-group">
	<label for="bonus_value_1" class="col-sm-2 col-sm-offset-0 control-label">Base bonus 1 :</label>
	<div class="col-sm-2 col-lg-1">
		<input type="number" name="bonus_value_1" id="bonus_value_1" min="0" max="9999" step="1" class="form-control"
		value="<?php if (isset($passive_skill)) echo $passive_skill->getBonus_value_1(); else echo "0"; ?>" />
	</div>

	<label for="bonus_mult_1" class="col-sm-2 col-sm-offset-0 control-label">Bonus multiplier 1 :</label>
	<div class="col-sm-2 col-lg-1">
		<input type="number" name="bonus_mult_1" id="bonus_mult_1" min="0" max="9999" step="1" class="form-control"
		value="<?php if (isset($passive_skill)) echo $passive_skill->getBonus_mult_1(); else echo "0"; ?>" />
	</div>

	<label for="malus_eqpt_value_1" class="col-sm-2 col-sm-offset-0 control-label">Malus equipment 1 :</label>
	<div class="col-sm-2 col-lg-1">
		<input type="number" name="malus_eqpt_value_1" id="malus_eqpt_value_1" min="0" max="9999" step="1" class="form-control"
		value="<?php if (isset($passive_skill)) echo $passive_skill->getMalus_eqpt_value_1(); else echo "0"; ?>" />
	</div>
</div>

<div class="form-group">
	<label for="bonus_value_1" class="col-sm-2 col-sm-offset-0 control-label">Base bonus 2 :</label>
	<div class="col-sm-2 col-lg-1">
		<input type="number" name="bonus_value_2" id="bonus_value_2" min="0" max="9999" step="1" class="form-control"
		value="<?php if (isset($passive_skill)) echo $passive_skill->getBonus_value_2(); else echo "0"; ?>" />
	</div>

	<label for="bonus_mult_1" class="col-sm-2 col-sm-offset-0 control-label">Bonus multiplier 2 :</label>
	<div class="col-sm-2 col-lg-1">
		<input type="number" name="bonus_mult_2" id="bonus_mult_2" min="0" max="9999" step="1" class="form-control"
		value="<?php if (isset($passive_skill)) echo $passive_skill->getBonus_mult_2(); else echo "0"; ?>" />
	</div>

	<label for="malus_eqpt_value_2" class="col-sm-2 col-sm-offset-0 control-label">Malus equipment 2 :</label>
	<div class="col-sm-2 col-lg-1">
		<input type="number" name="malus_eqpt_value_2" id="malus_eqpt_value_2" min="0" max="9999" step="1" class="form-control"
		value="<?php if (isset($passive_skill)) echo $passive_skill->getMalus_eqpt_value_2(); else echo "0"; ?>" />
	</div>
</div>

<?php
for ($i = 1; $i <= 2; $i++)
{
	?>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2 col-lg-6 col-lg-offset-3">
			<p>Affected attributes <?php echo $i; ?> :</p>
			<div class="row">
				<?php
				$attributes_array = ["firepower", "penetration", "targeting", "durability", "armor", "evasion", "stealth", "detection"];

				foreach ($attributes_array as $attribute_value)
				{
					?>
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input
								type="checkbox"
								name="<?php echo "passive_skill_" . $attribute_value . $i; ?>"
								id="<?php echo "passive_skill_" . $attribute_value . $i; ?>"
								<?php
								if (isset($passive_skill) && $passive_skill->{'getUpdated_'.ucfirst($attribute_value)."_".$i}() == 1)
									echo 'checked="checked"';
								?>
							/>
							<?php echo ucfirst($attribute_value); ?>
						</label>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}
?>