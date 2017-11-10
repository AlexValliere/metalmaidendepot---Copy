<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<h3>Metal maidens with missing illustration</h3>
		<p>Count : <?php echo count($metal_maidens_missing_illustration); ?></p>

		<?php
		foreach ($metal_maidens_missing_illustration as $metal_maiden)
		{
			$filename  = TANKS_DIR . "portrait/" . $metal_maiden->getImagename();
			$filename .= ".png";
			?>
		<div class="col-sm-3"
		style="
			display: inline-block;
			text-align: center;
			margin-bottom: 30px;
		">
			<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $metal_maiden->getTank_slug(); ?>" class="<?php echo $metal_maiden->getRarity(); ?>_rarity_text" style="text-decoration: none;">
				<img
					src="<?php echo $filename; ?>"
					alt="<?php echo $metal_maiden->getTank(); ?>'s illustration"
					style="
						max-height: 100px;
					"
				/>
				<br />
				<?php echo $metal_maiden->getTank(); ?>
				</a>
		</div>
		<?php
		}
		?>
	</div>
</div>