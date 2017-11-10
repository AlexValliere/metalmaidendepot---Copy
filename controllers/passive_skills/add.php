<?php
$method = $_SERVER['REQUEST_METHOD'];
$passiveSkillsManager = new PassiveSkillsManager($dbhandler);

if ($method == 'POST')
{
	$name = $_POST["name"];
	$bonus_value_1 = $_POST["bonus_value_1"];
	$bonus_value_2 = $_POST["bonus_value_2"];
	$bonus_mult_1 = $_POST["bonus_mult_1"];
	$bonus_mult_2 = $_POST["bonus_mult_2"];
	$malus_eqpt_value_1 = $_POST["malus_eqpt_value_1"];
	$malus_eqpt_value_2 = $_POST["malus_eqpt_value_2"];
	$updated_firepower_1 = isset($_POST["updated_firepower_1"]) ? 1 : 0;
	$updated_penetration_1 = isset($_POST["updated_penetration_1"]) ? 1 : 0;
	$updated_targeting_1 = isset($_POST["updated_targeting_1"]) ? 1 : 0;
	$updated_durability_1 = isset($_POST["updated_durability_1"]) ? 1 : 0;
	$updated_armor_1 = isset($_POST["updated_armor_1"]) ? 1 : 0;
	$updated_evasion_1 = isset($_POST["updated_evasion_1"]) ? 1 : 0;
	$updated_stealth_1 = isset($_POST["updated_stealth_1"]) ? 1 : 0;
	$updated_detection_1 = isset($_POST["updated_detection_1"]) ? 1 : 0;
	$updated_firepower_2 = isset($_POST["updated_firepower_2"]) ? 1 : 0;
	$updated_penetration_2 = isset($_POST["updated_penetration_2"]) ? 1 : 0;
	$updated_targeting_2 = isset($_POST["updated_targeting_2"]) ? 1 : 0;
	$updated_durability_2 = isset($_POST["updated_durability_2"]) ? 1 : 0;
	$updated_armor_2 = isset($_POST["updated_armor_2"]) ? 1 : 0;
	$updated_evasion_2 = isset($_POST["updated_evasion_2"]) ? 1 : 0;
	$updated_stealth_2 = isset($_POST["updated_stealth_2"]) ? 1 : 0;
	$updated_detection_2 = isset($_POST["updated_detection_2"]) ? 1 : 0;

	$passive_skill = new PassiveSkill(
		array(
			'name' => $name,
			'bonus_value_1' => $bonus_value_1,
			'bonus_value_2' => $bonus_value_2,
			'bonus_mult_1' => $bonus_mult_1,
			'bonus_mult_2' => $bonus_mult_2,
			'malus_eqpt_value_1' => $malus_eqpt_value_1,
			'malus_eqpt_value_2' => $malus_eqpt_value_2,
			'updated_firepower_1' => $updated_firepower_1,
			'updated_penetration_1' => $updated_penetration_1,
			'updated_targeting_1' => $updated_targeting_1,
			'updated_durability_1' => $updated_durability_1,
			'updated_armor_1' => $updated_armor_1,
			'updated_evasion_1' => $updated_evasion_1,
			'updated_stealth_1' => $updated_stealth_1,
			'updated_detection_1' => $updated_detection_1,
			'updated_firepower_2' => $updated_firepower_2,
			'updated_penetration_2' => $updated_penetration_2,
			'updated_targeting_2' => $updated_targeting_2,
			'updated_durability_2' => $updated_durability_2,
			'updated_armor_2' => $updated_armor_2,
			'updated_evasion_2' => $updated_evasion_2,
			'updated_stealth_2' => $updated_stealth_2,
			'updated_detection_2' => $updated_detection_2
		)
	);

	$passiveSkillsManager->add($passive_skill);

	redirection(link_to_route("view_passive_skill") . '&amp;id=' . $passive_skill->getId(), 250);
}
?>