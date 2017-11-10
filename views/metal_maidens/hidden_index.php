<section class="metal_maidens_index">
	<h1 class="page-header">Hidden metal maidens list</h1>

	<div class="row">
		<div class="col-lg-2">
			<p>
				Indexed tanks : <a href="<?php echo link_to_route("home"); ?>"><?php echo $tanks_indexed; ?></a> out of <?php echo $pw_tanks_indexed; ?>
				<br />
				<a href="<?php echo link_to_route("hidden_index"); ?>">[ + <?php echo $hidden_tanks_indexed; ?> hidden(s) ]</a>
			</p>
		</div>
		<div class="col-xs-12 col-sm-12 col-lg-8">
			<p>Go to : </p>
			<?php
			foreach ($pw_nations as $nation)
			{
				?>
				<a href="<?php echo "#" . $nation; ?>"><img src="<?php echo NATIONAL_FLAGS_DIR . $nation . ".png"; ?>" alt="<?php echo $nation; ?> national flag" /></a>
				<?php
			}
			?>
		</div>
	</div>

	<?php
	foreach ($pw_nations as $nation)
	{
		?>
		<span class="anchor" id="<?php echo $nation; ?>"></span>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1 nation_title">
				<img
					src="<?php echo NATIONAL_FLAGS_DIR . $nation . ".png"; ?>"
					alt="<?php echo $nation; ?> national flag"
				/>
				<?php echo ucfirst($nation); ?>
				<img
					src="<?php echo NATIONAL_FLAGS_DIR . $nation . ".png"; ?>"
					alt="<?php echo $nation; ?> national flag"
				/>
			</div>
		</div>
		<?php
		echo '<div class="row">';
		foreach ($pw_tank_categories as $category => $value)
		{
			?>
			<div class="col-xs-12 col-lg-10 col-lg-offset-1 category-block <?php echo $category; ?>">
				<div class="row">
					<div class="col-xs-12 col-lg-12 category-icon">
						<img
							src="<?php echo TANK_CATEGORIES_DIR . $category; ?>.png"
							alt="<?php echo $category; ?> icon"
							class="category-icon"
						/>
					</div>
					<?php

					$metal_maidens_array = $metalMaidensManager->get_from_columns(["category" => $category, "nation" => $nation]);

					foreach ($metal_maidens_array as $metal_maiden)
					{
						if ( $metal_maiden->getHidden() == 1 )
						{
							?>
							<div class="col-xs-6 col-sm-3 col-lg-2 metal_maiden_block" id="<?php echo $nation . " " . $category; ?>">
								<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $metal_maiden->getTank_slug(); ?>">
									<img
										src="<?php echo TANKS_DIR . "portrait/" . $metal_maiden->getImagename(); ?>.png"
										alt="<?php echo $metal_maiden->getTank(); ?> portrait"
										class="portrait <?php echo $metal_maiden->getRarity(); ?>_rarity_border"
									/>
									<br />
									<p class="<?php echo $nation . " " . $category . " " . $metal_maiden->getRarity(); ?>">
										N<?php echo $metal_maiden->getBlueprint_rank(); ?> <?php echo $metal_maiden->getTank(); ?>
									</p>
								</a>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		<?php
		}
		echo "</div><br />";
	}
	?>
</section>