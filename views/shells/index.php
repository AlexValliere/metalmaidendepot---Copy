<section class="view_shells">

	<?php
	foreach ($shell_categories as $shell_category_key => $shell_category_value)
	{
		if ($shell_category_key == $view_category)
			echo '<div class="filter_icon selected">';
		else
			echo '<div class="filter_icon">';

		echo '<a href="'.link_to_route("shells").'&amp;category='.$shell_category_key.'">';

		if ($shell_category_key != "all")
			echo '<img src="'.SHELLS_DIR.strtolower($shell_category_key).'/'.$shell_category_value.'_icon.png" alt="'.$shell_category_value.' icon" class="filter_icon">';
		else
			echo '<span style="border: 1px solid white; display: inline-block; line-height: 50px; width: 50px; text-align: center; color: white;">ALL</span>';

		echo '</a>';
		echo '</div>';
	}
	?>

	<br />

	<section class="hidden-lg">
		<hr />
		<div class="row">
			<div class="col-xs-12">Modifiers legend :</div>
			<br />
			<?php
			foreach (array_values($shell_modifiers_ids) as $shell_modifier_id)
			{
				$shell_modifier_id--;
				echo '<div class="col-lg-4 col-sm-6 col-xs-12">';
				echo '<img src="'. SHELLS_DIR . 'modifiers/' . $shell_modifiers[$shell_modifier_id]["icon_file_name"] . '" alt="' . $shell_modifiers[$shell_modifier_id]["description"] . '" title="' . $shell_modifiers[$shell_modifier_id]["description"] . '" /> ';
				echo $shell_modifiers[$shell_modifier_id]["description"];
				echo '</div>';
			}
			?>
		</div>
		<hr />
		<div class="row">
			<div class="col-xs-12">Properties legend :</div>
			<br />
			<?php
			foreach (array_values($shell_properties_ids) as $shell_property_id)
			{
				$shell_property_id--;
				echo '<div class="col-lg-4 col-sm-6 col-xs-12">';
				echo '<img src="'. SHELLS_DIR . 'properties/' . $shell_properties[$shell_property_id]["icon_file_name"] . '" alt="' . $shell_properties[$shell_property_id]["name"] . " : " . $shell_properties[$shell_property_id]["description"] . '" title="' . $shell_properties[$shell_property_id]["name"] . " : " . $shell_properties[$shell_property_id]["description"] . '" /> ';
				echo $shell_properties[$shell_property_id]["name"] . " : " . $shell_properties[$shell_property_id]["description"];
				echo '</div>';
			}
			?>
		</div>
	</section>

	<br />

	<div class="table-responsive">
		<table class="table table-bordered table-hover table-condensed">
		<tr>
			<?php
			foreach ($sortableValues as $key)
			{
				?>
				<th class="dark">
					<?php echo ucfirst($key); ?>
					<br />
					<a href="<?php echo link_to_route("shells") . "&amp;category=" . $view_category . "&amp;sort=" . $key . "&amp;order=asc"; ?>" <?php if ($sort == $key && $order == "asc") echo 'class="glyphicon_active"'; ?>>
						<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
					</a>
					<a href="<?php echo link_to_route("shells") . "&amp;category=" . $view_category . "&amp;sort=" . $key . "&amp;order=desc"; ?>" <?php if ($sort == $key && $order == "desc") echo 'class="glyphicon_active"'; ?>>
						<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
					</a>
				</th>
				<?php
				if ($key == "id") echo '<th class="dark">Icon</th>';
				if ($key == "id" && $view_category == "all") echo '<th class="dark">Category</th>';
				if ($key == "name") echo '<th class="dark">Modifier</th><th class="dark">Property</th>';
				if ($key == "tier") echo '<th class="dark">Level</th>';
			}

			if (isset($current_user) && $current_user != NULL && ($current_user->has_roles("contributors")))
			{
				echo '<th class="dark">Actions</th>';
			}
			?>
		</tr>
		<?php
		$i = 0;
		foreach ($shells as $shell)
		{
			++$i;

			if ($i % 15 == 0)
			{
				?>
				<tr>
					<?php
					foreach ($sortableValues as $key)
					{
						?>
						<th class="dark">
							<?php echo ucfirst($key); ?>
						</th>
						<?php
						if ($key == "id") echo '<th class="dark">Icon</th>';
						if ($key == "id" && $view_category == "all") echo '<th class="dark">Category</th>';
						if ($key == "name") echo '<th class="dark">Modifier</th><th class="dark">Property</th>';
						if ($key == "tier") echo '<th class="dark">Level</th>';
					}

					if (isset($current_user) && $current_user != NULL && ($current_user->has_roles("contributors")))
					{
						echo '<th class="dark">Actions</th>';
					}
					?>
				</tr>
				<?php
			}

			echo '<tr>';
			echo '<td>'.$shell->getId().'</td>';

			if ($shell->getTier() != NULL)
				echo '<td><img src="'.strtolower(SHELLS_DIR.$shell->getCategory()).'/tech_'.$shell->getTier().'/'.$shell->getName().'_icon.png" alt="'.$shell->getName().' icon" style="max-height: 35px;"></td>';
			else
				echo '<td><img src="'.strtolower(SHELLS_DIR.$shell->getCategory()).'/'.$shell->getName().'_icon.png" alt="'.$shell->getName().' icon" style="max-height: 40px;"></td>';
			if ($view_category == "all")
				echo '<td>' . $shell->getCategory() . '</td>';
			echo '<td>'.$shell->getName().'</td>';
			echo '<td>';
			foreach ($shell->getShell_modifiers_ids() as $shell_modifier_id)
			{
				$shell_modifier_id--;
				echo '<img src="'. SHELLS_DIR . 'modifiers/' . $shell_modifiers[$shell_modifier_id]["icon_file_name"] . '" alt="' . $shell_modifiers[$shell_modifier_id]["description"] . '" title="' . $shell_modifiers[$shell_modifier_id]["description"] . '" style="max-height: 35px;" /> ';
				echo "<span class='hidden-xs hidden-sm hidden-md'>" . $shell_modifiers[$shell_modifier_id]["description"] . "</span><br />";
			}
			echo '</td>';
			echo '<td>';
			foreach ($shell->getShell_properties_ids() as $shell_property_id)
			{
				$shell_property_id--;
				echo '<img src="'. SHELLS_DIR . 'properties/' . $shell_properties[$shell_property_id]["icon_file_name"] . '" alt="' . $shell_properties[$shell_property_id]["name"] . " : " . $shell_properties[$shell_property_id]["description"] . '" title="' . $shell_properties[$shell_property_id]["name"] . " : " . $shell_properties[$shell_property_id]["description"] . '" style="max-height: 35px;" /> ';
				echo "<span class='hidden-xs hidden-sm hidden-md'>" . $shell_properties[$shell_property_id]["name"] . " : " . $shell_properties[$shell_property_id]["description"] . "</span><br />";
			}
			echo '</td>';
			echo '<td>'.$shell->getTier().'</td>';
			echo '<td>'.$shell->getLevel().'</td>';
			echo '<td>'.$shell->getFirepower().'</td>';
			echo '<td>'.$shell->getPenetration().'</td>';
			echo '<td>'.$shell->getTargeting().'</td>';
			echo '<td>'.$shell->getEvasion().'</td>';
			echo '<td>'.$shell->getStealth().'</td>';
			if (isset($current_user) && $current_user != NULL && ($current_user->has_roles("contributors")))
			{
				echo '<td>';
				echo '<a href="' . link_to_route("edit_shell") . '&amp;shell_id=' . $shell->getId() . '">';
				echo '<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>';
				echo '</a>';
				echo '</td>';
			}
			echo '</tr>';
		}
		?>
		</table>
	</div>
</section>