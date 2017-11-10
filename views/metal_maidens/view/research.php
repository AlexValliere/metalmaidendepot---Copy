<div class="col-lg-4">
	<p><strong>Is used to research :</strong></p>
	<?php
	foreach ($view_tank_rd as $tank)
	{
		?>
		<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $tank->getTank_slug(); ?>" style="text-decoration: none;">
			<div class="research_sub_block">
				<div class="tank_portrait">
					<img
						src="<?php echo TANKS_DIR . "portrait/" . $tank->getImagename(); ?>.png"
						alt="<?php echo $tank->getTank(); ?> portrait"
						class="img-responsive tank_portrait"
					/>
					<img
						src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $tank->getMax_rank() . ".png"; ?>"
						alt="Tech rank"
						class="tech"
					/>
				</div>
				<p>
					<small class="<?php echo $tank->getRarity(); ?>_rarity_text"><?php echo $tank->getTank(); ?></small>
					<br />
					
				</p>
			</div>
		</a>
		<?php
	}
	if (empty($view_tank_rd))
		echo "<p>Nothing</p>";
	?>
</div>