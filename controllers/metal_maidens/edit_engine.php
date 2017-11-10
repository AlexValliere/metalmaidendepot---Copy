<?php
$method = $_SERVER['REQUEST_METHOD'];
$metalMaidensManager = new MetalMaidensManager($dbhandler);
$enginesManager = new EnginesManager($dbhandler);

if (isset($_GET['tank']))
{
	$tank = $metalMaidensManager->get_by_tank_slug($_GET['tank']);
	$engine_ids = $metalMaidensManager->get_attached_engines($tank);
	$engines = [];

	foreach (array_keys($engine_ids) as $engine_id)
	{
		$engines[] = $enginesManager->get($engine_id);
	}
}

if ($method == 'POST' && isset($_POST["edit_tank"]))
{
	$edit_tank = $metalMaidensManager->get_by_tank_slug($_POST["edit_tank"]);

	if (isset($_POST["update_engine"]) && $_POST["update_engine"] == "1")
	{
		$current_engine_ids = $edit_tank->getEngine_ids();
		$new_engine_ids = (isset($_POST["engine_ids"]) ? $_POST["engine_ids"] : []);

		foreach ($new_engine_ids as $new_engine_id)
		{
			if (!in_array($new_engine_id, $current_engine_ids))
			{
				$metalMaidensManager->attach_engine_to_metal_maiden($edit_tank, $new_engine_id);
			}
		}

		foreach ($current_engine_ids as $current_engine_id)
		{
			if (!in_array($current_engine_id, $new_engine_ids))
			{
				$metalMaidensManager->remove_engine_from_metal_maiden($edit_tank, $current_engine_id);
			}
		}

		redirection(link_to_route("edit_metal_maiden_engines") . "&tank=" . $edit_tank->getTank_slug(), 250);
	}
}
?>