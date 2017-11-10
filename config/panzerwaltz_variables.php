<?php
$pw_game_versions = array(
	"1.10.1.6",
	"1.10.1.8",
	"1.10.1.10",
	"1.11.1.1",
	"1.11.1.2",
	"1.11.1.3",
	"1.11.1.4",
	"1.11.1.5",
	"1.11.1.6",
	"1.11.1.7",
	"1.12.1.1",
	"1.12.1.2",
	"1.12.1.3",
	"1.12.1.4",
	"1.12.1.5",
	"1.12.1.6",
	"1.12.1.7",
	"1.12.1.8",
	"1.12.1.9"
);

$pw_ammo = array(
	"ap"	=> "Conventional",
	"apcr"	=> "Composite-Rigid",
	"apds"	=> "Discarding-Sabot",
	"he"	=> "High-Explosive",
	"heat"	=> "Anti-Tank",
	"hesh"	=> "Squash-Head",
	"rp"	=> "Rocket-Propelled"
);

$pw_armor = ["heavy", "light", "standard"];

$pw_ammo_description = array(
	"ap"	=> "<span style='color: orange;'>[AP]</span> Conventional",
	"apcr"	=> "<span style='color: orange;'>[APCR]</span> Composite-Rigid",
	"apds"	=> "<span style='color: orange;'>[APDS]</span> Discarding Sabot",
	"he"	=> "<span style='color: orange;'>[HE]</span> High-Explosive",
	"heat"	=> "<span style='color: orange;'>[HEAT]</span> Anti-Tank",
	"hesh"	=> "<span style='color: orange;'>[HESH]</span> Squash-Head",
	"rp"	=> "<span style='color: orange;'>[RP]</span> Rocket-Propelled"
);

$pw_armor_description = array(
	"cast"		=> "<span style='color: orange;'>[Cast]</span> Increase ricochet chance during Shelling for [AP] and [AT]",
	"composite"	=> "<span style='color: orange;'>[Composite]</span> Greatly reduces combustion chance of [AT]",
	"hardened"	=> "<span style='color: orange;'>[Hardened]</span> Weak against high armor penetration shots",
	"riveted"	=> "<span style='color: orange;'>[Riveted]</span> Chance during Shelling to avoid [HE] armor debuff",
	"spaced"	=> "<span style='color: orange;'>[Spaced]</span> Reduces combustion and crit chance of [AT] and [SH]",
	"tempered"	=> "<span style='color: orange;'>[Tempered]</span> Strong against high armor penetration shots",
	"wedge"		=> "<span style='color: orange;'>[Wedge]</span> Increases ricochet chance for [AP] and [AT]",
	"welded"	=> "<span style='color: orange;'>[Welded]</span> Reduces enemy crit chance during Shelling"
);

$pw_chassis_description = array(
	"angled"	=> "<span style='color: orange;'>[Angled]</span> Immune to [Broad] terrain effect : <span style='color: #e91e63;'>[Plains]</span> During Shelling stage, <span style='color: #e91e63;'>Firepower</span> is drastically reduced",
	"flat_top"	=> "<span style='color: orange;'>[Flat-top]</span> Increases ricochet chance for [AP] and [AT] attacks",
	"front"		=> "<span style='color: orange;'>[Front]</span> Immune to [Bushy] terrain effect : <span style='color: #e91e63;'>[Forest]</span> Troughout the battle, <span style='color: #e91e63;'>Firepower</span> is reduced",
	"light"		=> "<span style='color: orange;'>[Light]</span> Immune to [Rocky] terrain effect : <span style='color: #e91e63;'>[Rocky]</span> Troughout the battle, <span style='color: #e91e63;'>Targeting</span> is reduced",
	"low"		=> "<span style='color: orange;'>[Low]</span> Immune to [Trap] terrain effect : <span style='color: #e91e63;'>[Street]</span> Troughout the battle, chance of being hit by a critical hit is increased (<span style='color: #e91e63;'>Critical resistance</span> down)",
	"rear"		=> "<span style='color: orange;'>[Rear]</span> Immune to [Swamp] terrain effect : <span style='color: #e91e63;'>[Dirt]</span> Troughout the battle, <span style='color: #e91e63;'>Penetration</span> is reduced",
	"sloped"	=> "<span style='color: orange;'>[Sloped]</span> Increases ricochet chance for [AP] and [AT] attacks",
	"tires"		=> "<span style='color: orange;'>[Tires]</span> Immune to [Flat] terrain effect : <span style='color: #e91e63;'>[Rocky]</span> Troughout the battle, <span style='color: #e91e63;'>Armor</span> is reduced",
	"treads"	=> "<span style='color: orange;'>[Treads]</span> Immune to [Snowy] terrain effect : <span style='color: #e91e63;'>[Snow]</span> Troughout the battle, <span style='color: #e91e63;'>Evasion</span> is reduced"
);

$pw_engine_description = array(
	"c_proof"	=> "<span style='color: orange;'>[C Proof]</span> Immune to [Cold] terrain effect : <span style='color: #e91e63;'>[Snow]</span> Troughout the battle, <span style='color: #e91e63;'>Damage received</span> is increased",
	"d_proof"	=> "<span style='color: orange;'>[D Proof]</span> Immune to [Dusty] terrain effect : <span style='color: #e91e63;'>[Desert]</span> Troughout the battle, <span style='color: #e91e63;'>Damage received</span> is increased",
	"h_proof"	=> "<span style='color: orange;'>[H Proof]</span> Immune to [Hot] terrain effect : <span style='color: #e91e63;'>[Desert]</span> Troughout the battle, <span style='color: #e91e63;'>Fire resistance</span> is drastically reduced",
	"s_proof"	=> "<span style='color: orange;'>[S Proof]</span> Immune to [Steep] terrain effect : <span style='color: #e91e63;'>[Hills]</span> Starting from contact stage, <span style='color: #e91e63;'>Evasion</span> is drastically reduced",
	"w_proof"	=> "<span style='color: orange;'>[W Proof]</span> Immune to [Wet] terrain effect : <span style='color: #e91e63;'>[Dirt]</span> Troughout the battle, <span style='color: #e91e63;'>Detection</span> is drastically reduced",
	"silent"	=> "<span style='color: orange;'>[Silent]</span> Immune to [Exposed] terrain effect : <span style='color: #e91e63;'>[Valley]</span> Troughout the battle, <span style='color: #e91e63;'>Stealth</span> is drastically reduced"
);

$pw_tank_categories = array(
	"atg"	=> "Anti-Gun",
	"ht"	=> "Heavy Tank",
	"lav"	=> "Light Armored Vehicle",
	"lt"	=> "Light Tank",
	"mt"	=> "Medium Tank",
	"spg"	=> "Self-Propelled Gun"
);

$pw_tank_armor_by_categories = array(
	"atg"	=> "heavy",
	"ht"	=> "heavy",
	"lav"	=> "light",
	"lt"	=> "standard",
	"mt"	=> "standard",
	"spg"	=> "light"
);

$pw_tank_rarities = array(
	"blue"		=> 1,
	"purple"	=> 2,
	"gold"		=> 3
);

$pw_nations = ["bavaria", "britannia", "freedonia", "gallia", "fusang", "rossiya", "national_flag-08", "sweden", "china", "stivalia", "national_flag-11", "national_flag-12"];
$pw_tank_attributes = ["firepower", "penetration", "targeting", "durability", "armor", "evasion", "stealth", "detection"];
$pw_tank_attributes_lvl60 = ["firepower_lvl60", "penetration_lvl60", "durability_lvl60", "armor_lvl60"];
$pw_tank_hidden_attributes = ["fire_resist", "crit_resist", "crit_defense"];
$pw_tank_all_attributes = array_merge($pw_tank_attributes, $pw_tank_attributes_lvl60, $pw_tank_hidden_attributes);
$pw_talents = ["artistry", "cooking", "crafting", "nursing", "performing", "sports"];

$pw_tanks_indexed = 330;

$pw_terrains_counter = array(
	"broad"		=> "angled",
	"bushy"		=> "front",
	"cold"		=> "c_proof",
	"dusty"		=> "d_proof",
	"exposed"	=> "silent",
	"flat"		=> "tires",
	"hot"		=> "h_proof",
	"rocky"		=> "light",
	"snowy"		=> "treads",
	"steep"		=> "s_proof",
	"swamp"		=> "rear",
	"trap"		=> "low",
	"wet"		=> "w_proof"
);

$pw_terrains_effect = array(
	"broad"		=> "During Shelling stage, <span style='color: #e91e63;'>Firepower</span> is drastically reduced",
	"bushy"		=> "Troughout the battle, <span style='color: #e91e63;'>Firepower</span> is reduced",
	"cold"		=> "Troughout the battle, <span style='color: #e91e63;'>Damage received</span> is increased",
	"dusty"		=> "Troughout the battle, <span style='color: #e91e63;'>Damage received</span> is increased",
	"exposed"	=> "Troughout the battle, <span style='color: #e91e63;'>Stealth</span> is drastically reduced",
	"flat"		=> "Troughout the battle, <span style='color: #e91e63;'>Armor</span> is reduced",
	"hot"		=> "Troughout the battle, <span style='color: #e91e63;'>Fire resistance</span> is drastically reduced",
	"rocky"		=> "Troughout the battle, <span style='color: #e91e63;'>Targeting</span> is reduced",
	"snowy"		=> "Troughout the battle, <span style='color: #e91e63;'>Evasion</span> is reduced",
	"steep"		=> "Starting from contact stage, <span style='color: #e91e63;'>Evasion</span> is drastically reduced",
	"swamp"		=> "Troughout the battle, <span style='color: #e91e63;'>Penetration</span> is reduced",
	"trap"		=> "Troughout the battle, chance of being hit by a critical hit is increased (<span style='color: #e91e63;'>Critical resistance</span> down)",
	"wet"		=> "Troughout the battle, <span style='color: #e91e63;'>Detection</span> is drastically reduced"
);

$pw_terrains_effect_mini = array(
	"broad"		=> "Firepower <span class='glyphicon glyphicon-sort-by-attributes-alt' style='color: #e91e63;' aria-hidden='true'></span>",
	"bushy"		=> "Firepower <span class='glyphicon glyphicon-sort-by-attributes-alt' style='color: #e91e63;' aria-hidden='true'></span>",
	"cold"		=> "Damage received <span class='glyphicon glyphicon-sort-by-attributes' style='color: #e91e63;' aria-hidden='true'></span>",
	"dusty"		=> "Damage received <span class='glyphicon glyphicon-sort-by-attributes' style='color: #e91e63;' aria-hidden='true'></span>",
	"exposed"	=> "Stealth <span class='glyphicon glyphicon-sort-by-attributes-alt' style='color: #e91e63;' aria-hidden='true'></span>",
	"flat"		=> "Armor <span class='glyphicon glyphicon-sort-by-attributes-alt' style='color: #e91e63;' aria-hidden='true'></span>",
	"hot"		=> "Fire resistance <span class='glyphicon glyphicon-sort-by-attributes-alt' style='color: #e91e63;' aria-hidden='true'></span>",
	"rocky"		=> "Targeting <span class='glyphicon glyphicon-sort-by-attributes-alt' style='color: #e91e63;' aria-hidden='true'></span>",
	"snowy"		=> "Evasion <span class='glyphicon glyphicon-sort-by-attributes-alt' style='color: #e91e63;' aria-hidden='true'></span>",
	"steep"		=> "Evasion <span class='glyphicon glyphicon-sort-by-attributes-alt' style='color: #e91e63;' aria-hidden='true'></span>",
	"swamp"		=> "Penetration <span class='glyphicon glyphicon-sort-by-attributes-alt' style='color: #e91e63;' aria-hidden='true'></span>",
	"trap"		=> "Critical resistance <span class='glyphicon glyphicon-sort-by-attributes-alt' style='color: #e91e63;' aria-hidden='true'></span>",
	"wet"		=> "Detection <span class='glyphicon glyphicon-sort-by-attributes-alt' style='color: #e91e63;' aria-hidden='true'></span>"
);

$pw_weather = array(
	"crushed_ice"	=> ["cold", "rocky"],
	"desert"		=> ["dusty", "hot"],
	"dirt"			=> ["swamp", "wet"],
	"grass"			=> [],
	"muddy_snow"	=> ["snowy", "swamp"],
	"rocky"			=> ["flat", "rocky"],
	"rocky_desert"	=> ["flat", "hot"],
	"shoals"		=> ["dusty", "wet"],
	"snow"			=> ["snowy", "cold"]
);

$pw_grounds = array(
	"forest"	=> ["bushy"],
	"hills"		=> ["steep"],
	"plains"	=> ["broad"],
	"streets"	=> ["trap"],
	"valley"	=> ["exposed"]
);

$pw_terrains = array(
	"dirt streets" => array_merge($pw_weather["dirt"], $pw_grounds["streets"]),
	"rocky streets" => array_merge($pw_weather["rocky"], $pw_grounds["streets"]),
	"snow streets" => array_merge($pw_weather["snow"], $pw_grounds["streets"]),
	"grass forest" => array_merge($pw_weather["grass"], $pw_grounds["forest"]),
	"dirt forest" => array_merge($pw_weather["dirt"], $pw_grounds["forest"]),
	"snow forest" => array_merge($pw_weather["snow"], $pw_grounds["forest"]),
	"grass hills" => array_merge($pw_weather["grass"], $pw_grounds["hills"]),
	"desert hills" => array_merge($pw_weather["desert"], $pw_grounds["hills"]),
	"desert valley" => array_merge($pw_weather["desert"], $pw_grounds["valley"]),
	"rocky valley" => array_merge($pw_weather["rocky"], $pw_grounds["valley"]),
	"snow valley" => array_merge($pw_weather["snow"], $pw_grounds["valley"]),
	"grass plains" => array_merge($pw_weather["grass"], $pw_grounds["plains"]),
	"dirt plains" => array_merge($pw_weather["dirt"], $pw_grounds["plains"]),
	"snow plains" => array_merge($pw_weather["snow"], $pw_grounds["plains"]),
	"crushed ice streets" => array_merge($pw_weather["crushed_ice"], $pw_grounds["streets"]),
	"shoals forest" => array_merge($pw_weather["shoals"], $pw_grounds["forest"]),
	"shoals hills" => array_merge($pw_weather["shoals"], $pw_grounds["hills"]),
	"muddy snow forest" => array_merge($pw_weather["muddy_snow"], $pw_grounds["forest"]),
	"crushed ice valley" => array_merge($pw_weather["crushed_ice"], $pw_grounds["valley"]),
	"rocky desert plains" => array_merge($pw_weather["rocky_desert"], $pw_grounds["plains"]),
	"cocpvp 02" => array_merge($pw_weather["rocky_desert"], $pw_grounds["streets"])
);

$pw_resources = array(
	"blueprints"		=>	array(
		"blueprint_n1",
		"blueprint_n2",
		"blueprint_n3",
		"blueprint_n4",
		"blueprint_n5",
		"blueprint_n6",
		"blueprint_n7",
		"blueprint_n8",
		"blueprint_n9"
	),
	"bwmg_resources"	=> array(
		"dext",
		"irid",
		"trit"
	),
	"main"				=> array(
		"codon",
		"diesel",
		"fate_pin",
		"g_corn",
		"g_iron",
		"g_milk",
		"gold_stack",
		"petrol",
		"silver",
	),
	"research"			=> array(
		"dogtag",
		"g_corn",
		"processor",
		"secret_plan",
		"test_doll",
		"wreck",
		"voucher",
		"mechanical_skeleton"
	),
	"equipment"			=> array(
		"active_detector",
		"armour_plate",
		"armrest",
		"aux_engine",
		"binoculars",
		"cabin",
		"camouflage",
		"counterrecoil",
		"cushions",
		"electric_detector",
		"electric_switch",
		"evacuator",
		"extinguisher",
		"fuel_filter",
		"gun_rammer",
		"gun_stabilizer",
		"hmg",
		"lmg",
		"lubricant",
		"periscope",
		"propellant",
		"reactive_armour",
		"skirt_armour",
		"smoke_launcher",
		"spall_liner",
		"spare_tracks",
		"suppressor",
		"torsion_bar",
		"trail",
		"wet_rack"
	),
	"equipment_by_slot"	=> array(
		"turret"		=> array(
			"active_detector",
			"armor_plate",
			"counterrecoil",
			"gun_rammer",
			"hmg",
			"lmg",
			"propellant",
			"reactive_armor",
			"smoke_launcher",
			"spare_tracks"
		),
		"mod"		=> array(
			"active_detector",
			"armor_plate",
			"evacuator",
			"gun_rammer",
			"lubricant",
			"periscope",
			"propellant",
			"reactive_armor",
			"skirt_armor",
			"suppressor"
		),
		"external"		=> array(
			"armrest",
			"camouflage",
			"cushions",
			"lubricant",
			"periscope",
			"smoke_launcher",
			"spall_liner",
			"spare_tracks",
			"torsion_bar"
		),
		"cabin"		=> array(
			"aux_engine",
			"cabin",
			"electric_detector",
			"electric_switch",
			"extinguisher",
			"fuel_filter",
			"gun_stabilizer",
			"torsion_bar",
			"wet_rack"
		),
		"internal"		=> array(
			"active_detector",
			"binoculars",
			"camouflage",
			"cushions",
			"extinguisher",
			"fuel_filter",
			"gun_stabilizer",
			"lubricant",
			"smoke_launcher",
			"wet_rack"
		),
		"carriage"		=> array(
			"aux_engine",
			"camouflage",
			"electric_detector",
			"electric_switch",
			"spare_tracks",
			"suppressor",
			"trail",
			"wet_rack"
		),
		"special"		=> array(
			"armor_plate",
			"aux_engine",
			"binoculars",
			"counterrecoil",
			"evacuator",
			"gun_rammer",
			"gun_stabilizer",
			"propellant",
			"skirt_armor",
			"suppressor"
		)
	)
);
?>