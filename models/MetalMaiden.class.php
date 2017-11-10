<?php
class MetalMaiden implements JsonSerializable
{
	protected $_id;
	
	protected $_ammo;
	protected $_ammo_game_version;
	protected $_profile_game_version;
	protected $_category;
	protected $_character_voice;
	protected $_chassis_bonus;
	protected $_engine_bonus;
	protected $_equipment_slots;
	protected $_lifestyle_skills;
	protected $_live2d;
	protected $_live2d_name;
	protected $_name;
	protected $_nation;
	protected $_rarity;
	protected $_root_head_id;
	protected $_tank;
	protected $_hidden;
	protected $_created_on;
	protected $_updated_on;

	protected $_firepower;
	protected $_penetration;
	protected $_durability;
	protected $_armor;
	protected $_stealth;
	protected $_detection;
	protected $_targeting;
	protected $_evasion;
	protected $_fire_resist;
	protected $_crit_resist;
	protected $_crit_defense;
	protected $_firepower_lvl60;
	protected $_penetration_lvl60;
	protected $_durability_lvl60;
	protected $_armor_lvl60;
	protected $_min_range;
	protected $_max_range;

	protected $_forge;
	protected $_naval_port;
	protected $_refactor;
	protected $_chapter;
	protected $_method_1;
	protected $_method_2;
	protected $_method_3;
	protected $_develop;
	protected $_research;

	protected $_quote_intro;
	protected $_quote_main_screen_1;
	protected $_quote_main_screen_2;
	protected $_quote_main_screen_3;
	protected $_quote_main_screen_4;
	protected $_quote_main_screen_5;
	protected $_quote_main_screen_6;
	protected $_quote_upgrading;
	protected $_quote_pre_attack_1;
	protected $_quote_pre_attack_2;
	protected $_quote_pre_attack_3;
	protected $_quote_on_attack_1;
	protected $_quote_on_attack_2;
	protected $_quote_on_attack_3;
	protected $_quote_on_attack_4;
	protected $_quote_on_attack_5;
	protected $_quote_on_attack_6;
	protected $_quote_on_attack_7;
	protected $_quote_getting_hit;
	protected $_quote_upon_destruction;
	protected $_quote_added_to_squad;
	protected $_quote_choice_of_essential_equipment_1;
	protected $_quote_choice_of_essential_equipment_2;
	protected $_quote_choice_of_essential_equipment_3;
	protected $_quote_choice_of_essential_equipment_4;
	protected $_quote_when_updating_equipment_1;
	protected $_quote_when_updating_equipment_2;
	protected $_quote_when_updating_equipment_3;
	protected $_quote_unequip_all_gear;
	protected $_quote_battle_victory_1;
	protected $_quote_battle_victory_2;
	protected $_quote_battle_victory_3;
	protected $_quote_battle_loss;
	protected $_quote_fate;

	protected $_armor_ids;
	protected $_chassis_ids;
	protected $_engine_ids;
	protected $_shell_ids;

	static $verbose = false;

	public function __construct( array $kwargs ) {
		$this->hydrate($kwargs);

		if (self::$verbose == True)
		{
			echo '[Creating Metal Maiden';
			echo ' | id = ' . $this->getId();
			echo ' | tank = ' . $this->getTank();
			echo ' | tank_slug = ' . $this->getTank_slug();
			echo ' | name = ' . $this->getName();
			echo ' | category = ' . $this->getCategory();
			echo ' | nation = ' . $this->getNation();
			echo ' | rarity = ' . $this->getRarity();
			echo ' | hidden = ' . $this->getHidden();
			echo ' ]';
		}
	}

	public function hydrate( array $kwargs ) {
		foreach ($kwargs as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method))	{ $this->$method($value); }
		}
	}

	public function __toString() {
		return $this->_tank;
	}

	public function jsonSerialize() {
		global $pw_ammo;
		global $pw_chassis_description;
		global $pw_engine_description;

		$talents = [];
		$talents_with_level = [];
		$ammo = [];
		$chassis = [];
		$engines = [];

		$blueprint_rank = $this->getBlueprint_rank();

		if ($blueprint_rank == 0)
		{
			$blueprint_rank = "unknown";
			$blueprint_rank_filter = "unknown";
		}
		else
		{
			if ($blueprint_rank > 0 && $blueprint_rank <= 3)
				$blueprint_rank_filter = "1-3";
			else if ($blueprint_rank > 3)
				$blueprint_rank_filter = $blueprint_rank;
		}
		
		for ($i = 1; $i <= 3; $i++)
		{
			if ($this->_lifestyle_skills["skill_" . $i . "_level"] > 0)
				$talents[] = $this->_lifestyle_skills["skill_" . $i];
		}

		for ($i = 1; $i <= 3; $i++)
		{
			if ($this->_lifestyle_skills["skill_" . $i . "_level"] > 0)
				$talents_with_level[] = [$this->_lifestyle_skills["skill_" . $i], $this->_lifestyle_skills["skill_" . $i . "_level"]];
		}

		foreach (array_keys($pw_ammo) as $shell)
		{
			if ($this->_ammo[$shell] == "1")
				$ammo[] = $shell;
		}

		foreach (array_keys($pw_chassis_description) as $chassis_name)
		{
			if ($this->_chassis_bonus[$chassis_name] == "1")
				$chassis[] = $chassis_name;
		}

		foreach (array_keys($pw_engine_description) as $engine_name)
		{
			if ($this->_engine_bonus[$engine_name] == "1")
				$engines[] = $engine_name;
		}

		if ( !empty($this->getEngine_ids()) )
		{
			$engine_ids = $this->getEngine_ids();
		}
		else
		{
			$engines_array = $this->getEngines();

			foreach ( $engines_array as $engine_item )
			{
				$engine_ids[] = $engine_item->getId();
			}
		}

		return [
			'tank'			=> $this->getTank(),
			'tank_slug'		=> $this->getTank_slug(),
			'category'		=> $this->getCategory(),
			'rarity'		=> $this->getRarity(),
			'name'			=> $this->getName(),
			'nation'		=> $this->getNation(),
			'talents'		=> $talents,
			'talents_with_level'	=> $talents_with_level,
			'ammo'			=> $ammo,
			'chassis'		=> $chassis,
			'engines'		=> $engines,
			'blueprint_rank'	=> $blueprint_rank,
			'blueprint_rank_filter'	=> $blueprint_rank_filter,
			'firepower'		=> $this->getFirepower(),
			'penetration'	=> $this->getPenetration(),
			'targeting'		=> $this->getTargeting(),
			'durability'	=> $this->getDurability(),
			'armor'			=> $this->getArmor(),
			'evasion'		=> $this->getEvasion(),
			'stealth'		=> $this->getStealth(),
			'detection'		=> $this->getDetection(),
			'armor_ids'		=> $this->getArmor_ids(),
			'chassis_ids'	=> $this->getChassis_ids(),
			'engine_ids'	=> $engine_ids,
			'shell_ids'		=> $this->getShell_ids()
		];
	}

	public function unserialize_data( $data ) {
		if (!empty($data))
		{
			$unserialized_data = @unserialize($data);

			if ($data === 'b:0;' || $unserialized_data !== false)
				return $unserialized_data;
			else // Data is not serialized
			{
				if (is_array($data))
					return $data;
			}
		}
		return [];
	}

	public function getId()						{ return $this->_id; }
	public function getAmmo()					{ return $this->_ammo; }
	public function getAmmo_game_version()		{ return $this->_ammo_game_version; }
	public function getProfile_game_version()	{ return $this->_profile_game_version; }
	public function getCategory()				{ return $this->_category; }
	public function getCharacter_voice()		{ return $this->_character_voice; }
	public function getChassis_bonus()			{ return $this->_chassis_bonus; }
	public function getEngine_bonus()			{ return $this->_engine_bonus; }
	public function getEquipment_slots()		{ return $this->_equipment_slots; }
	public function getImagename()				{ return str_replace('/', '_', $this->_tank); }
	public function getLifestyle_skills()		{ return $this->_lifestyle_skills; }
	public function getLive2d()					{ return $this->_live2d; }
	public function getLive2d_name()			{ return $this->_live2d_name; }
	public function getName()					{ return $this->_name; }
	public function getNation()					{ return $this->_nation; }
	public function getRarity()					{ return $this->_rarity; }
	public function getRoot_head_id()			{ return $this->_root_head_id; }
	public function getTank()					{ return $this->_tank; }
	public function getTank_slug()				{ return post_slug($this->_tank); }
	public function getHidden()					{ return $this->_hidden; }
	public function getCreated_on()				{ return $this->_created_on; }
	public function getUpdated_on()				{ return $this->_updated_on; }

	public function getFirepower()				{ return $this->_firepower; }
	public function getPenetration()			{ return $this->_penetration; }
	public function getDurability()				{ return $this->_durability; }
	public function getArmor()					{ return $this->_armor; }
	public function getStealth()				{ return $this->_stealth; }
	public function getDetection()				{ return $this->_detection; }
	public function getTargeting()				{ return $this->_targeting; }
	public function getEvasion()				{ return $this->_evasion; }
	public function getFire_resist()			{ return $this->_fire_resist; }
	public function getCrit_resist()			{ return $this->_crit_resist; }
	public function getCrit_defense()			{ return $this->_crit_defense; }
	public function getFirepower_lvl60()		{ return $this->_firepower_lvl60; }
	public function getPenetration_lvl60()		{ return $this->_penetration_lvl60; }
	public function getDurability_lvl60()		{ return $this->_durability_lvl60; }
	public function getArmor_lvl60()			{ return $this->_armor_lvl60; }
	public function getMin_range()				{ return $this->_min_range; }
	public function getMax_range()				{ return $this->_max_range; }

	public function getQuote_intro()			{ return $this->_quote_intro; }
	public function getQuote_main_screen_1()	{ return $this->_quote_main_screen_1; }
	public function getQuote_main_screen_2()	{ return $this->_quote_main_screen_2; }
	public function getQuote_main_screen_3()	{ return $this->_quote_main_screen_3; }
	public function getQuote_main_screen_4()	{ return $this->_quote_main_screen_4; }
	public function getQuote_main_screen_5()	{ return $this->_quote_main_screen_5; }
	public function getQuote_main_screen_6()	{ return $this->_quote_main_screen_6; }
	public function getQuote_upgrading()		{ return $this->_quote_upgrading; }
	public function getQuote_pre_attack_1()		{ return $this->_quote_pre_attack_1; }
	public function getQuote_pre_attack_2()		{ return $this->_quote_pre_attack_2; }
	public function getQuote_pre_attack_3()		{ return $this->_quote_pre_attack_3; }
	public function getQuote_on_attack_1()		{ return $this->_quote_on_attack_1; }
	public function getQuote_on_attack_2()		{ return $this->_quote_on_attack_2; }
	public function getQuote_on_attack_3()		{ return $this->_quote_on_attack_3; }
	public function getQuote_on_attack_4()		{ return $this->_quote_on_attack_4; }
	public function getQuote_on_attack_5()		{ return $this->_quote_on_attack_5; }
	public function getQuote_on_attack_6()		{ return $this->_quote_on_attack_6; }
	public function getQuote_on_attack_7()		{ return $this->_quote_on_attack_7; }
	public function getQuote_getting_hit()		{ return $this->_quote_getting_hit; }
	public function getQuote_upon_destruction()	{ return $this->_quote_upon_destruction; }
	public function getQuote_added_to_squad()	{ return $this->_quote_added_to_squad; }
	public function getQuote_choice_of_essential_equipment_1()	{ return $this->_quote_choice_of_essential_equipment_1; }
	public function getQuote_choice_of_essential_equipment_2()	{ return $this->_quote_choice_of_essential_equipment_2; }
	public function getQuote_choice_of_essential_equipment_3()	{ return $this->_quote_choice_of_essential_equipment_3; }
	public function getQuote_choice_of_essential_equipment_4()	{ return $this->_quote_choice_of_essential_equipment_4; }
	public function getQuote_when_updating_equipment_1()		{ return $this->_quote_when_updating_equipment_1; }
	public function getQuote_when_updating_equipment_2()		{ return $this->_quote_when_updating_equipment_2; }
	public function getQuote_when_updating_equipment_3()		{ return $this->_quote_when_updating_equipment_3; }
	public function getQuote_unequip_all_gear()	{ return $this->_quote_unequip_all_gear; }
	public function getQuote_battle_victory_1()	{ return $this->_quote_battle_victory_1; }
	public function getQuote_battle_victory_2()	{ return $this->_quote_battle_victory_2; }
	public function getQuote_battle_victory_3()	{ return $this->_quote_battle_victory_3; }
	public function getQuote_battle_loss()		{ return $this->_quote_battle_loss; }
	public function getQuote_fate()				{ return $this->_quote_fate; }

	public function getForge()					{ return $this->_forge; }
	public function getNaval_port()				{ return $this->_naval_port; }
	public function getRefactor()				{ return $this->_refactor; }
	public function getChapter()				{ return $this->_chapter; }
	public function getChapter_number($chapter, $volume)		{ return $this->_chapter[$chapter . "_" . $volume]; }
	public function getMethod_1()				{ return $this->_method_1; }
	public function getMethod_2()				{ return $this->_method_2; }
	public function getMethod_3()				{ return $this->_method_3; }
	public function getDevelop()				{ return $this->_develop; }
	public function getResearch()				{ return $this->_research; }

	public function getArmor_ids()				{ if (!isset($this->_armor_ids)) return []; else return array_filter($this->_armor_ids); }
	public function getChassis_ids()			{ if (!isset($this->_chassis_ids)) return []; else return array_filter($this->_chassis_ids); }
	public function getEngine_ids()				{ if (!isset($this->_engine_ids)) return []; else return array_filter($this->_engine_ids); }
	public function getShell_ids()				{ if (isset($this->_shell_ids[0]) && empty($this->_shell_ids[0])) return []; else return $this->_shell_ids; }

	public function getEngines()
	{
		global $dbhandler;
		$enginesManager = new EnginesManager($dbhandler);
		$engines = $enginesManager->get_all();

		$engine_bonus = $this->getEngine_bonus_available();
		$engines_available = [];

		foreach ($engines as $engine)
		{
			if (array_values(array_intersect($engine_bonus, $engine->getEngine_properties())) == $engine->getEngine_properties())
			{
				$engines_available[] = $engine;
			}
		}
		// echo var_dump($engines_available);

		return ($engines_available);
	}

	public function getChassis_bonus_available()
	{
		$tank_chassis_bonus = [];
		foreach ($this->_chassis_bonus as $chassis_bonus => $available)
		{
			if ($available)
			{
				$tank_chassis_bonus[] = $chassis_bonus;
			}
		}

		return $tank_chassis_bonus;
	}

	public function getEngine_bonus_available()
	{
		$tank_engine_bonus = [];

		foreach ($this->_engine_bonus as $engine_bonus => $available)
		{
			if ($available)
			{
				$tank_engine_bonus[] = $engine_bonus;
			}
		}

		return $tank_engine_bonus;
	}

	public function setAmmo( $ammo )							{ $this->_ammo = $this->unserialize_data( $ammo ); }
	public function setAmmo_game_version( $game_version )		{ $this->_ammo_game_version = $game_version; }
	public function setProfile_game_version( $game_version )	{ $this->_profile_game_version = $game_version; }
	public function setCategory( $category ) 					{ $this->_category = $category; }
	public function setCharacter_voice( $character_voice )		{ $this->_character_voice = $character_voice; }
	public function setChassis_bonus( $chassis_bonus )			{ $this->_chassis_bonus = $this->unserialize_data( $chassis_bonus ); }
	public function setEngine_bonus( $engine_bonus )			{ $this->_engine_bonus = $this->unserialize_data( $engine_bonus ); }
	public function setEquipment_slots( $equipment_slots )		{ $this->_equipment_slots = $this->unserialize_data( $equipment_slots ); }
	public function setLifestyle_skills( $lifestyle_skills )	{ $this->_lifestyle_skills = $this->unserialize_data( $lifestyle_skills ); }
	public function setLive2d( $live2d )						{
		if ( $live2d == "null")
			$live2d = NULL;
		$this->_live2d = $live2d;
																}
	public function setLive2d_name( $live2d_name ) 				{ $this->_live2d_name = $live2d_name; }
	public function setName( $name ) 							{ $this->_name = $name; }
	public function setNation( $nation )						{ $this->_nation = $nation; }
	public function setRarity( $rarity )						{ $this->_rarity = $rarity; }
	public function setTank( $tank )							{ $this->_tank = $tank; }
	public function setHidden( $hidden )						{ $this->_hidden = $hidden; }
	public function setCreated_on( $time )						{ $this->_created_on = $time; }
	public function setUpdated_on( $time )						{ $this->_updated_on = $time; }

	public function setFirepower( $firepower )					{ $this->_firepower = $firepower; }
	public function setPenetration( $penetration )				{ $this->_penetration = $penetration; }
	public function setDurability( $durability )				{ $this->_durability = $durability; }
	public function setArmor( $armor )							{ $this->_armor = $armor; }
	public function setStealth( $stealth )						{ $this->_stealth = $stealth; }
	public function setDetection( $detection )					{ $this->_detection = $detection; }
	public function setTargeting( $targeting )					{ $this->_targeting = $targeting; }
	public function setEvasion( $evasion )						{ $this->_evasion = $evasion; }
	public function setFire_resist( $fire_resist )				{ $this->_fire_resist = $fire_resist; }
	public function setCrit_resist( $crit_resist )				{ $this->_crit_resist = $crit_resist; }
	public function setCrit_defense( $crit_defense )			{ $this->_crit_defense = $crit_defense; }
	public function setFirepower_lvl60( $firepower_lvl60 )		{ $this->_firepower_lvl60 = $firepower_lvl60; }
	public function setPenetration_lvl60( $penetration_lvl60 )	{ $this->_penetration_lvl60 = $penetration_lvl60; }
	public function setDurability_lvl60( $durability_lvl60 )	{ $this->_durability_lvl60 = $durability_lvl60; }
	public function setArmor_lvl60( $armor_lvl60 )				{ $this->_armor_lvl60 = $armor_lvl60; }
	public function setMin_range( $min_range )					{ $this->_min_range = $min_range; }
	public function setMax_range( $max_range )					{ $this->_max_range = $max_range; }

	public function setQuote_intro( $quote )					{ $this->_quote_intro = $quote; }
	public function setQuote_main_screen_1( $quote )			{ $this->_quote_main_screen_1 = $quote; }
	public function setQuote_main_screen_2( $quote )			{ $this->_quote_main_screen_2 = $quote; }
	public function setQuote_main_screen_3( $quote )			{ $this->_quote_main_screen_3 = $quote; }
	public function setQuote_main_screen_4( $quote )			{ $this->_quote_main_screen_4 = $quote; }
	public function setQuote_main_screen_5( $quote )			{ $this->_quote_main_screen_5 = $quote; }
	public function setQuote_main_screen_6( $quote )			{ $this->_quote_main_screen_6 = $quote; }
	public function setQuote_upgrading( $quote )				{ $this->_quote_upgrading = $quote; }
	public function setQuote_pre_attack_1( $quote )				{ $this->_quote_pre_attack_1 = $quote; }
	public function setQuote_pre_attack_2( $quote )				{ $this->_quote_pre_attack_2 = $quote; }
	public function setQuote_pre_attack_3( $quote )				{ $this->_quote_pre_attack_3 = $quote; }
	public function setQuote_on_attack_1( $quote )				{ $this->_quote_on_attack_1 = $quote; }
	public function setQuote_on_attack_2( $quote )				{ $this->_quote_on_attack_2 = $quote; }
	public function setQuote_on_attack_3( $quote )				{ $this->_quote_on_attack_3 = $quote; }
	public function setQuote_on_attack_4( $quote )				{ $this->_quote_on_attack_4 = $quote; }
	public function setQuote_on_attack_5( $quote )				{ $this->_quote_on_attack_5 = $quote; }
	public function setQuote_on_attack_6( $quote )				{ $this->_quote_on_attack_6 = $quote; }
	public function setQuote_on_attack_7( $quote )				{ $this->_quote_on_attack_7 = $quote; }
	public function setQuote_getting_hit( $quote )				{ $this->_quote_getting_hit = $quote; }
	public function setQuote_upon_destruction( $quote )			{ $this->_quote_upon_destruction = $quote; }
	public function setQuote_added_to_squad( $quote )			{ $this->_quote_added_to_squad = $quote; }
	public function setQuote_choice_of_essential_equipment_1( $quote )	{ $this->_quote_choice_of_essential_equipment_1 = $quote; }
	public function setQuote_choice_of_essential_equipment_2( $quote )	{ $this->_quote_choice_of_essential_equipment_2 = $quote; }
	public function setQuote_choice_of_essential_equipment_3( $quote )	{ $this->_quote_choice_of_essential_equipment_3 = $quote; }
	public function setQuote_choice_of_essential_equipment_4( $quote )	{ $this->_quote_choice_of_essential_equipment_4 = $quote; }
	public function setQuote_when_updating_equipment_1( $quote )		{ $this->_quote_when_updating_equipment_1 = $quote; }
	public function setQuote_when_updating_equipment_2( $quote )		{ $this->_quote_when_updating_equipment_2 = $quote; }
	public function setQuote_when_updating_equipment_3( $quote )		{ $this->_quote_when_updating_equipment_3 = $quote; }
	public function setQuote_unequip_all_gear( $quote )			{ $this->_quote_unequip_all_gear = $quote; }
	public function setQuote_battle_victory_1( $quote )			{ $this->_quote_battle_victory_1 = $quote; }
	public function setQuote_battle_victory_2( $quote )			{ $this->_quote_battle_victory_2 = $quote; }
	public function setQuote_battle_victory_3( $quote )			{ $this->_quote_battle_victory_3 = $quote; }
	public function setQuote_battle_loss( $quote )				{ $this->_quote_battle_loss = $quote; }
	public function setQuote_fate( $quote )						{ $this->_quote_fate = $quote; }

	public function setArmor_ids( $armor_ids ) {
		if ( is_array($armor_ids) )
			$this->_armor_ids = $armor_ids;
		else if ( is_string($armor_ids) )
			$this->_armor_ids = explode(",", $armor_ids);
		else
			$this->_armor_ids = [];
	}
	public function setChassis_ids( $chassis_ids ) {
		if ( is_array($chassis_ids) )
			$this->_chassis_ids = $chassis_ids;
		else if ( is_string($chassis_ids) )
			$this->_chassis_ids = explode(",", $chassis_ids);
		else
			$this->_chassis_ids = [];
	}
	public function setEngine_ids( $engine_ids ) {
		if ( is_array($engine_ids) )
			$this->_engine_ids = $engine_ids;
		else if ( is_string($engine_ids) )
			$this->_engine_ids = explode(",", $engine_ids);
		else
			$this->_engine_ids = [];
	}
	public function setShell_ids( $shell_ids ) {
		if ( is_array($shell_ids) )
			$this->_shell_ids = $shell_ids;
		else if ( is_string($shell_ids) )
			$this->_shell_ids = explode(",", $shell_ids);
		else
			$this->_shell_ids = [];
	}

	public function setForge( $bool )							{ $this->_forge = $bool; }
	public function setNaval_port( $level )						{ $this->_naval_port = $level; }
	public function setRefactor( $level )						{ $this->_refactor = $level; }
	public function setChapter( $chapter )						{ $this->_chapter = $this->unserialize_data( $chapter ); }
	public function setMethod_1( $method_1 )					{ $this->_method_1 = $this->unserialize_data( $method_1 ); }
	public function setMethod_2( $method_2 )					{ $this->_method_2 = $this->unserialize_data( $method_2 ); }
	public function setMethod_3( $method_3 )					{ $this->_method_3 = $this->unserialize_data( $method_3 ); }
	public function setDevelop( $develop )						{ $this->_develop = $this->unserialize_data( $develop ); }
	public function setResearch( $research )					{ $this->_research = $this->unserialize_data( $research ); }

	public function getAttribute( $attribute_name ) {
		global $pw_tank_all_attributes;

		if ( in_array(strtolower($attribute_name), $pw_tank_all_attributes) )
		{
			$attribute_name = "_" . $attribute_name;
			return $this->$attribute_name;
		}

		return "";
	}

	public function getBlueprint_rank() {
		$requirement_array = ["method_1", "method_2", "method_3", "develop", "research"];

		foreach ($requirement_array as $requirement)
		{
			if (isset($this->getRequirements($requirement)["blueprint_quantity"]) && $this->getRequirements($requirement)["blueprint_quantity"] > 0)
				return preg_replace("/[^0-9]/", "", $this->getRequirements($requirement)["blueprint"]);
		}

		return 0;
	}

	public function getMain_resource_required() {
		$requirement_array = ["method_1", "method_2", "method_3", "develop", "research"];

		foreach ($requirement_array as $requirement)
		{
			if (isset($this->getRequirements($requirement)["resource_quantity"]) && $this->getRequirements($requirement)["resource_quantity"] > 0)
				return $this->getRequirements($requirement)["resource"];
		}

		return NULL;
	}

	public function getQuote( $quote_name ) {
		$quote_array = ["quote_intro"];
		for ($i = 1; $i <= 6; $i++)
			$quote_array = array_merge($quote_array, ["quote_main_screen_" . $i]);
		for ($i = 1; $i <= 3; $i++)
			$quote_array = array_merge($quote_array, ["quote_pre_attack_" . $i]);
		for ($i = 1; $i <= 7; $i++)
			$quote_array = array_merge($quote_array, ["quote_on_attack_" . $i]);
		for ($i = 1; $i <= 4; $i++)
			$quote_array = array_merge($quote_array, ["quote_choice_of_essential_equipment_" . $i]);
		for ($i = 1; $i <= 3; $i++)
			$quote_array = array_merge($quote_array, ["quote_battle_victory_" . $i]);

		$quote_array = array_merge($quote_array, ["quote_getting_hit", "quote_upon_destruction", "quote_upgrading", "quote_added_to_squad", "quote_when_updating_equipment_1", "quote_when_updating_equipment_2", "quote_when_updating_equipment_3", "quote_unequip_all_gear", "quote_battle_loss", "quote_fate"]);

		if ( in_array(strtolower($quote_name), $quote_array) )
		{
			$quote_name = "_" . $quote_name;

			if (strtolower($this->$quote_name) == "null")
				return "<span style='color: orangered;'>No quote</span>";
			return $this->$quote_name;
		}

		return "";
	}

	public function getRequirements( $requirement ) {
		$requirement_array = ["forge", "naval_port", "refactor", "method_1", "method_2", "method_3", "develop", "research"];

		if ( in_array(strtolower($requirement), $requirement_array) )
		{
			$requirement = "_" . $requirement;
			return $this->$requirement;
		}
		return NULL;
	}

	public function getMax_rank() {
		if ($this->_rarity == "gold")		return "3";
		elseif ($this->_rarity == "purple")	return "2";
		elseif ($this->_rarity == "blue")	return "1";
		else								return "";
	}

	public function countQuote_main_screen() {
		$i = 0;

		if (!empty($this->_quote_main_screen_1))	++$i;
		if (!empty($this->_quote_main_screen_2))	++$i;
		if (!empty($this->_quote_main_screen_3))	++$i;
		if (!empty($this->_quote_main_screen_4))	++$i;
		if (!empty($this->_quote_main_screen_5))	++$i;
		if (!empty($this->_quote_main_screen_6))	++$i;

		return $i;
	}

	public function countQuotes() {
		$i = 0;

		if (!empty($this->_quote_intro))			++$i;
		if (!empty($this->_quote_main_screen_1))	++$i;
		if (!empty($this->_quote_main_screen_2))	++$i;
		if (!empty($this->_quote_main_screen_3))	++$i;
		if (!empty($this->_quote_main_screen_4))	++$i;
		if (!empty($this->_quote_main_screen_5))	++$i;
		if (!empty($this->_quote_main_screen_6))	++$i;
		if (!empty($this->_quote_upgrading))		++$i;
		if (!empty($this->_quote_pre_attack_1))		++$i;
		if (!empty($this->_quote_pre_attack_2))		++$i;
		if (!empty($this->_quote_pre_attack_3))		++$i;
		if (!empty($this->_quote_on_attack_1))		++$i;
		if (!empty($this->_quote_on_attack_2))		++$i;
		if (!empty($this->_quote_on_attack_3))		++$i;
		if (!empty($this->_quote_on_attack_4))		++$i;
		if (!empty($this->_quote_on_attack_5))		++$i;
		if (!empty($this->_quote_on_attack_6))		++$i;
		if (!empty($this->_quote_on_attack_7))		++$i;
		if (!empty($this->_quote_getting_hit))		++$i;
		if (!empty($this->_quote_upon_destruction))	++$i;
		if (!empty($this->_quote_added_to_squad))	++$i;
		if (!empty($this->_quote_choice_of_essential_equipment_1))	++$i;
		if (!empty($this->_quote_choice_of_essential_equipment_2))	++$i;
		if (!empty($this->_quote_choice_of_essential_equipment_3))	++$i;
		if (!empty($this->_quote_choice_of_essential_equipment_4))	++$i;
		if (!empty($this->_quote_when_updating_equipment_1))		++$i;
		if (!empty($this->_quote_when_updating_equipment_2))		++$i;
		if (!empty($this->_quote_when_updating_equipment_3))		++$i;
		if (!empty($this->_quote_unequip_all_gear))	++$i;
		if (!empty($this->_quote_battle_victory_1))	++$i;
		if (!empty($this->_quote_battle_victory_2))	++$i;
		if (!empty($this->_quote_battle_victory_3))	++$i;
		if (!empty($this->_quote_battle_loss))		++$i;
		if (!empty($this->_quote_fate))				++$i;

		return $i;
	}

	public function print_main_resource_icon() {
		if ($this->getMain_resource_required() != NULL)
		{
			$array = array(
				"processor"		=> "<span style='background-color: grey;'>&nbsp;P&nbsp;</span>",
				"secret_plan"	=> "<span style='background-color: green;'>&nbsp;S&nbsp;</span>",
				"test_doll"		=> "<span style='background-color: #ffdab9; color: black;'>&nbsp;T&nbsp;</span>",
				"wreck"			=> "<span style='background-color: #cd853f;'>&nbsp;W&nbsp;</span>"
				);
			
			$main_resource = $this->getMain_resource_required();

			if ($main_resource != NULL)
			{
				if (isset($array[$main_resource]))
					echo $array[$main_resource];
			}
		}
	}

	public function setId ( $id ) {
		if (is_numeric($id) && $id > 0)	$this->_id = $id;
		else						$this->_id = NULL; }

	public function setRoot_head_id( $root_head_id ) {
		if (is_numeric($root_head_id) && $root_head_id >= 0)	$this->_root_head_id = $root_head_id;
		else													$this->_root_head_id = 0; }
}
?>