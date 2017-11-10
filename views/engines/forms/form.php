<div class="form-group">
	<label for="engine_name" class="col-sm-2 col-sm-offset-3 control-label">Name :</label>
	<div class="col-sm-3 col-lg-2">
		<input type="text" name="engine_name" id="engine_name" placeholder="Ex : WP HT Engine" class="form-control"
		<?php if (isset($engine)) echo 'value="' . $engine->getName() . '"'; ?>
		/>
	</div>
</div>

<div class="form-group">
	<label for="engine_tier" class="col-sm-2 col-sm-offset-3 control-label">Tier :</label>
	<div class="col-sm-3 col-lg-2">
		<select name="engine_tier" id="engine_tier" multiple class="form-control">
			<option value="1"
			<?php if (isset($engine) && $engine->getTier() == "1") echo 'selected="selected"'; ?>
			>1</option>
			<option value="2"
			<?php if (isset($engine) && $engine->getTier() == "2") echo 'selected="selected"'; ?>
			>2</option>
			<option value="3"
			<?php if (isset($engine) && $engine->getTier() == "3") echo 'selected="selected"'; ?>
			>3</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label for="engine_level" class="col-sm-2 col-sm-offset-3 control-label">Level :</label>
	<div class="col-sm-3 col-lg-2">
		<select name="engine_level" id="engine_level" multiple class="form-control">
			<option value="1"
			<?php if (isset($engine) && $engine->getLevel() == "1") echo 'selected="selected"'; ?>
			>1</option>
			<option value="2"
			<?php if (isset($engine) && $engine->getLevel() == "2") echo 'selected="selected"'; ?>
			>2</option>
			<option value="3"
			<?php if (isset($engine) && $engine->getLevel() == "3") echo 'selected="selected"'; ?>
			>3</option>
			<option value="4"
			<?php if (isset($engine) && $engine->getLevel() == "4") echo 'selected="selected"'; ?>
			>4</option>
			<option value="5"
			<?php if (isset($engine) && $engine->getLevel() == "5") echo 'selected="selected"'; ?>
			>5</option>
			<option value="6"
			<?php if (isset($engine) && $engine->getLevel() == "6") echo 'selected="selected"'; ?>
			>6</option>
		</select>
	</div>
</div>

<?php
$attributes_array = ["detection", "durability", "evasion", "stealth", "targeting"];

foreach ($attributes_array as $attribute_value)
{
	?>
<div class="form-group">
	<label for="engine_<?php echo $attribute_value; ?>" class="col-sm-2 col-sm-offset-3 control-label"><?php echo ucfirst($attribute_value); ?> :</label>
	<div class="col-sm-3 col-lg-2">
		<input type="number" name="engine_<?php echo $attribute_value; ?>" id="engine_<?php echo $attribute_value; ?>" min="0" max="9999" step="1" class="form-control"
		value="<?php if (isset($engine)) echo $engine->{'get'.ucfirst($attribute_value)}(); else echo "0"; ?>"
		/>
	</div>
</div>
	<?php
}
?>

<div class="form-group">
	<div class="col-sm-10 col-sm-offset-2 col-lg-6 col-lg-offset-3">
		<p>Engine properties :</p>
		<div class="row">
			<?php
			foreach (array_keys($pw_engine_description) as $property_value)
			{
				?>
				<div class="col-sm-3">
					<label class="checkbox-inline">
						<input
							type="checkbox"
							name="<?php echo "engine_" . $property_value; ?>"
							id="<?php echo "engine_" . $property_value; ?>"
							<?php
							if (isset($engine) && $engine->{'get'.ucfirst($property_value)}() == 1)
								echo 'checked="checked"';
							?>
						/>
						<?php echo str_replace("_", " ", ucfirst($property_value)); ?>
					</label>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>