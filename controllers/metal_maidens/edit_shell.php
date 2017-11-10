<?php
$method = $_SERVER['REQUEST_METHOD'];
$metalMaidensManager = new MetalMaidensManager($dbhandler);
$shellsManager = new ShellsManager($dbhandler);
$shell_modifiers = $shellsManager->get_all_shell_modifiers();
$shell_properties = $shellsManager->get_all_shell_properties();

if (isset($_GET['tank']))
{
	$tank = $metalMaidensManager->get_by_tank_slug($_GET['tank']);
	$shell_ids = $metalMaidensManager->get_attached_shells($tank);
	$shells = [];

	foreach (array_keys($shell_ids) as $shell_id)
	{
		$shells[] = $shellsManager->get($shell_id);
	}

	$shell_properties_ids = [];
	foreach ($shells as $shell) {	$shell_properties_ids = array_merge($shell->getShell_properties_ids(), $shell_properties_ids); }
	$shell_properties_ids = array_unique($shell_properties_ids);

	$shell_modifiers_ids = [];
	foreach ($shells as $shell) {	$shell_modifiers_ids = array_merge($shell->getShell_modifiers_ids(), $shell_modifiers_ids); }
	$shell_modifiers_ids = array_unique($shell_modifiers_ids);
}

if ($method == 'POST' && isset($_POST["edit_tank"]))
{
	$edit_tank = $metalMaidensManager->get_by_tank_slug($_POST["edit_tank"]);

	if (isset($_POST["update_shell"]) && $_POST["update_shell"] == "1")
	{
		$current_shell_ids = $edit_tank->getShell_ids();
		$new_shell_ids = (isset($_POST["shell_ids"]) ? $_POST["shell_ids"] : []);

		foreach ($new_shell_ids as $new_shell_id)
		{
			if (!in_array($new_shell_id, $current_shell_ids))
			{
				$metalMaidensManager->attach_shell_to_metal_maiden($edit_tank, $new_shell_id, $_POST["shell_".$new_shell_id."_range"]);
			}
			else
			{
				$metalMaidensManager->update_shell_range_from_metal_maiden($edit_tank, $new_shell_id, $_POST["shell_".$new_shell_id."_range"]);
			}
		}

		foreach ($current_shell_ids as $current_shell_id)
		{
			if (!in_array($current_shell_id, $new_shell_ids))
			{
				$metalMaidensManager->remove_shell_from_metal_maiden($edit_tank, $current_shell_id);
			}
		}

		if (isset($_POST["ammo_game_version"]) && $edit_tank->getAmmo_game_version() != $_POST["ammo_game_version"])
		{
			$ammo_game_version = $_POST["ammo_game_version"];
			$edit_tank->setAmmo_game_version($ammo_game_version);
			$metalMaidensManager->update($edit_tank);
		}

		redirection(link_to_route("edit_metal_maiden_shells") . "&tank=" . $edit_tank->getTank_slug(), 250);
	}
}
?>