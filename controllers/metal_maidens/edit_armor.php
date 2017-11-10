<?php
$method = $_SERVER['REQUEST_METHOD'];
$metalMaidensManager = new MetalMaidensManager($dbhandler);
$armorsManager = new ArmorsManager($dbhandler);

if (isset($_GET['tank']))
{
	$tank = $metalMaidensManager->get_by_tank_slug($_GET['tank']);
	$armor_ids = $metalMaidensManager->get_attached_armors($tank);
	$armors = [];

	foreach (array_keys($armor_ids) as $armor_id)
	{
		$armors[] = $armorsManager->get($armor_id);
	}
}

if ($method == 'POST' && isset($_POST["edit_tank"]))
{
	$edit_tank = $metalMaidensManager->get_by_tank_slug($_POST["edit_tank"]);

	if (isset($_POST["update_armor"]) && $_POST["update_armor"] == "1")
	{
		$current_armor_ids = $edit_tank->getArmor_ids();
		$new_armor_ids = (isset($_POST["armor_ids"]) ? $_POST["armor_ids"] : []);

		foreach ($new_armor_ids as $new_armor_id)
		{
			if (!in_array($new_armor_id, $current_armor_ids))
			{
				$metalMaidensManager->attach_armor_to_metal_maiden($edit_tank, $new_armor_id);
			}
		}

		foreach ($current_armor_ids as $current_armor_id)
		{
			if (!in_array($current_armor_id, $new_armor_ids))
			{
				$metalMaidensManager->remove_armor_from_metal_maiden($edit_tank, $current_armor_id);
			}
		}

		redirection(link_to_route("edit_metal_maiden_armors") . "&tank=" . $edit_tank->getTank_slug(), 250);
	}
}
?>