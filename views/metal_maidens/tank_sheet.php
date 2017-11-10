<section class="tank_sheet">
	<table class="table table-bordered">
	<tr>
		<td colspan="4">Main resource for promotion/R&amp;D</td>
	</tr>
	<tr>
		<td><span style='background-color: grey;'>&nbsp;P&nbsp;</span> Processor</td>
		<td><span style='background-color: green;'>&nbsp;S&nbsp;</span> Secret Plan</td>
		<td><span style='background-color: #ffdab9; color: black;'>&nbsp;T&nbsp;</span> Test doll</td>
		<td><span style='background-color: #cd853f;'>&nbsp;W&nbsp;</span> Wreck</td>
	</tr>
	</table>

	<div class="row">
		<div class="col-lg-1">
			Sort options :
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered table-condensed">
			<tr>
				<?php
				foreach ($sortableValues as $key)
				{
					?>
					<th <?php if ($key == "tank") echo 'colspan="2"'; ?>>
						<?php echo str_replace("_", " ", ucfirst($key)); ?>
						<a href="<?php echo link_to_route("tank_sheet") . "&amp;sort=" . $key . "&amp;order=asc"; ?>" <?php if ($sort == $key && $order == "asc") echo 'class="glyphicon_active"'; ?>>
							<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
						</a>
						<a href="<?php echo link_to_route("tank_sheet") . "&amp;sort=" . $key . "&amp;order=desc"; ?>" <?php if ($sort == $key && $order == "desc") echo 'class="glyphicon_active"'; ?>>
							<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
						</a>
					</th>
					<?php
				}
				?>
			</tr>
			<?php
			foreach ($tank_list as $tank)
			{
				?>
				<tr>
					<td><?php $tank->print_main_resource_icon(); ?></td>
					<td><a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $tank->getTank_slug(); ?>" class="<?php echo $tank->getRarity(); ?>_rarity_text"><?php echo $tank->getTank(); ?></a></td>
					<td style="text-align: center;"><?php echo ucfirst($tank->getRarity()); ?></td>
					<td style="text-align: center;"><?php echo ucfirst($tank->getBlueprint_rank()); ?></td>
					<td style="text-align: center;"><img src="<?php echo TANK_CATEGORIES_DIR . $tank->getCategory(); ?>.png" alt="<?php echo $tank->getCategory(); ?> icon" class="current_category_icon" /></td>
					<td><?php echo $tank->getFirepower(); ?></td>
					<td><?php echo $tank->getPenetration(); ?></td>
					<td><?php echo $tank->getTargeting(); ?></td>
					<td><?php echo $tank->getDurability(); ?></td>
					<td><?php echo $tank->getArmor(); ?></td>
					<td><?php echo $tank->getEvasion(); ?></td>
					<td><?php echo $tank->getStealth(); ?></td>
					<td><?php echo $tank->getDetection(); ?></td>
				</tr>
				<?php
			}
			?>
		</table>
	</div>
</section>