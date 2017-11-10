<button type="button" onClick="setVisibility();">Export to wiki</button>
<!--<button type="button" onClick="setVisibility2();">Export statistics section to wiki</button>-->

<pre id="export_to_wiki" style="display: none;" class="wiki">
{{Infobox_Metal_Maiden_Profile
 | model                                        = <?php echo $view_tank->getTank() . "<br />"; ?>
 | name                                                = <?php echo $view_tank->getName() . "<br />"; ?>
 | character_portrait_image                        = <?php echo str_replace('/', '_', $view_tank->getTank() . '.png<br />'); ?>
 | rarity                                        = <?php echo $view_tank->getRarity() . "<br />"; ?>
 | type                                                = <?php echo $view_tank->getCategory() . "<br />"; ?>
 | nation                                        = <?php echo ucfirst($view_tank->getNation()) . "<br />"; ?>
 | character_voice                                = <?php echo $view_tank->getCharacter_voice() . "<br />"; ?>
 | live2d                                        = <?php echo $view_tank->getLive2d() . "<br />"; ?>
}}

==Quote==<?php
if ($view_tank->countQuotes() > 0)
{
	echo '<br />{| class="wikitable"<br />';
	echo ' ! From<br />';
	echo ' ! Quote<br />';

	if (!empty($view_tank->getQuote_intro()))
	{
		echo ' |-<br />';
		echo ' | Intro<br />';
		echo ' | ';
		if ($view_tank->getQuote_intro() == "null")
			echo '<span style="color: Crimson">No quote</span>';
		else
			echo $view_tank->getQuote_intro();
		echo "<br />";
	}

	if ($view_tank->countQuote_main_screen() > 0)
	{
		echo ' |-<br />';
		echo ' | rowspan="' . $view_tank->countQuote_main_screen() . '" | Main game screen<br />';

		if ($view_tank->getQuote_main_screen_1() == "null")		echo ' | ' . '<span style="color: Crimson">No quote</span>' . "<br /> |-<br />";
		elseif (!empty($view_tank->getQuote_main_screen_1()))	echo ' | ' . $view_tank->getQuote_main_screen_1() . "<br /> |-<br />";

		if ($view_tank->getQuote_main_screen_2() == "null")		echo ' | ' . '<span style="color: Crimson">No quote</span>' . "<br /> |-<br />";
		elseif (!empty($view_tank->getQuote_main_screen_2()))	echo ' | ' . $view_tank->getQuote_main_screen_2() . "<br /> |-<br />";

		if ($view_tank->getQuote_main_screen_3() == "null")		echo ' | ' . '<span style="color: Crimson">No quote</span>' . "<br /> |-<br />";
		elseif (!empty($view_tank->getQuote_main_screen_3()))	echo ' | ' . $view_tank->getQuote_main_screen_3() . "<br /> |-<br />";

		if ($view_tank->getQuote_main_screen_4() == "null")		echo ' | ' . '<span style="color: Crimson">No quote</span>' . "<br /> |-<br />";
		elseif (!empty($view_tank->getQuote_main_screen_4()))	echo ' | ' . $view_tank->getQuote_main_screen_4() . "<br /> |-<br />";

		if ($view_tank->getQuote_main_screen_5() == "null")		echo ' | ' . '<span style="color: Crimson">No quote</span>' . "<br /> |-<br />";
		elseif (!empty($view_tank->getQuote_main_screen_5()))	echo ' | ' . $view_tank->getQuote_main_screen_5() . "<br /> |-<br />";
	}

	if (!empty($view_tank->getQuote_upgrading()))
	{
		echo ' |-<br />';
		echo ' | Upgrading<br />';
		echo ' | ';
		if ($view_tank->getQuote_upgrading() == "null")
			echo '<span style="color: Crimson">No quote</span>';
		else
			echo $view_tank->getQuote_upgrading();
		echo "<br />";
	}

	for ($i = 1; $i <= 3; $i++)
	{
		if (!empty($view_tank->{'getQuote_pre_attack_' . $i}()))
		{
			echo ' |-<br />';
			echo ' | Pre-attack #' . $i . '<br />';
			echo ' | ';
			if ($view_tank->{'getQuote_pre_attack_' . $i}() == "null")
				echo '<span style="color: Crimson">No quote</span>';
			else
				echo $view_tank->{'getQuote_pre_attack_' . $i}();
			echo "<br />";
		}
		else
			echo $view_tank->{'getQuote_pre_attack_' . $i};
	}

	for ($i = 1; $i <= 7; $i++)
	{
		if (!empty($view_tank->{'getQuote_on_attack_' . $i}()))
		{
			echo ' |-<br />';
			echo ' | On attack #' . $i . '<br />';
			echo ' | ';
			if ($view_tank->{'getQuote_on_attack_' . $i}() == "null")
				echo '<span style="color: Crimson">No quote</span>';
			else
				echo $view_tank->{'getQuote_on_attack_' . $i}();
			echo "<br />";
		}
	}

	if (!empty($view_tank->getQuote_getting_hit()))
	{
		echo ' |-<br />';
		echo ' | Getting hit<br />';
		echo ' | ';
		if ($view_tank->getQuote_getting_hit() == "null")
			echo '<span style="color: Crimson">No quote</span>';
		else
			echo $view_tank->getQuote_getting_hit();
		echo "<br />";
	}

	if (!empty($view_tank->getQuote_upon_destruction()))
	{
		echo ' |-<br />';
		echo ' | Upon destruction<br />';
		echo ' | ';
		if ($view_tank->getQuote_upon_destruction() == "null")
			echo '<span style="color: Crimson">No quote</span>';
		else
			echo $view_tank->getQuote_upon_destruction();
		echo "<br />";
	}

	if (!empty($view_tank->getQuote_added_to_squad()))
	{
		echo ' |-<br />';
		echo ' | Assignation to a squad<br />';
		echo ' | ';
		if ($view_tank->getQuote_added_to_squad() == "null")
			echo '<span style="color: Crimson">No quote</span>';
		else
			echo $view_tank->getQuote_added_to_squad();
		echo "<br />";
	}

	for ($i = 1; $i <= 4; $i++)
	{
		if (!empty($view_tank->{'getQuote_choice_of_essential_equipment_' . $i}()))
		{
			echo ' |-<br />';
			echo ' | Adding essential equipment #' . $i . '<br />';
			echo ' | ';
			if ($view_tank->{'getQuote_choice_of_essential_equipment_' . $i}() == "null")
				echo '<span style="color: Crimson">No quote</span>';
			else
				echo $view_tank->{'getQuote_choice_of_essential_equipment_' . $i}();
			echo "<br />";
		}
		else
			echo $view_tank->{'getQuote_choice_of_essential_equipment_' . $i};
	}

	if (!empty($view_tank->getQuote_when_updating_equipment_1()))
	{
		echo ' |-<br />';
		echo ' | Changing equipment #1<br />';
		echo ' | ';
		if ($view_tank->getQuote_when_updating_equipment_1() == "null")
			echo '<span style="color: Crimson">No quote</span>';
		else
			echo $view_tank->getQuote_when_updating_equipment_1();
		echo "<br />";
	}

	if (!empty($view_tank->getQuote_when_updating_equipment_2()))
	{
		echo ' |-<br />';
		echo ' | Adding equipment to a slot #2<br />';
		echo ' | ';
		if ($view_tank->getQuote_when_updating_equipment_2() == "null")
			echo '<span style="color: Crimson">No quote</span>';
		else
			echo $view_tank->getQuote_when_updating_equipment_2();
		echo "<br />";
	}

	if (!empty($view_tank->getQuote_when_updating_equipment_3()))
	{
		echo ' |-<br />';
		echo ' | Adding equipment to a slot #2<br />';
		echo ' | ';
		if ($view_tank->getQuote_when_updating_equipment_3() == "null")
			echo '<span style="color: Crimson">No quote</span>';
		else
			echo $view_tank->getQuote_when_updating_equipment_3();
		echo "<br />";
	}

	if (!empty($view_tank->getQuote_unequip_all_gear()))
	{
		echo ' |-<br />';
		echo ' | Unequip all gear<br />';
		echo ' | ';
		if ($view_tank->getQuote_unequip_all_gear() == "null")
			echo '<span style="color: Crimson">No quote</span>';
		else
			echo $view_tank->getQuote_unequip_all_gear();
		echo "<br />";
	}

	for ($i = 1; $i <= 3; $i++)
	{
		if (!empty($view_tank->{'getQuote_battle_victory_' . $i}()))
		{
			echo ' |-<br />';
			echo ' | Battle victory #' . $i . '<br />';
			echo ' | ';
			if ($view_tank->{'getQuote_battle_victory_' . $i}() == "null")
				echo '<span style="color: Crimson">No quote</span>';
			else
				echo $view_tank->{'getQuote_battle_victory_' . $i}();
			echo "<br />";
		}
		else
			echo $view_tank->{'getQuote_battle_victory_' . $i};
	}

	if (!empty($view_tank->getQuote_battle_loss()))
	{
		echo ' |-<br />';
		echo ' | Battle loss<br />';
		echo ' | ';
		if ($view_tank->getQuote_battle_loss() == "null")
			echo '<span style="color: Crimson">No quote</span>';
		else
			echo $view_tank->getQuote_battle_loss();
		echo "<br />";
	}

	if (!empty($view_tank->getQuote_fate()))
	{
		echo ' |-<br />';
		echo ' | Fate<br />';
		echo ' | ';
		if ($view_tank->getQuote_fate() == "null")
			echo '<span style="color: Crimson">No quote</span>';
		else
			echo $view_tank->getQuote_fate();
		echo "<br />";
	}

	echo '|}';
}
?>
<br />
==Attributes==
{{Infobox_Metal_Maiden_Statistics
 | firepower                                = <?php echo $view_tank->getFirepower() . "<br />"; ?>
 | penetration                                = <?php echo $view_tank->getPenetration() . "<br />"; ?>
 | durability                                = <?php echo $view_tank->getDurability() . "<br />"; ?>
 | armor                                = <?php echo $view_tank->getArmor() . "<br />"; ?>
 | targeting                                = <?php echo $view_tank->getTargeting() . "<br />"; ?>
 | evasion                                = <?php echo $view_tank->getEvasion() . "<br />"; ?>
 | stealth                                = <?php echo $view_tank->getStealth() . "<br />"; ?>
 | detection                                = <?php echo $view_tank->getDetection() . "<br />"; ?>
 | range_min                                = <?php if ($view_tank->getMin_range() != 0) echo number_format($view_tank->getMin_range(), 0, ',', ' '); echo "<br />"; ?>
 | range_max                                = <?php if ($view_tank->getMax_range() != 0) echo number_format($view_tank->getMax_range(), 0, ',', ' '); echo "<br />"; ?>
 | fire_resist                                = <?php echo $view_tank->getFire_resist() . "<br />"; ?>
 | crit_resist                                = <?php echo $view_tank->getCrit_resist() . "<br />"; ?>
 | crit_defense                                = <?php echo $view_tank->getCrit_defense() . "<br />"; ?>
}}
{{Infobox_Metal_Maiden_Lifestyle
 |skill_1                        = <?php if ($view_tank->getLifestyle_skills()["skill_1"] != "null") echo $view_tank->getLifestyle_skills()["skill_1"]; echo "<br />"; ?>
 |skill_1_level                        = <?php if ($view_tank->getLifestyle_skills()["skill_1"] != "null") echo $view_tank->getLifestyle_skills()["skill_1_level"]; echo "<br />"; ?>
 |skill_2                        = <?php if ($view_tank->getLifestyle_skills()["skill_2"] != "null") echo $view_tank->getLifestyle_skills()["skill_2"]; echo "<br />"; ?>
 |skill_2_level                        = <?php if ($view_tank->getLifestyle_skills()["skill_2"] != "null") echo $view_tank->getLifestyle_skills()["skill_2_level"]; echo "<br />"; ?>
 |skill_3                        = <?php if ($view_tank->getLifestyle_skills()["skill_3"] != "null") echo $view_tank->getLifestyle_skills()["skill_3"]; echo "<br />"; ?>
 |skill_3_level                        = <?php if ($view_tank->getLifestyle_skills()["skill_3"] != "null") echo $view_tank->getLifestyle_skills()["skill_3_level"]; echo "<br />"; ?>
}}
{{Infobox_Metal_Maiden_Equipment
 | max_rank                        = <?php echo $view_tank->getMax_rank() . "<br />"; ?>
 | slot_1                        = <?php if ($view_tank->getEquipment_slots()["slot_1"] != "null") echo $view_tank->getEquipment_slots()["slot_1"]; echo "<br />"; ?>
 | slot_2                        = <?php if ($view_tank->getEquipment_slots()["slot_2"] != "null") echo $view_tank->getEquipment_slots()["slot_2"]; echo "<br />"; ?>
 | slot_3                        = <?php if ($view_tank->getEquipment_slots()["slot_3"] != "null") echo $view_tank->getEquipment_slots()["slot_3"]; echo "<br />"; ?>
 | slot_4                        = <?php if ($view_tank->getEquipment_slots()["slot_4"] != "null") echo $view_tank->getEquipment_slots()["slot_4"]; echo "<br />"; ?>
 | slot_5                        = <?php if ($view_tank->getEquipment_slots()["slot_5"] != "null") echo $view_tank->getEquipment_slots()["slot_5"]; echo "<br />"; ?>
 | slot_6                        = <?php if ($view_tank->getEquipment_slots()["slot_6"] != "null") echo $view_tank->getEquipment_slots()["slot_6"]; echo "<br />"; ?>
 | slot_7                        = <?php if ($view_tank->getEquipment_slots()["slot_7"] != "null") echo $view_tank->getEquipment_slots()["slot_7"]; echo "<br />"; ?>
 | slot_8                        = <?php if ($view_tank->getEquipment_slots()["slot_8"] != "null") echo $view_tank->getEquipment_slots()["slot_8"]; echo "<br />"; ?>
 | ap                                = <?php echo $view_tank->getAmmo()["ap"] . "<br />"; ?>
 | apcr                                = <?php echo $view_tank->getAmmo()["apcr"] . "<br />"; ?>
 | apds                                = <?php echo $view_tank->getAmmo()["apds"] . "<br />"; ?>
 | he                                = <?php echo $view_tank->getAmmo()["he"] . "<br />"; ?>
 | heat                                = <?php echo $view_tank->getAmmo()["heat"] . "<br />"; ?>
 | hesh                                = <?php echo $view_tank->getAmmo()["hesh"] . "<br />"; ?>
 | rp                                = <?php echo $view_tank->getAmmo()["rp"] . "<br />"; ?>
 | c_proof                        = <?php echo $view_tank->getEngine_bonus()["c_proof"] . "<br />"; ?>
 | d_proof                        = <?php echo $view_tank->getEngine_bonus()["d_proof"] . "<br />"; ?>
 | h_proof                        = <?php echo $view_tank->getEngine_bonus()["h_proof"] . "<br />"; ?>
 | s_proof                        = <?php echo $view_tank->getEngine_bonus()["s_proof"] . "<br />"; ?>
 | w_proof                        = <?php echo $view_tank->getEngine_bonus()["w_proof"] . "<br />"; ?>
 | silent                        = <?php echo $view_tank->getEngine_bonus()["silent"] . "<br />"; ?>
 | armor                        = <?php echo $pw_tank_armor_by_categories[$view_tank->getCategory()] . "<br />"; ?>
 | angled                        = <?php echo $view_tank->getChassis_bonus()["angled"] . "<br />"; ?>
 | flat-top                        = <?php echo $view_tank->getChassis_bonus()["flat_top"] . "<br />"; ?>
 | front                        = <?php echo $view_tank->getChassis_bonus()["front"] . "<br />"; ?>
 | light                        = <?php echo $view_tank->getChassis_bonus()["light"] . "<br />"; ?>
 | low                        = <?php echo $view_tank->getChassis_bonus()["low"] . "<br />"; ?>
 | rear                        = <?php echo $view_tank->getChassis_bonus()["rear"] . "<br />"; ?>
 | sloped                        = <?php echo $view_tank->getChassis_bonus()["sloped"] . "<br />"; ?>
 | tires                        = <?php echo $view_tank->getChassis_bonus()["tires"] . "<br />"; ?>
 | treads                        = <?php echo $view_tank->getChassis_bonus()["treads"] . "<br />"; ?>
}}
<br /><?php
echo "==Requirements==<br />";
echo "&lt;tabber&gt;<br />";
if ($view_tank->getChapter() != NULL && array_search('1', $view_tank->getChapter()))
{
	echo "Drop =&lt;div title&gt;Can be obtained in the following volumes :&lt;br /&gt;<br />";
	$volumes = "";
	foreach ($view_tank->getChapter() as $key => $value)
	{
		if ($value == "1")
			$volumes .= str_replace("_", "-", "Volume " . $key . " | ");
	}
	for ($i = 1; $i <= 24; $i++)
	{
		$volumes_serie = "Volume ".$i."-1 | Volume ".$i."-2 | Volume ".$i."-3 | Volume ".$i."-4";
		$volumes = str_replace($volumes_serie, "Volume " . $i, $volumes);
	}
	$volumes = trim($volumes);
	if ($volumes[strlen($volumes) - 1] == "|")
		$volumes = trim(substr($volumes, 0, strlen($volumes) - 1));
	echo $volumes;
	echo "&lt;/div&gt;<br />|-|<br />";
}

if ($view_tank->getRefactor() > 0)
{
	echo "Refactor =&lt;div title&gt;[[File:Base_BWMG_depot.png]]<br />";
	echo "Appears in BWMG Depot " . $view_tank->getRefactor() . "&lt;/div&gt;<br />";
	echo "|-|<br />";
}

if ($view_tank->getNaval_port() > 0)
{
	echo "Naval Port =&lt;div title&gt;[[File:Base_naval_port.png]]<br />";
	echo "Requires Naval Port LV" . $view_tank->getNaval_port() . "&lt;/div&gt;<br />";
	echo "|-|<br />";
}

if ($view_tank->getForge() == 1)
{
	echo "Source Forge =&lt;div title&gt;[[File:Source_forge.png|x188px]]<br />";
	echo "Can be obtained at Source Forge&lt;/div&gt;<br />";
	echo "|-|<br />";
}

$form_values_array = ["method_1", "method_2", "method_3", "develop", "research"];
foreach($form_values_array as $form_value)
{
	if ($view_tank->getRequirements($form_value) != NULL)
	{
		$metalMaidensManager = new MetalMaidensManager($dbhandler);
		echo ucfirst(str_replace("_", " ", $form_value)) . " =&lt;div title&gt;{{Infobox_Metal_Maiden_Requirements_RD<br />";

		if ($view_tank->getRequirements($form_value)["commander_level"] != 0)
			echo " | commander_level = " . $view_tank->getRequirements($form_value)["commander_level"] . "<br />";

		for ($i = 1; $i <= 3; $i++)
		{
			if ($view_tank->getRequirements($form_value)["tank_" . $i] != NULL)
			{
				$tank_req = $metalMaidensManager->get($view_tank->getRequirements($form_value)["tank_" . $i]);
				echo " | metal_maiden_" . $i . " = " . $tank_req->getTank() . "<br />";
				echo " | metal_maiden_" . $i . "_rarity = " . ucfirst($tank_req->getRarity()) . "<br />";
				echo " | metal_maiden_" . $i . "_level = ";
				if ($view_tank->getRequirements($form_value)["tank_level_" . $i] != 0)
					echo $view_tank->getRequirements($form_value)["tank_level_" . $i];
				echo "<br />";
				echo " | metal_maiden_" . $i . "_rank = <br />";
			}
		}

		if ($view_tank->getRequirements($form_value)["blueprint_quantity"] != 0)
		{
			echo " | blueprint_rank = " . $view_tank->getRequirements($form_value)["blueprint"][strlen($view_tank->getRequirements($form_value)["blueprint"]) - 1] . "<br />";
			echo " | blueprint_quantity = " . $view_tank->getRequirements($form_value)["blueprint_quantity"] . "<br />";
		}
		
		if ($view_tank->getRequirements($form_value)["resource_quantity"] != 0)
		{
			$resource = $view_tank->getRequirements($form_value)["resource"];
			$resource = explode("_", $resource);
			for ($i = 0; $i < count($resource); $i++)
				$resource[$i] = ucfirst($resource[$i]);
			$resource = implode("_", $resource);
			echo " | resource = " . str_replace("_", " ", $resource) . "<br />";
			echo " | resource_quantity = " . $view_tank->getRequirements($form_value)["resource_quantity"] . "<br />";
		}
		
 		if ($view_tank->getRequirements($form_value)["equipment_quantity"] != 0)
 		{
 			$equipment = explode("_", $view_tank->getRequirements($form_value)["equipment"]);
 			$slot = array_shift($equipment);
 			$equipment = implode("_", $equipment);

			$equipment = explode("_", $equipment);
			for ($i = 0; $i < count($equipment); $i++)
				$equipment[$i] = ucfirst($equipment[$i]);
			$equipment = implode("_", $equipment);
 			echo " | equipment = " . str_replace("Lmg", "LMG", str_replace("Hmg", "HMG", str_replace("_", " ", $equipment))) . "<br />";
			echo " | equipment_rank = S" . $view_tank->getRequirements($form_value)["equipment_rank"] . "<br />";
			echo " | equipment_slot = " . $slot . "<br />";
			echo " | equipment_quantity = " . $view_tank->getRequirements($form_value)["equipment_quantity"] . "<br />";
 		}
 		
 		if ($view_tank->getRequirements($form_value)["dogtag"] != 0)
 			echo " | dogtag_quantity = " . $view_tank->getRequirements($form_value)["dogtag"] . "<br />";
 		
 		echo " | silver_quantity = " . number_format($view_tank->getRequirements($form_value)["silver"], 0, ',', ' ') . "<br />";
		echo "}}&lt;/div&gt;<br />";
		echo "|-|<br />";
	}
}
echo "&lt;/tabber&gt;";
?>
<br />
==Technology==

==Illustration==
<?php
$filename  = TANKS_DIR . "full/" . $view_tank->getImagename();
$filename .= ".png";

$file_headers = @get_headers($filename);

if (file_exists(utf8_decode($filename)))
{
?>
{| class="mw-collapsible mw-collapsed wikitable"
! Full illustration
|-
| [[File:<?php echo str_replace('/', '_', $view_tank->getTank() . "_full.png"); ?>]]
|}
<?php
}
?>
</pre>

<pre id="export_to_wiki_2" style="display: none;" class="wiki">
{{Infobox_Metal_Maiden_Statistics
 | firepower                                = <?php echo $view_tank->getFirepower() . "<br />"; ?>
 | penetration                                = <?php echo $view_tank->getPenetration() . "<br />"; ?>
 | durability                                = <?php echo $view_tank->getDurability() . "<br />"; ?>
 | armor                                = <?php echo $view_tank->getArmor() . "<br />"; ?>
 | targeting                                = <?php echo $view_tank->getTargeting() . "<br />"; ?>
 | evasion                                = <?php echo $view_tank->getEvasion() . "<br />"; ?>
 | stealth                                = <?php echo $view_tank->getStealth() . "<br />"; ?>
 | detection                                = <?php echo $view_tank->getDetection() . "<br />"; ?>
 | range_min                                = <?php if ($view_tank->getMin_range() != 0) echo number_format($view_tank->getMin_range(), 0, ',', ' '); echo "<br />"; ?>
 | range_max                                = <?php if ($view_tank->getMax_range() != 0) echo number_format($view_tank->getMax_range(), 0, ',', ' '); echo "<br />"; ?>
 | fire_resist                                = <?php echo $view_tank->getFire_resist() . "<br />"; ?>
 | crit_resist                                = <?php echo $view_tank->getCrit_resist() . "<br />"; ?>
 | crit_defense                                = <?php echo $view_tank->getCrit_defense() . "<br />"; ?>
}}
</pre>

<script>
    var hidden = true;
    function setVisibility() {
        hidden = !hidden;
        if (hidden) {
            document.getElementById('export_to_wiki').style.display = 'none';
        } else {
            document.getElementById('export_to_wiki').style.display = 'block';
        }
    }

    var hidden2 = true;
    function setVisibility2() {
        hidden2 = !hidden2;
        if (hidden2) {
            document.getElementById('export_to_wiki_2').style.display = 'none';
        } else {
            document.getElementById('export_to_wiki_2').style.display = 'block';
        }
    }
</script>