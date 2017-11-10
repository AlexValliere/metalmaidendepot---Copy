<?php
$method = $_SERVER['REQUEST_METHOD'];
$metalMaidensManager = new MetalMaidensManager($dbhandler);

if (isset($_GET['tank']))
	$tank = $metalMaidensManager->get_by_tank_slug($_GET['tank']);

if ($method == 'POST' && isset($_POST["edit_tank"]))
{
	$metalMaiden = $metalMaidensManager->get_by_tank_slug($_POST['edit_tank']);

	if (isset($metalMaiden))
	{
		$name = $_POST["name"];
		$tank = $_POST["tank"];
		$profile_game_version = $_POST["profile_game_version"];
		$root_head_id = $_POST["root_head_id"];
		$category = $_POST["category"];
		$nation = $_POST["nation"];
		$rarity = $_POST["rarity"];
		$character_voice = $_POST["character_voice"];
		$live2d = isset($_POST["live2d"]) ? $_POST["live2d"] : NULL;
		$live2d_name = $_POST["live2d_name"];
		$ammo = array(
				"ap"	=> isset($_POST['ap']) ? 1 : 0,
				"apcr"	=> isset($_POST['apcr']) ? 1 : 0,
				"apds"	=> isset($_POST['apds']) ? 1 : 0,
				"he"	=> isset($_POST['he']) ? 1 : 0,
				"heat"	=> isset($_POST['heat']) ? 1 : 0,
				"hesh"	=> isset($_POST['hesh']) ? 1 : 0,
				"rp"	=> isset($_POST['rp']) ? 1 : 0
		);
		$lifestyle_skills = array(
				"skill_1"	=> $_POST['lifestyle_skill_1'],
				"skill_1_level"	=> $_POST['lifestyle_skill_1_level'],
				"skill_2"	=> $_POST['lifestyle_skill_2'],
				"skill_2_level"	=> $_POST['lifestyle_skill_2_level'],
				"skill_3"	=> $_POST['lifestyle_skill_3'],
				"skill_3_level"	=> $_POST['lifestyle_skill_3_level']
		);
		$equipment_slots = array(
				"slot_1"	=> $_POST["equipment_slot_1"],
				"slot_2"	=> $_POST["equipment_slot_2"],
				"slot_3"	=> $_POST["equipment_slot_3"],
				"slot_4"	=> $_POST["equipment_slot_4"],
				"slot_5"	=> $_POST["equipment_slot_5"],
				"slot_6"	=> $_POST["equipment_slot_6"],
				"slot_7"	=> $_POST["equipment_slot_7"],
				"slot_8"	=> $_POST["equipment_slot_8"]
		);
		$engine_bonus = array(
				"c_proof"	=> isset($_POST['c_proof']) ? 1 : 0,
				"d_proof"	=> isset($_POST['d_proof']) ? 1 : 0,
				"h_proof"	=> isset($_POST['h_proof']) ? 1 : 0,
				"s_proof"	=> isset($_POST['s_proof']) ? 1 : 0,
				"w_proof"	=> isset($_POST['w_proof']) ? 1 : 0,
				"silent"	=> isset($_POST['silent']) ? 1 : 0
		);
		$chassis_bonus = array(
				"angled"	=> isset($_POST['angled']) ? 1 : 0,
				"flat_top"	=> isset($_POST['flat_top']) ? 1 : 0,
				"front"		=> isset($_POST['front']) ? 1 : 0,
				"light"		=> isset($_POST['light']) ? 1 : 0,
				"low"		=> isset($_POST['low']) ? 1 : 0,
				"rear"		=> isset($_POST['rear']) ? 1 : 0,
				"sloped"	=> isset($_POST['sloped']) ? 1 : 0,
				"tires"		=> isset($_POST['tires']) ? 1 : 0,
				"treads"	=> isset($_POST['treads']) ? 1 : 0
		);
		$firepower = $_POST["firepower"];
		$penetration = $_POST["penetration"];
		$durability = $_POST["durability"];
		$armor = $_POST["armor"];
		$stealth = $_POST["stealth"];
		$detection = $_POST["detection"];
		$targeting = $_POST["targeting"];
		$evasion = $_POST["evasion"];
		$fire_resist = $_POST["fire_resist"];
		$crit_resist = $_POST["crit_resist"];
		$crit_defense = $_POST["crit_defense"];
		$firepower_lvl60 = $_POST["firepower_lvl60"];
		$penetration_lvl60 = $_POST["penetration_lvl60"];
		$durability_lvl60 = $_POST["durability_lvl60"];
		$armor_lvl60 = $_POST["armor_lvl60"];
		$min_range = $_POST["min_range"];
		$max_range = $_POST["max_range"];
		$quote_intro = is_string($_POST["quote_intro"]) ? trim($_POST["quote_intro"]) : "";
		$quote_main_screen_1 = is_string($_POST["quote_main_screen_1"]) ? trim($_POST["quote_main_screen_1"]) : "";
		$quote_main_screen_2 = is_string($_POST["quote_main_screen_2"]) ? trim($_POST["quote_main_screen_2"]) : "";
		$quote_main_screen_3 = is_string($_POST["quote_main_screen_3"]) ? trim($_POST["quote_main_screen_3"]) : "";
		$quote_main_screen_4 = is_string($_POST["quote_main_screen_4"]) ? trim($_POST["quote_main_screen_4"]) : "";
		$quote_main_screen_5 = is_string($_POST["quote_main_screen_5"]) ? trim($_POST["quote_main_screen_5"]) : "";
		$quote_main_screen_6 = is_string($_POST["quote_main_screen_6"]) ? trim($_POST["quote_main_screen_6"]) : "";
		$quote_upgrading = is_string($_POST["quote_upgrading"]) ? trim($_POST["quote_upgrading"]) : "";
		$quote_pre_attack_1 = is_string($_POST["quote_pre_attack_1"]) ? trim($_POST["quote_pre_attack_1"]) : "";
		$quote_pre_attack_2 = is_string($_POST["quote_pre_attack_2"]) ? trim($_POST["quote_pre_attack_2"]) : "";
		$quote_pre_attack_3 = is_string($_POST["quote_pre_attack_3"]) ? trim($_POST["quote_pre_attack_3"]) : "";
		$quote_on_attack_1 = is_string($_POST["quote_on_attack_1"]) ? trim($_POST["quote_on_attack_1"]) : "";
		$quote_on_attack_2 = is_string($_POST["quote_on_attack_2"]) ? trim($_POST["quote_on_attack_2"]) : "";
		$quote_on_attack_3 = is_string($_POST["quote_on_attack_3"]) ? trim($_POST["quote_on_attack_3"]) : "";
		$quote_on_attack_4 = is_string($_POST["quote_on_attack_4"]) ? trim($_POST["quote_on_attack_4"]) : "";
		$quote_on_attack_5 = is_string($_POST["quote_on_attack_5"]) ? trim($_POST["quote_on_attack_5"]) : "";
		$quote_on_attack_6 = is_string($_POST["quote_on_attack_6"]) ? trim($_POST["quote_on_attack_6"]) : "";
		$quote_on_attack_7 = is_string($_POST["quote_on_attack_7"]) ? trim($_POST["quote_on_attack_7"]) : "";
		$quote_getting_hit = is_string($_POST["quote_getting_hit"]) ? trim($_POST["quote_getting_hit"]) : "";
		$quote_upon_destruction = is_string($_POST["quote_upon_destruction"]) ? trim($_POST["quote_upon_destruction"]) : "";
		$quote_added_to_squad = is_string($_POST["quote_added_to_squad"]) ? trim($_POST["quote_added_to_squad"]) : "";
		$quote_choice_of_essential_equipment_1 = is_string($_POST["quote_choice_of_essential_equipment_1"]) ? trim($_POST["quote_choice_of_essential_equipment_1"]) : "";
		$quote_choice_of_essential_equipment_2 = is_string($_POST["quote_choice_of_essential_equipment_2"]) ? trim($_POST["quote_choice_of_essential_equipment_2"]) : "";
		$quote_choice_of_essential_equipment_3 = is_string($_POST["quote_choice_of_essential_equipment_3"]) ? trim($_POST["quote_choice_of_essential_equipment_3"]) : "";
		$quote_choice_of_essential_equipment_4 = is_string($_POST["quote_choice_of_essential_equipment_4"]) ? trim($_POST["quote_choice_of_essential_equipment_4"]) : "";
		$quote_when_updating_equipment_1 = is_string($_POST["quote_when_updating_equipment_1"]) ? trim($_POST["quote_when_updating_equipment_1"]) : "";
		$quote_when_updating_equipment_2 = is_string($_POST["quote_when_updating_equipment_2"]) ? trim($_POST["quote_when_updating_equipment_2"]) : "";
		$quote_when_updating_equipment_3 = is_string($_POST["quote_when_updating_equipment_3"]) ? trim($_POST["quote_when_updating_equipment_3"]) : "";
		$quote_unequip_all_gear = is_string($_POST["quote_unequip_all_gear"]) ? trim($_POST["quote_unequip_all_gear"]) : "";
		$quote_battle_victory_1 = is_string($_POST["quote_battle_victory_1"]) ? trim($_POST["quote_battle_victory_1"]) : "";
		$quote_battle_victory_2 = is_string($_POST["quote_battle_victory_2"]) ? trim($_POST["quote_battle_victory_2"]) : "";
		$quote_battle_victory_3 = is_string($_POST["quote_battle_victory_3"]) ? trim($_POST["quote_battle_victory_3"]) : "";
		$quote_battle_loss = is_string($_POST["quote_battle_loss"]) ? trim($_POST["quote_battle_loss"]) : "";
		$quote_fate = is_string($_POST["quote_fate"]) ? trim($_POST["quote_fate"]) : "";
		$hidden = $_POST["hidden"];

		$metalMaiden->setName($name);
		$metalMaiden->setTank($tank);
		$metalMaiden->setProfile_game_version($profile_game_version);
		$metalMaiden->setRoot_head_id($root_head_id);
		$metalMaiden->setCategory($category);
		$metalMaiden->setNation($nation);
		$metalMaiden->setRarity($rarity);
		$metalMaiden->setCharacter_voice($character_voice);
		$metalMaiden->setLive2d($live2d);
		$metalMaiden->setLive2d_name($live2d_name);
		$metalMaiden->setAmmo($ammo);
		$metalMaiden->setLifestyle_skills($lifestyle_skills);
		$metalMaiden->setEquipment_slots($equipment_slots);
		$metalMaiden->setEngine_bonus($engine_bonus);
		$metalMaiden->setChassis_bonus($chassis_bonus);
		$metalMaiden->setFirepower($firepower);
		$metalMaiden->setPenetration($penetration);
		$metalMaiden->setDurability($durability);
		$metalMaiden->setArmor($armor);
		$metalMaiden->setTargeting($targeting);
		$metalMaiden->setEvasion($evasion);
		$metalMaiden->setStealth($stealth);
		$metalMaiden->setDetection($detection);
		$metalMaiden->setFire_resist($fire_resist);
		$metalMaiden->setCrit_resist($crit_resist);
		$metalMaiden->setCrit_defense($crit_defense);
		$metalMaiden->setFirepower_lvl60($firepower_lvl60);
		$metalMaiden->setPenetration_lvl60($penetration_lvl60);
		$metalMaiden->setDurability_lvl60($durability_lvl60);
		$metalMaiden->setArmor_lvl60($armor_lvl60);
		$metalMaiden->setMin_range($min_range);
		$metalMaiden->setMax_range($max_range);
		$metalMaiden->setQuote_intro($quote_intro);
		$metalMaiden->setQuote_main_screen_1($quote_main_screen_1);
		$metalMaiden->setQuote_main_screen_2($quote_main_screen_2);
		$metalMaiden->setQuote_main_screen_3($quote_main_screen_3);
		$metalMaiden->setQuote_main_screen_4($quote_main_screen_4);
		$metalMaiden->setQuote_main_screen_5($quote_main_screen_5);
		$metalMaiden->setQuote_main_screen_6($quote_main_screen_6);
		$metalMaiden->setQuote_upgrading($quote_upgrading);
		$metalMaiden->setQuote_pre_attack_1($quote_pre_attack_1);
		$metalMaiden->setQuote_pre_attack_2($quote_pre_attack_2);
		$metalMaiden->setQuote_pre_attack_3($quote_pre_attack_3);
		$metalMaiden->setQuote_on_attack_1($quote_on_attack_1);
		$metalMaiden->setQuote_on_attack_2($quote_on_attack_2);
		$metalMaiden->setQuote_on_attack_3($quote_on_attack_3);
		$metalMaiden->setQuote_on_attack_4($quote_on_attack_4);
		$metalMaiden->setQuote_on_attack_5($quote_on_attack_5);
		$metalMaiden->setQuote_on_attack_6($quote_on_attack_6);
		$metalMaiden->setQuote_on_attack_7($quote_on_attack_7);
		$metalMaiden->setQuote_getting_hit($quote_getting_hit);
		$metalMaiden->setQuote_upon_destruction($quote_upon_destruction);
		$metalMaiden->setQuote_added_to_squad($quote_added_to_squad);
		$metalMaiden->setQuote_choice_of_essential_equipment_1($quote_choice_of_essential_equipment_1);
		$metalMaiden->setQuote_choice_of_essential_equipment_2($quote_choice_of_essential_equipment_2);
		$metalMaiden->setQuote_choice_of_essential_equipment_3($quote_choice_of_essential_equipment_3);
		$metalMaiden->setQuote_choice_of_essential_equipment_4($quote_choice_of_essential_equipment_4);
		$metalMaiden->setQuote_when_updating_equipment_1($quote_when_updating_equipment_1);
		$metalMaiden->setQuote_when_updating_equipment_2($quote_when_updating_equipment_2);
		$metalMaiden->setQuote_when_updating_equipment_3($quote_when_updating_equipment_3);
		$metalMaiden->setQuote_unequip_all_gear($quote_unequip_all_gear);
		$metalMaiden->setQuote_battle_victory_1($quote_battle_victory_1);
		$metalMaiden->setQuote_battle_victory_2($quote_battle_victory_2);
		$metalMaiden->setQuote_battle_victory_3($quote_battle_victory_3);
		$metalMaiden->setQuote_battle_loss($quote_battle_loss);
		$metalMaiden->setQuote_fate($quote_fate);
		$metalMaiden->setHidden($hidden);

		$metalMaidensManager = new MetalMaidensManager($dbhandler);
		$metalMaidensManager->update($metalMaiden);

		if (VERBOSE)
		{
			echo "<pre>";
			echo print_r($metalMaiden);
			echo "</pre>";
			echo "<br /><a href='" . link_to_route("metal_maiden") . "&tank=" . $metalMaiden->getTank_slug() . "'>Go to " . $metalMaiden->getTank() . " page</a>";
		}
		else
			redirection(link_to_route("metal_maiden") . "&tank=" . $metalMaiden->getTank_slug(), 250);
	}
}
?>