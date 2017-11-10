<div class="form-group">
	<label for="armor_name" class="col-sm-2 col-sm-offset-3 control-label">Name :</label>
	<div class="col-sm-3 col-lg-2">
		<input type="text" name="armor_name" id="armor_name" placeholder="Ex : Light Rolled Riveted Armor" class="form-control"
		<?php if (isset($armor)) echo 'value="' . $armor->getName() . '"'; ?>
		/>
	</div>
</div>

<div class="form-group">
	<label for="armor_category" class="col-sm-2 col-sm-offset-3 control-label">Category :</label>
	<div class="col-sm-3 col-lg-2">
		<select name="armor_category" id="armor_category" multiple class="form-control">
			<option value="heavy"
			<?php if (isset($armor) && $armor->getCategory() == "heavy") echo 'selected="selected"'; ?>
			>Heavy</option>
			<option value="light"
			<?php if (isset($armor) && $armor->getCategory() == "light") echo 'selected="selected"'; ?>
			>Light</option>
			<option value="standard"
			<?php if (isset($armor) && $armor->getCategory() == "standard") echo 'selected="selected"'; ?>
			>Standard</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label for="armor_tier" class="col-sm-2 col-sm-offset-3 control-label">Tier :</label>
	<div class="col-sm-3 col-lg-2">
		<select name="armor_tier" id="armor_tier" multiple class="form-control">
			<option value="1"
			<?php if (isset($armor) && $armor->getTier() == "1") echo 'selected="selected"'; ?>
			>1</option>
			<option value="2"
			<?php if (isset($armor) && $armor->getTier() == "2") echo 'selected="selected"'; ?>
			>2</option>
			<option value="3"
			<?php if (isset($armor) && $armor->getTier() == "3") echo 'selected="selected"'; ?>
			>3</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label for="armor_level" class="col-sm-2 col-sm-offset-3 control-label">Level :</label>
	<div class="col-sm-3 col-lg-2">
		<select name="armor_level" id="armor_level" multiple class="form-control">
			<option value="1"
			<?php if (isset($armor) && $armor->getLevel() == "1") echo 'selected="selected"'; ?>
			>1</option>
			<option value="2"
			<?php if (isset($armor) && $armor->getLevel() == "2") echo 'selected="selected"'; ?>
			>2</option>
			<option value="3"
			<?php if (isset($armor) && $armor->getLevel() == "3") echo 'selected="selected"'; ?>
			>3</option>
			<option value="4"
			<?php if (isset($armor) && $armor->getLevel() == "4") echo 'selected="selected"'; ?>
			>4</option>
			<option value="5"
			<?php if (isset($armor) && $armor->getLevel() == "5") echo 'selected="selected"'; ?>
			>5</option>
			<option value="6"
			<?php if (isset($armor) && $armor->getLevel() == "6") echo 'selected="selected"'; ?>
			>6</option>
		</select>
	</div>
</div>

<?php
$attributes_array = ["armor", "durability", "evasion", "stealth", "targeting"];

foreach ($attributes_array as $attribute_value)
{
	?>
<div class="form-group">
	<label for="armor_<?php echo $attribute_value; ?>" class="col-sm-2 col-sm-offset-3 control-label"><?php echo ucfirst($attribute_value); ?> :</label>
	<div class="col-sm-3 col-lg-2">
		<input type="number" name="armor_<?php echo $attribute_value; ?>" id="armor_<?php echo $attribute_value; ?>" min="0" max="9999" step="1" class="form-control"
		value="<?php if (isset($armor)) echo $armor->{'get'.ucfirst($attribute_value)}(); else echo "0"; ?>"
		/>
	</div>
</div>
	<?php
}
?>

<div class="form-group">
	<div class="col-sm-10 col-sm-offset-2 col-lg-6 col-lg-offset-3">
		<p>Armor properties :</p>
		<div class="row">
			<?php
			$properties_array = ["cast", "composite", "hardened", "riveted", "spaced", "tempered", "wedge", "welded"];

			foreach ($properties_array as $property_value)
			{
				?>
				<div class="col-sm-3">
					<label class="checkbox-inline">
						<input
							type="checkbox"
							name="<?php echo "armor_" . $property_value; ?>"
							id="<?php echo "armor_" . $property_value; ?>"
							<?php
							if (isset($armor) && $armor->{'get'.ucfirst($property_value)}() == 1)
								echo 'checked="checked"';
							?>
						/>
						<?php echo ucfirst($property_value); ?>
					</label>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>