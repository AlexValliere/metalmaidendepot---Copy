<ol class="breadcrumb">
	<?php
	if (get_route() == "home")				echo '<li>Home</li>';
	else									echo '<li><a href="' . link_to_route("home") . '">Home</a></li>';

	if (get_route() == "metal_maiden" || get_route() == "metal_maiden_live2d" || get_route() == "metal_maiden_tree" || get_route() == "edit_metal_maiden_armors" || get_route() == "edit_metal_maiden_chassis" || get_route() == "edit_metal_maiden_engines" || get_route() == "edit_metal_maiden_shells")
	{
		echo '<li><a href="' . link_to_route("metal_maiden") . '&amp;tank=' . $tank_parameter->getTank_slug() . '">' . $tank_parameter->getTank() . '</a></li>';
	}

	if (get_route() == "armors" || get_route() == "engines" || get_route() == "shells" || get_route() == "tank_sheet" || get_route() == "chassis")
	{
		echo '<li><a href="' . link_to_route("sheets_index") . '">Sheets index</a></li>';
	}

	if (get_route() == "metal_maiden")		echo '<li>View tank profile</li>';
	else if (get_route() == "metal_maiden_live2d")	echo '<li>View Live2D tank</li>';
	else if (get_route() == "metal_maiden_tree")	echo '<li>View tank tree</li>';
	else if (get_route() == "edit_metal_maiden_armors")	echo '<li>Update armors</li>';
	else if (get_route() == "edit_metal_maiden_chassis")	echo '<li>Update chassis</li>';
	else if (get_route() == "edit_metal_maiden_engines")	echo '<li>Update engines</li>';
	else if (get_route() == "edit_metal_maiden_shells")	echo '<li>Update shells</li>';
	else if (get_route() == "terrains")		echo '<li>Terrains</li>';
	else if (get_route() == "help_mmd")		echo '<li>Help Metal Maiden Depot</li>';
	else if (get_route() == "sheets_index")	echo '<li>Sheets index</li>';
	else if (get_route() == "armors")		echo '<li>Armors sheet</li>';
	else if (get_route() == "chassis")		echo '<li>Chassis sheet</li>';
	else if (get_route() == "engines")		echo '<li>Engines sheet</li>';
	else if (get_route() == "shells")		echo '<li>Shells sheet</li>';
	else if (get_route() == "tank_sheet")	echo '<li>Tanks sheet</li>';
	else if (get_route() == "advanced_search")		echo '<li>Advanced search</li>';
	else if (get_route() == "search")		echo '<li>Search</li>';
	else if (get_route() == "changelog")	echo '<li>Changelog</li>';
	else if (get_route() == "statistics")
	{
		if (isset($_GET["category"]))
		{
			if (in_array(strtolower($_GET["category"]), $pw_tank_categories))
				echo '<li><a href="index.php?route=statistics">Statistics</a></li><li>' . strtoupper(htmlentities($_GET["category"])) . '</li>';
			else
				echo '<li><a href="index.php?route=statistics">Statistics</a></li><li>ATG</li>';
		}
		else
			echo '<li>Statistics</li>';
	}
	?>
</ol>