<?php
$method = $_SERVER['REQUEST_METHOD'];
$chassisManager = new ChassisManager($dbhandler);

if (isset($_GET['chassis_id']))
	$chassis = $chassisManager->get($_GET['chassis_id']);

if ($method == 'POST' && isset($_POST["edit_chassis"]))
{
	$chassis = $chassisManager->get($_POST['edit_chassis']);

	if (isset($chassis) && $chassis != FALSE)
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

		$chassis->setName( $name );
		$chassis->setTier( $tier );
		$chassis->setLevel( $level );
		$chassis->setArmor( $armor );
		$chassis->setDetection( $detection );
		$chassis->setDurability( $durability );
		$chassis->setEvasion( $evasion );
		$chassis->setFirepower( $firepower );
		$chassis->setPenetration( $penetration );
		$chassis->setStealth( $stealth );
		$chassis->setTargeting( $targeting );
		$chassis->setAngled( $angled );
		$chassis->setFlat_top( $flat_top );
		$chassis->setFront( $front );
		$chassis->setLight( $light );
		$chassis->setLow( $low );
		$chassis->setRear( $rear );
		$chassis->setSloped( $sloped );
		$chassis->setTires( $tires );
		$chassis->setTreads( $treads );

		$chassisManager->update($chassis);

		if (VERBOSE)
			echo var_dump($chassis);

		redirection(link_to_route("chassis"), 250);
	}
}
?>