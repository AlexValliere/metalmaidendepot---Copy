Index :
<ul>
	<li>
		<a href="#metal_maidens">Metal maidens</a>
	</li>
	<li>
		<a href="#shell_modifiers">Shell modifiers</a>
	</li>
	<li>
		<a href="#shell_properties">Shell properties</a>
	</li>
	<li>
		<a href="#shells">Shells</a>
	</li>
	<li>
		<a href="#armors">Armors</a>
	</li>
	<li>
		<a href="#chassis">Chassis</a>
	</li>
	<li>
		<a href="#engines">Engines</a>
	</li>
	<li>
		<a href="#rd_prerequisite">R&amp;D prerequisite</a>
	</li>
	<li>
		<a href="#metal_maiden_armor_loadout">Metal maiden armor loadout</a>
	</li>
	<li>
		<a href="#metal_maiden_chassis_loadout">Metal maiden chassis loadout</a>
	</li>
	<li>
		<a href="#metal_maiden_engine_loadout">Metal maiden engine loadout</a>
	</li>
	<li>
		<a href="#metal_maiden_shell_loadout">Metal maiden shell loadout</a>
	</li>
</ul>

<span class="anchor" id="metal_maidens"></span>
<h3 class="page-header">Metal maidens</h3>
Tank_name,metal_maiden_name,category,rarity,nation,character_voice,live2d,firepower,penetration,targeting,durability,armor,evasion,stealth,detection,fire_resist,crit_resist,crit_defense,firepower_lvl60,penetration_lvl60,durability_lvl60,armor_lvl60,slot1#slot2#slot3#slot4#slot5#slot6#slot7#slot8,shell_category1#shell_category2#shell_category3...,engine_bonus1#engine_bonus2#engine_bonus3...,chassis_bonus1#chassis_bonus2#chassis_bonus3...,lifestyle_skill1#lifestyle_skill1_level,lifestyle_skill2#lifestyle_skill2_level,lifestyle_skill3#lifestyle_skill3_level
<br /><br />
<?php
foreach ($tank_list as $tank)
{
	echo $tank->getTank();
	echo ',' . $tank->getName();
	echo ',' . $tank->getCategory();
	echo ',' . $tank->getRarity();
	echo ',' . $tank->getNation();
	echo ',' . $tank->getCharacter_voice();
	echo ',' . $tank->getLive2D();
	echo ',' . $tank->getFirepower();
	echo ',' . $tank->getPenetration();
	echo ',' . $tank->getTargeting();
	echo ',' . $tank->getDurability();
	echo ',' . $tank->getArmor();
	echo ',' . $tank->getEvasion();
	echo ',' . $tank->getStealth();
	echo ',' . $tank->getDetection();
	echo ',' . $tank->getFire_resist();
	echo ',' . $tank->getCrit_resist();
	echo ',' . $tank->getCrit_defense();
	echo ',' . $tank->getFirepower_lvl60();
	echo ',' . $tank->getDurability_lvl60();
	echo ',' . $tank->getArmor_lvl60();
	echo ',' . $tank->getPenetration_lvl60();

	echo ',';
	$i = 0;
	foreach ($tank->getEquipment_slots() as $slot => $equipment_slot)
	{
		++$i;
		if ($equipment_slot != "null")
			echo $equipment_slot;
		else
			echo "NULL";
		if ($i < 8)
			echo '#';
	}

	echo ',';
	$i = 0;
	foreach ($tank->getAmmo() as $missile => $value)
	{
		if ($value == "1")
		{
			if ($i != 0)
				echo '#';

			echo $missile;
			++$i;

		}
	}

	echo ',';
	$i = 0;
	foreach ($tank->getEngine_bonus() as $engine_bonus => $value)
	{
		if ($value == "1")
		{
			if ($i != 0)
				echo '#';

			echo $engine_bonus;
			++$i;

		}
	}

	echo ',';
	$i = 0;
	foreach ($tank->getChassis_bonus() as $chassis_bonus => $value)
	{
		if ($value == "1")
		{
			if ($i != 0)
				echo '#';

			echo $chassis_bonus;
			++$i;

		}
	}

	echo ',';
	$i = 0;
	for ($j = 1; $j <= 3; ++$j)
	{
		if ($i != 0)
			echo ',';

		if (isset($tank->getLifestyle_skills()["skill_$j"]) && $tank->getLifestyle_skills()["skill_$j"] != "null")
			echo $tank->getLifestyle_skills()["skill_$j"] . '#' . $tank->getLifestyle_skills()["skill_".$j."_level"];
		else
			echo "NULL#0";
		++$i;
	}

	echo '<br />';
}
?>
<br /><br />

<span class="anchor" id="shell_modifiers"></span>
<h3 class="page-header">Shell modifiers</h3>
icon name<strong style="color: orangered; font-size: large;">;</strong>description
<br /><br />
<?php
foreach($new_shell_modifiers as $shell_modifier_icon_name => $shell_modifier_description)
{
	echo $shell_modifier_icon_name . '<strong style="color: orangered; font-size: large;">;</strong>' . $shell_modifier_description . "<br />";
}
?>
<br /><br />

<span class="anchor" id="shell_properties"></span>
<h3 class="page-header">Shell properties</h3>
name<strong style="color: orangered; font-size: large;">;</strong>description
<br /><br />
<?php
foreach($new_shell_properties as $shell_property_name => $shell_property_description)
{
	echo $shell_property_name . '<strong style="color: orangered; font-size: large;">;</strong>' . $shell_property_description .  '<br />';
}
?>
<br /><br />

<span class="anchor" id="shells"></span>
<h3 class="page-header">Shells</h3>
name,category,tier,level,evasion,firepower,penetration,stealth,targeting,property1#property2#property3...,modifier1#modifier2#modifier3...
<br /><br />
<?php
foreach ($shell_list as $shell)
{
	if ($shell->getTier() != NULL)
	{
		echo $shell->getName();
		echo ',' . $shell->getCategory();
		echo ',' . $shell->getTier();
		echo ',' . $shell->getLevel();

		foreach (["evasion", "firepower", "penetration", "stealth", "targeting"] as $attribute)
		{
			$attribute_value = $shell->{'get' . $attribute}();
			if ($attribute_value == NULL)
				$attribute_value = 0;

			echo ',' . $attribute_value;
		}

		echo ',';
		$i = 0;
		foreach ($shell->getShell_properties_ids() as $shell_property_id)
		{
			$shell_property_id--;

			if ($i != 0)
				echo '#';

			echo $shell_properties[$shell_property_id]["name"];

			++$i;
		}

		foreach ($shell->getShell_modifiers_ids() as $shell_modifier_id)
		{
			$shell_modifier_id--;

			$exploded_description = explode(" : ", $shell_modifiers[$shell_modifier_id]["description"]);

			if ( array_key_exists($exploded_description[0], $new_shell_properties ) )
			{
				if ($i != 0)
					echo '#';
				echo $exploded_description[0];
				++$i;
			}
		}

		echo ',';
		$i = 0;
		foreach ($shell->getShell_modifiers_ids() as $shell_modifier_id)
		{
			$shell_modifier_id--;

			$exploded_description = explode(" : ", $shell_modifiers[$shell_modifier_id]["description"]);

			if ( !array_key_exists($exploded_description[0], $new_shell_properties ) )
			{
				if ($i != 0)
					echo '#';

				$name_from_icon = str_replace("_", " ", str_replace(".png", "", explode("_-_", $shell_modifiers[$shell_modifier_id]["icon_file_name"])[1]));

				echo $name_from_icon;
				++$i;
			}
		}

		echo '<br />';
	}
}
?>
<br /><br />
<span class="anchor" id="armors"></span>
<h3 class="page-header">Armors</h3>
name,category,tier,level,armor,durability,evasion,stealth,targeting,hasCast,hasComposite,hasHardened,hasRiveted,hasSpaced,hasTempered,hasWedge,hasWelded
<br /><br />
<?php
foreach ($armor_list as $armor)
{
	echo $armor->getName();
	echo ',' . $armor->getCategory();
	echo ',' . $armor->getTier();
	echo ',' . $armor->getLevel();
	echo ',' . $armor->getArmor();
	echo ',' . $armor->getDurability();
	echo ',' . $armor->getEvasion();
	echo ',' . $armor->getStealth();
	echo ',' . $armor->getTargeting();
	echo ',' . $armor->getCast();
	echo ',' . $armor->getComposite();
	echo ',' . $armor->getHardened();
	echo ',' . $armor->getRiveted();
	echo ',' . $armor->getSpaced();
	echo ',' . $armor->getTempered();
	echo ',' . $armor->getWedge();
	echo ',' . $armor->getWelded();
	echo '<br />';
}
?>
<br /><br />
<span class="anchor" id="chassis"></span>
<h3 class="page-header">Chassis</h3>
name,tier,level,armor,detection,durability,evasion,firepower,penetration,stealth,targeting,hasAngled,hasFlatTop,hasFront,hasLight,hasLow,hasRear,hasSloped,hasTires,hasTreads
<br /><br />
<?php
foreach ($chassis_list as $chassis)
{
	echo $chassis->getName();
	echo ',' . $chassis->getTier();
	echo ',' . $chassis->getLevel();
	echo ',' . $chassis->getArmor();
	echo ',' . $chassis->getDetection();
	echo ',' . $chassis->getDurability();
	echo ',' . $chassis->getEvasion();
	echo ',' . $chassis->getFirepower();
	echo ',' . $chassis->getPenetration();
	echo ',' . $chassis->getStealth();
	echo ',' . $chassis->getTargeting();
	echo ',' . $chassis->getAngled();
	echo ',' . $chassis->getFlat_top();
	echo ',' . $chassis->getFront();
	echo ',' . $chassis->getLight();
	echo ',' . $chassis->getLow();
	echo ',' . $chassis->getRear();
	echo ',' . $chassis->getSloped();
	echo ',' . $chassis->getTires();
	echo ',' . $chassis->getTreads();
	echo '<br />';
}
?>
<br /><br />
<span class="anchor" id="engines"></span>
<h3 class="page-header">Engines</h3>
name,tier,level,detection,durability,evasion,stealth,targeting,hasCProof,hasDProof,hasHProof,hasSProof,hasWProof,hasSilent
<br /><br />
<?php
foreach ($engine_list as $engine)
{
	echo $engine->getName();
	echo ',' . $engine->getTier();
	echo ',' . $engine->getLevel();
	echo ',' . $engine->getDetection();
	echo ',' . $engine->getDurability();
	echo ',' . $engine->getEvasion();
	echo ',' . $engine->getStealth();
	echo ',' . $engine->getTargeting();
	echo ',' . $engine->getC_proof();
	echo ',' . $engine->getD_proof();
	echo ',' . $engine->getH_proof();
	echo ',' . $engine->getS_proof();
	echo ',' . $engine->getW_proof();
	echo ',' . $engine->getSilent();
	echo '<br />';
}
?>
<br /><br />
<span class="anchor" id="rd_prerequisite"></span>
<h3 class="page-header">R&amp;D prerequisite</h3>
method_number,tank_name,required_commander_level,required_tank_name_1,required_tank_name_2,required_tank_name_3,required_tank_level_1,required_tank_level_2,required_tank_level_3,dogtag,resource_name,resource_quantity,blueprint_level,blueprint_quantity,required_item,required_item_slot,required_item_level,required_item_quantity,silver
<br /><br />
<?php
foreach ( $tank_list as $tank )
{
	if ( $tank->getRequirements( "method_1" ) != NULL )
	{
		for ( $i = 1; $i <= 3; $i++ )
		{
			$method = "method_" . $i;

			if ( $tank->getRequirements( $method ) != NULL && $tank->getRequirements( $method )["tank_" . $i] != NULL )
			{
				echo $i . "," . $tank->getTank() . ",";

				if ( $tank->getRequirements( $method )["commander_level"] != 0 )
					echo $tank->getRequirements( $method )["commander_level"] . ",";
				else
					echo ",";

				for ( $j = 1; $j <= 3; $j++ )
				{
					if ( $tank->getRequirements( $method )["tank_" . $j] != NULL )
					{
						$tank_req = $metalMaidensManager->get( $tank->getRequirements( $method )["tank_" . $j] );
						echo $tank_req->getTank();
					}
					echo ",";
				}

				for ( $j = 1; $j <= 3; $j++ )
				{
					if ( $tank->getRequirements( $method )["tank_" . $j] != NULL )
					{
						echo $tank->getRequirements( $method )["tank_level_" . $j];
					}
					echo ",";
				}

				echo $tank->getRequirements( $method )["dogtag"] . ",";

				if ( $tank->getRequirements( $method )["resource_quantity"] != 0 )
				{
					echo str_replace( "_", " ", $tank->getRequirements( $method )["resource"] ) . "," . $tank->getRequirements( $method )["resource_quantity"] . ",";
				}
				else
					echo ",0,";

				if ( $tank->getRequirements( $method )["blueprint_quantity"] != 0 )
				{
					echo str_replace("blueprint_n", "", $tank->getRequirements( $method )["blueprint"] ) . "," . $tank->getRequirements( $method )["blueprint_quantity"] . ",";
				}
				else
					echo ",0,";

				if ( $tank->getRequirements( $method )["equipment_quantity"] != 0 )
				{
					$equipment = explode( "_", $tank->getRequirements( $method )["equipment"] );
					$slot = array_shift( $equipment );
					$equipment = str_replace("_", " ", implode( "_", $equipment ) );

					echo $equipment . "," . $slot . "," . $tank->getRequirements( $method )["equipment_rank"] . "," . $tank->getRequirements( $method )["equipment_quantity"] . ",";
				}
				else
					echo ",,,0,";

				echo $tank->getRequirements( $method )["silver"];

				echo "<br />";
			}
		}
	}
}
?>
<br /><br />
<span class="anchor" id="metal_maiden_armor_loadout"></span>
<h3 class="page-header">Metal maiden armor loadout</h3>
tank_name,item_category,armor_name
<br /><br />
<?php
foreach ( $tank_list as $tank )
{
	$armor_ids = $tank->getArmor_ids();

	if ( !empty( $armor_ids ) )
	{
		foreach ( $armor_ids as $armor_id )
		{
			if ( isset( $armor_indexed[$armor_id] ) )
			{
				echo $tank->getTank() . ",armor," . $armor_indexed[$armor_id]->getName() . "<br />";
			}
		}
	}
}
?>

<br /><br />
<span class="anchor" id="metal_maiden_chassis_loadout"></span>
<h3 class="page-header">Metal maiden chassis loadout</h3>
tank_name,item_category,chassis_name
<br /><br />
<?php
foreach ( $tank_list as $tank )
{
	$chassis_ids = $tank->getChassis_ids();

	if ( !empty( $chassis_ids ) )
	{
		foreach ( $chassis_ids as $chassis_id )
		{
			if ( isset( $chassis_indexed[$chassis_id] ) )
			{
				echo $tank->getTank() . ",chassis," . $chassis_indexed[$chassis_id]->getName() . "<br />";
			}
		}
	}
}
?>

<br /><br />
<span class="anchor" id="metal_maiden_engine_loadout"></span>
<h3 class="page-header">Metal maiden engine loadout</h3>
tank_name,item_category,engine_name
<br /><br />
<?php
foreach ( $tank_list as $tank )
{
	$engine_ids = $tank->getEngine_ids();

	if ( empty( $engine_ids ) )
	{
		$engines_array = $tank->getEngines();

		foreach ( $engines_array as $engine_item )
		{
			$engine_ids[] = $engine_item->getId();
		}
	}

	if ( !empty( $engine_ids ) )
	{
		foreach ( $engine_ids as $engine_id )
		{
			if ( isset( $engine_indexed[$engine_id] ) )
			{
				echo $tank->getTank() . ",engine," . $engine_indexed[$engine_id]->getName() . "<br />";
			}
		}
	}
}
?>

<br /><br />
<span class="anchor" id="metal_maiden_shell_loadout"></span>
<h3 class="page-header">Metal maiden shell loadout</h3>
tank_name,item_category,shell_category,shell_name,shell_range
<br /><br />
<?php
foreach ( $tank_list as $tank )
{
	$shell_ids = $tank->getShell_ids();
	$attached_shell_ids = $metalMaidensManager->get_attached_shells($tank);

	if ( !empty( $shell_ids ) )
	{
		foreach ( $shell_ids as $shell_id )
		{
			if ( isset( $shell_indexed[$shell_id] ) )
			{
				echo $tank->getTank() . ",shell," . $shell_indexed[$shell_id]->getCategory() . "," . $shell_indexed[$shell_id]->getName() . "," . $attached_shell_ids[$shell_id]["shell_range"] . "<br />";
			}
		}
	}
}
?>

<?php
foreach ( $tank_list as $tank )
{
/*	$armor_ids = $tank->getArmor_ids();
	$chassis_ids = $tank->getChassis_ids();
	$engine_ids = $tank->getEngine_ids();
	$shell_ids = $tank->getShell_ids();
	$attached_shell_ids = $metalMaidensManager->get_attached_shells($tank);

	if ( empty( $engine_ids ) )
	{
		$engines_array = $tank->getEngines();

		foreach ( $engines_array as $engine_item )
		{
			$engine_ids[] = $engine_item->getId();
		}
	}

	foreach ( $indexes as $index )
	{
		if ( !empty( ${$index . "_ids"} ) )
		{
			foreach ( ${$index . "_ids"} as $item_id )
			{
				if ( isset( ${$index . "_indexed"}[$item_id] ) )
				{
					echo $tank->getTank() . "," . $index . "," . ${$index . "_indexed"}[$item_id]->getName() . ",";

					if ( $index == "shell" )
					{
						echo $attached_shell_ids[$item_id]["shell_range"];
					}

					echo "<br />";
				}
			}
		}
	}*/
}
?>