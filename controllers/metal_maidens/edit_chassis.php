<?php
$method = $_SERVER['REQUEST_METHOD'];
$metalMaidensManager = new MetalMaidensManager($dbhandler);
$chassisManager = new ChassisManager($dbhandler);

if (isset($_GET['tank']))
{
	$tank = $metalMaidensManager->get_by_tank_slug($_GET['tank']);
	$chassis_ids = $tank->getChassis_ids();
	$chassis_array = [];

	foreach (array_keys($chassis_ids) as $chassis_id)
	{
		$chassis_array[] = $chassisManager->get($chassis_id);
	}
}

if ($method == 'POST' && isset($_POST["edit_tank"]))
{
	$edit_tank = $metalMaidensManager->get_by_tank_slug($_POST["edit_tank"]);

	if (isset($_POST["update_chassis"]) && $_POST["update_chassis"] == "1")
	{
		$current_chassis_ids = $edit_tank->getChassis_ids();
		$new_chassis_ids = (isset($_POST["chassis_ids"]) ? $_POST["chassis_ids"] : []);

		foreach ($new_chassis_ids as $new_chassis_id)
		{
			if (!in_array($new_chassis_id, $current_chassis_ids))
			{
				$metalMaidensManager->attach_chassis_to_metal_maiden($edit_tank, $new_chassis_id);
			}
		}

		foreach ($current_chassis_ids as $current_chassis_id)
		{
			if (!in_array($current_chassis_id, $new_chassis_ids))
			{
				$metalMaidensManager->remove_chassis_from_metal_maiden($edit_tank, $current_chassis_id);
			}
		}

		redirection(link_to_route("edit_metal_maiden_chassis") . "&tank=" . $edit_tank->getTank_slug(), 250);
	}
}
?>