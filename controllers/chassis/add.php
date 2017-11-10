<?php
$method = $_SERVER['REQUEST_METHOD'];
$chassisManager = new ChassisManager($dbhandler);

if ($method == 'POST')
{
	$name = $_POST["chassis_name"];
	$tier = $_POST["chassis_tier"];
	$level = $_POST["chassis_level"];
	$armor = $_POST["chassis_armor"];
	$detection = $_POST["chassis_detection"];
	$durability = $_POST["chassis_durability"];
	$evasion = $_POST["chassis_evasion"];
	$firepower = $_POST["chassis_firepower"];
	$penetration = $_POST["chassis_penetration"];
	$stealth = $_POST["chassis_stealth"];
	$targeting = $_POST["chassis_targeting"];
	$angled = isset($_POST["chassis_angled"]) ? 1 : 0;
	$flat_top = isset($_POST["chassis_flat_top"]) ? 1 : 0;
	$front = isset($_POST["chassis_front"]) ? 1 : 0;
	$light = isset($_POST["chassis_light"]) ? 1 : 0;
	$low = isset($_POST["chassis_low"]) ? 1 : 0;
	$rear = isset($_POST["chassis_rear"]) ? 1 : 0;
	$sloped = isset($_POST["chassis_sloped"]) ? 1 : 0;
	$tires = isset($_POST["chassis_tires"]) ? 1 : 0;
	$treads = isset($_POST["chassis_treads"]) ? 1 : 0;

	$chassis = new Chassis(
		array(
			'name' => $name,
			'tier' => $tier,
			'level' => $level,
			'armor' => $armor,
			'detection' => $detection,
			'durability' => $durability,
			'evasion' => $evasion,
			'firepower' => $firepower,
			'penetration' => $penetration,
			'stealth' => $stealth,
			'targeting' => $targeting,
			'angled' => $angled,
			'flat_top' => $flat_top,
			'front' => $front,
			'light' => $light,
			'low' => $low,
			'rear' => $rear,
			'sloped' => $sloped,
			'tires' => $tires,
			'treads' => $treads
		)
	);

	$chassisManager->add($chassis);

	redirection(link_to_route("chassis"), 250);
}
?>