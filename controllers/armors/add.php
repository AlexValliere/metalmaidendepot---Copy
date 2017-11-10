<?php
$method = $_SERVER['REQUEST_METHOD'];
$armorsManager = new ArmorsManager($dbhandler);

if ($method == 'POST')
{
	$name = $_POST["armor_name"];
	$category = $_POST["armor_category"];
	$tier = $_POST["armor_tier"];
	$level = $_POST["armor_level"];
	$armor = $_POST["armor_armor"];
	$durability = $_POST["armor_durability"];
	$evasion = $_POST["armor_evasion"];
	$stealth = $_POST["armor_stealth"];
	$targeting = $_POST["armor_targeting"];
	$cast = isset($_POST["armor_cast"]) ? 1 : 0;
	$composite = isset($_POST["armor_composite"]) ? 1 : 0;
	$hardened = isset($_POST["armor_hardened"]) ? 1 : 0;
	$riveted = isset($_POST["armor_riveted"]) ? 1 : 0;
	$spaced = isset($_POST["armor_spaced"]) ? 1 : 0;
	$tempered = isset($_POST["armor_tempered"]) ? 1 : 0;
	$wedge = isset($_POST["armor_wedge"]) ? 1 : 0;
	$welded = isset($_POST["armor_welded"]) ? 1 : 0;

	$armor = new Armor(
		array(
			'name' => $name,
			'category' => $category,
			'tier' => $tier,
			'level' => $level,
			'armor' => $armor,
			'durability' => $durability,
			'evasion' => $evasion,
			'stealth' => $stealth,
			'targeting' => $targeting,
			'cast' => $cast,
			'composite' => $composite,
			'hardened' => $hardened,
			'spaced' => $spaced,
			'riveted' => $riveted,
			'tempered' => $tempered,
			'wedge' => $wedge,
			'welded' => $welded
		)
	);

	$armorsManager->add($armor);

	redirection(link_to_route("armors"), 250);
}
?>