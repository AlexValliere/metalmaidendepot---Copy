<?php
$method = $_SERVER['REQUEST_METHOD'];
$passiveSkillsManager = new PassiveSkillsManager($dbhandler);

if (isset($_GET['passive_skill_id']))
	$passive_skill = $passiveSkillsManager->get($_GET['passive_skill_id']);

if ($method == 'POST' && isset($_POST["edit_passive_skill"]))
{
	$passive_skill = $armorsManager->get($_POST['edit_passive_skill']);

	if (isset($passive_skill) && $passive_skill != FALSE)
	{
		$name = $_POST["name"];
		$bonus_value_1 = $_POST["bonus_value_1"];
		$bonus_value_2 = $_POST["bonus_value_2"];
		$bonus_mult_1 = $_POST["bonus_mult_1"];
		$bonus_mult_2 = $_POST["bonus_mult_2"];
		$malus_eqpt_value_1 = $_POST["malus_eqpt_value_1"];
		$malus_eqpt_value_2 = $_POST["malus_eqpt_value_2"];
		$update_firepower_1 = isset($_POST["update_firepower_1"]) ? 1 : 0;
		$update_penetration_1 = isset($_POST["update_penetration_1"]) ? 1 : 0;
		$update_targeting_1 = isset($_POST["update_targeting_1"]) ? 1 : 0;
		$update_durability_1 = isset($_POST["update_durability_1"]) ? 1 : 0;
		$update_armor_1 = isset($_POST["update_armor_1"]) ? 1 : 0;
		$update_evasion_1 = isset($_POST["update_evasion_1"]) ? 1 : 0;
		$update_stealth_1 = isset($_POST["update_stealth_1"]) ? 1 : 0;
		$update_detection_1 = isset($_POST["update_detection_1"]) ? 1 : 0;
		$update_firepower_2 = isset($_POST["update_firepower_2"]) ? 1 : 0;
		$update_penetration_2 = isset($_POST["update_penetration_2"]) ? 1 : 0;
		$update_targeting_2 = isset($_POST["update_targeting_2"]) ? 1 : 0;
		$update_durability_2 = isset($_POST["update_durability_2"]) ? 1 : 0;
		$update_armor_2 = isset($_POST["update_armor_2"]) ? 1 : 0;
		$update_evasion_2 = isset($_POST["update_evasion_2"]) ? 1 : 0;
		$update_stealth_2 = isset($_POST["update_stealth_2"]) ? 1 : 0;
		$update_detection_2 = isset($_POST["update_detection_2"]) ? 1 : 0;

		$passive_skill->setName( $name );
		$passive_skill->setBonus_value_1( $bonus_value_1 );
		$passive_skill->setBonus_value_2( $bonus_value_2 );
		$passive_skill->setBonus_mult_1( $bonus_mult_1 );
		$passive_skill->setBonus_mult_2( $bonus_mult_2 );
		$passive_skill->setMalus_eqpt_value_1( $malus_eqpt_value_1 );
		$passive_skill->setMalus_eqpt_value_2( $malus_eqpt_value_2 );
		$passive_skill->setComposite( $update_firepower_1 );
		$passive_skill->setUpdate_penetration_1( $update_penetration_1 );
		$passive_skill->setUpdate_targeting_1( $update_targeting_1 );
		$passive_skill->setUpdate_durability_1( $update_durability_1 );
		$passive_skill->setUpdate_armor_1( $update_armor_1 );
		$passive_skill->setUpdate_evasion_1( $update_evasion_1 );
		$passive_skill->setUpdate_stealth_1( $update_stealth_1 );
		$passive_skill->setUpdate_detection_1( $update_detection_1 );
		$passive_skill->setUpdate_firepower_2( $update_firepower_2 );
		$passive_skill->setUpdate_penetration_2( $update_penetration_2 );
		$passive_skill->setUpdate_targeting_2( $update_targeting_2 );
		$passive_skill->setUpdate_durability_2( $update_durability_2 );
		$passive_skill->setUpdate_armor_2( $update_armor_2 );
		$passive_skill->setUpdate_evasion_2( $update_evasion_2 );
		$passive_skill->setUpdate_stealth_2( $update_stealth_2 );
		$passive_skill->setUpdate_detection_2( $update_detection_2 );

		$passiveSkillsManager->update($passive_skill);

		if (VERBOSE)
			echo var_dump($passive_skill);

		redirection(link_to_route("view_passive_skill") . '&amp;id=' . $passive_skill->getId(), 250);
	}
}
?>