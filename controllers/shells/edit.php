<?php
$method = $_SERVER['REQUEST_METHOD'];
$shellsManager = new ShellsManager($dbhandler);

if (isset($_GET['shell_id']))
	$shell = $shellsManager->get($_GET['shell_id']);

if ($method == 'POST' && isset($_POST["edit_shell"]))
{
	$shell = $shellsManager->get($_POST['edit_shell']);

	if (isset($shell))
	{
		$shell_name = $_POST["shell_name"];
		$shell_category = $_POST["shell_category"];
		$shell_tier = $_POST["shell_tier"];
		$shell_level = $_POST["shell_level"];
		$shell_firepower = empty($_POST["shell_firepower"]) ? NULL : $_POST["shell_firepower"];
		$shell_penetration = empty($_POST["shell_penetration"]) ? NULL : $_POST["shell_penetration"];
		$shell_targeting = empty($_POST["shell_targeting"]) ? NULL : $_POST["shell_targeting"];
		$shell_evasion = empty($_POST["shell_evasion"]) ? NULL : $_POST["shell_evasion"];
		$shell_stealth = empty($_POST["shell_stealth"]) ? NULL : $_POST["shell_stealth"];

		$shell->setName($shell_name);
		$shell->setCategory($shell_category);
		$shell->setTier($shell_tier);
		$shell->setLevel($shell_level);
		$shell->setFirepower($shell_firepower);
		$shell->setPenetration($shell_penetration);
		$shell->setTargeting($shell_targeting);
		$shell->setEvasion($shell_evasion);
		$shell->setStealth($shell_stealth);

		$shellsManager = new ShellsManager($dbhandler);
		$shellsManager->update($shell);

		if (VERBOSE)
			echo var_dump($shell);

		redirection(link_to_route("shells") . "&amp;category=" . $shell->getCategory(), 250);
	}
}
?>