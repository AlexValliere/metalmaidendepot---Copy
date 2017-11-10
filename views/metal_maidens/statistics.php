<section class="view_tanks_statistics">
	<p>Get statistics about :</p>
	<?php
	foreach(array_keys($pw_tank_categories) as $category)
	{
		?>
		<div class="filter_icon<?php if ($category == $view_category) echo " selected"; ?>">
			<a href="<?php echo link_to_route("statistics") . "&amp;category=" . $category; ?>">
				<img
					src="<?php echo TANK_CATEGORIES_DIR . $category; ?>.png"
					alt="<?php echo $view_category; ?> icon"
					class="img-responsive filter_icon"
				/>
			</a>
		</div>
		<?php
	}
	?>

	<br />

	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<p>Currently displaying statistics on the <?php echo strtoupper($view_category); ?> category.</p>
			<p>Number of tanks in this category : <?php echo $tank_list_size; ?></p>
			
			<br />

			<div class="table-responsive">
				<table class="table table-bordered">
				<tr>
					<th><img src="<?php echo TANK_CATEGORIES_DIR . $view_category; ?>.png" alt="<?php echo $view_category; ?> icon" class="img-responsive current_category_icon" /></th>
					<th colspan="4">Values</th>
				</tr>
				<tr>
					<th>Attributes</th>
					<th>Minimal</th>
					<th>Average</th>
					<th>Median</th>
					<th>Maximal</th>
				</tr>
				<?php
				foreach ($pw_tank_attributes as $attribute)
				{
					?>
				<tr>
					<td><?php echo ucfirst($attribute); ?></td>
					<td><?php echo $min_stats[$attribute]; ?></td>
					<td><?php echo intval($average_stats[$attribute]); ?></td>
					<td><?php echo $median_stats[$attribute]; ?></td>
					<td><?php echo $max_stats[$attribute]; ?></td>
				</tr>
					<?php
				}
				?>
				</table>
			</div>
		</div>
	</div>

	<table class="table table-width-auto">
	<tr>
		<td colspan="4">Main resource for promotion/R&amp;D</td>
	</tr>
	<tr>
		<td><span style='background-color: grey;'>&nbsp;P&nbsp;</span></td>
		<td>Processor</td>
		<td><span style='background-color: green;'>&nbsp;S&nbsp;</span></td>
		<td>Secret Plan</td>
	</tr>
	<tr>
		<td><span style='background-color: #ffdab9; color: black;'>&nbsp;T&nbsp;</span></td>
		<td>Test doll</td>
		<td><span style='background-color: #cd853f;'>&nbsp;W&nbsp;</span></td>
		<td>Wreck</td>
	</tr>
	</table>

	<p>Ranks by attributes :</p>

	<div class="row">
		<?php
		foreach ($pw_tank_attributes as $attribute)
		{
			?>
		<div class="col-sm-6 col-md-4 col-lg-3">
			<table class="table table-bordered statistics">
			<tr>
				<th><img src="<?php echo TANK_CATEGORIES_DIR . $view_category; ?>.png" alt="<?php echo $view_category; ?> icon" class="img-responsive current_category_icon" /></th>
				<th colspan="4"><?php echo ucfirst($attribute); ?></th>
			</tr>
			<tr>
				<th>Rank</th>
				<th colspan="2">Tank</th>
				<th>Value</th>
				<th>Delta Median</th>
			</tr>
			<?php
			$i = 1;
			$last_attribute_value = $tank_list_sorted_by[$attribute][0]->getAttribute($attribute);
			foreach($tank_list_sorted_by[$attribute] as $tank)
			{
				if ($last_attribute_value != $tank->getAttribute($attribute))
				{
					++$i;
				}
				$last_attribute_value = $tank->getAttribute($attribute);
				?>
			<tr>
				<td><?php echo $i; ?></td>
				<td>
					<?php $tank->print_main_resource_icon(); ?>
				</td>
				<td>
					N<?php echo $tank->getBlueprint_rank(); ?>
					<a
						href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $tank->getTank_slug(); ?>"
						class="<?php echo $tank->getRarity(); ?>_rarity_text"
					/>
						<?php echo $tank->getTank(); ?>
					</a>
				</td>
				<td><?php echo $tank->getAttribute($attribute); ?></td>
				<td>
					<?php
					if (intval($tank->getAttribute($attribute) - $median_stats[$attribute]) > 0)
						echo "<span class='positive_value_sign'>+</span> " . intval($tank->getAttribute($attribute) - $median_stats[$attribute]);
					else if (intval($tank->getAttribute($attribute) - $median_stats[$attribute]) < 0)
						echo "<span class='negative_value_sign'>-</span> " . (intval($tank->getAttribute($attribute) - $median_stats[$attribute]) * -1);
					else
						echo "0";
					?>
				</td>
			</tr>
				<?php
			}
			?>
			</table>
		</div>
			<?php
		}
		?>
	</div>
</section>