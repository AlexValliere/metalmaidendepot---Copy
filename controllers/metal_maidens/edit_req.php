<?php
$method = $_SERVER['REQUEST_METHOD'];
$metalMaidensManager = new MetalMaidensManager($dbhandler);

if (isset($_GET['tank']))
{
	$tank = $metalMaidensManager->get_by_tank_slug($_GET['tank']);
	$tank_list = $metalMaidensManager->get_all();
}

if ($method == 'POST' && isset($_POST["edit_tank"]))
{
	$metalMaiden = $metalMaidensManager->get_by_tank_slug($_POST['edit_tank']);

	if (isset($metalMaiden))
	{
		$forge = $_POST["forge"];
		$naval_port = $_POST["naval_port"];
		$refactor = $_POST["refactor"];
		for ($i = 1; $i <= 24; $i++)
		{
			for ($j = 1; $j <= 4; $j++)
			{
				$chapter[$i . "_" . $j] = (int) $_POST["chapter_" . $i . "_" . $j];
			}
		}
		$form_values_array = ["method_1", "method_2", "method_3", "develop", "research"];
		$other_requirments;
		foreach($form_values_array as $form_value)
		{
			if ($_POST[$form_value . "_tank_1"] == NULL)
				$other_requirments[$form_value] = NULL;
			else
			{
				for ($i = 1; $i <= 3; $i++)
				{
					$other_requirments[$form_value]["tank_" . $i] = $_POST[$form_value . "_tank_" . $i];
					$other_requirments[$form_value]["tank_level_" . $i] = $_POST[$form_value . "_tank_level_" . $i];
				}
				$other_requirments[$form_value]["dogtag"] = $_POST[$form_value . "_dogtag"];
				$other_requirments[$form_value]["voucher"] = $_POST[$form_value . "_voucher"];
				$other_requirments[$form_value]["resource"] = $_POST[$form_value . "_resource"];
				$other_requirments[$form_value]["resource_quantity"] = $_POST[$form_value . "_resource_quantity"];
				$other_requirments[$form_value]["blueprint"] = $_POST[$form_value . "_blueprint"];
				$other_requirments[$form_value]["blueprint_quantity"] = $_POST[$form_value . "_blueprint_quantity"];
				$other_requirments[$form_value]["equipment"] = $_POST[$form_value . "_equipment"];
				$other_requirments[$form_value]["equipment_rank"] = $_POST[$form_value . "_equipment_rank"];
				$other_requirments[$form_value]["equipment_quantity"] = $_POST[$form_value . "_equipment_quantity"];
				$other_requirments[$form_value]["commander_level"] = $_POST[$form_value . "_commander_level"];
				$other_requirments[$form_value]["silver"] = $_POST[$form_value . "_silver"];
			}
		}

		$requirements = array(
			"forge"			=> $forge,
			"naval_port"	=> $naval_port,
			"refactor"		=> $refactor,
			"chapter"		=> $chapter,
			"method_1"		=> $other_requirments["method_1"],
			"method_2"		=> $other_requirments["method_2"],
			"method_3"		=> $other_requirments["method_3"],
			"develop"		=> $other_requirments["develop"],
			"research"		=> $other_requirments["research"]
		);

		$metalMaidensManager->updateRequirements($metalMaiden, $requirements);

		redirection(link_to_route("metal_maiden") . "&tank=" . $metalMaiden->getTank_slug(), 250);
	}
}
?>