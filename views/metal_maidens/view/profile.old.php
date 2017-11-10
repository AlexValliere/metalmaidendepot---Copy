<div class="col-xs-12 col-sm-3 col-lg-2">
	<img
		src="<?php echo TANKS_DIR . "portrait/" . $view_tank->getImagename(); ?>.png"
		alt="<?php echo $view_tank->getTank(); ?> portrait"
	/>
	<h4><?php echo $view_tank->getTank(); ?></h4>
	<p><?php echo $view_tank->getName(); ?></p>
</div>

<div class="col-xs-12 col-sm-3 col-lg-2">
	<p>
		<strong>Category :</strong>
		<img
			src="<?php echo TANK_CATEGORIES_DIR . $view_tank->getCategory(); ?>.png"
			alt="<?php echo $view_tank->getCategory(); ?> icon"
			class="icon-size-2"
		/>
	</p>
	<p><strong>Rarity :</strong> <span class="<?php echo $view_tank->getRarity(); ?>_rarity_text"><?php echo ucfirst($view_tank->getRarity()); ?></span></p>
	<p>
		<strong>Nation :</strong>
		<img
			src="<?php echo NATIONAL_FLAGS_DIR . $view_tank->getNation(); ?>.png"
			alt="<?php echo $view_tank->getNation(); ?>'s national flag"
			class="icon-size-3"
		/>
		<?php echo ucfirst($view_tank->getNation()); ?>
	</p>
	<p><strong>Character voice :</strong> <?php echo $view_tank->getCharacter_voice(); ?></p>
	<p><strong>Live2D :</strong> <?php echo ($view_tank->getLive2d() == "1" ? "Available" : "Not available"); ?></p>
	<p>
		<strong>Max rank :</strong>
		<img
			src="<?php echo TANK_ATTRIBUTES_DIR . "tech_" . $pw_tank_rarities[$view_tank->getRarity()] . ".png"; ?>"
			alt="Rank icon"
			class="icon-size-3"
		/>
	</p>
	<p>
		<strong>Armor :</strong>
		<?php
		if ($view_tank->getCategory() != "" && array_key_exists($view_tank->getCategory(), $pw_tank_armor_by_categories))
		{
			?>
			<img
				src="<?php echo TANK_ATTRIBUTES_DIR . $pw_tank_armor_by_categories[$view_tank->getCategory()] . '_armor.png'; ?>"
				alt="<?php echo $pw_tank_armor_by_categories[$view_tank->getCategory()]; ?> armor's icon"
				class="icon-size-2"
			/>
			<?php
		}
		?>
		<?php echo ucfirst($pw_tank_armor_by_categories[$view_tank->getCategory()]); ?>
	</p>
</div>