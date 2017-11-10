<?php
class PassiveSkill
{
	protected $_id;

	protected $_name;
	protected $_bonus_value_1;
	protected $_bonus_value_2;
	protected $_bonus_mult_1;
	protected $_bonus_mult_2;
	protected $_malus_eqpt_value_1;
	protected $_malus_eqpt_value_2;
	protected $_updated_firepower_1;
	protected $_updated_penetration_1;
	protected $_updated_targeting_1;
	protected $_updated_durability_1;
	protected $_updated_armor_1;
	protected $_updated_evasion_1;
	protected $_updated_stealth_1;
	protected $_updated_detection_1;
	protected $_updated_firepower_2;
	protected $_updated_penetration_2;
	protected $_updated_targeting_2;
	protected $_updated_durability_2;
	protected $_updated_armor_2;
	protected $_updated_evasion_2;
	protected $_updated_stealth_2;
	protected $_updated_detection_2;


	static $verbose = false;

	public function __construct( array $kwargs ) {
		$this->hydrate($kwargs);
	}

	public function hydrate( array $kwargs ) {
		foreach ($kwargs as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method))	{ $this->$method($value); }
		}
	}

	public function __toString() {
		return $this->_name;
	}

	public function getId()						{ return $this->_id; }
	public function getName()					{ return $this->_name; }
	public function getBonus_value_1()			{ return $this->_bonus_value_1; }
	public function getBonus_value_2()			{ return $this->_bonus_value_2; }
	public function getBonus_mult_1()			{ return $this->_bonus_mult_1; }
	public function getBonus_mult_2()			{ return $this->_bonus_mult_2; }
	public function getMalus_eqpt_value_1()		{ return $this->_malus_eqpt_value_1; }
	public function getMalus_eqpt_value_2()		{ return $this->_malus_eqpt_value_2; }
	public function getUpdated_firepower_1()	{ return $this->_updated_firepower_1; }
	public function getUpdated_penetration_1()	{ return $this->_updated_penetration_1; }
	public function getUpdated_targeting_1()	{ return $this->_updated_targeting_1; }
	public function getUpdated_durability_1()	{ return $this->_updated_durability_1; }
	public function getUpdated_armor_1()		{ return $this->_updated_armor_1; }
	public function getUpdated_evasion_1()		{ return $this->_updated_evasion_1; }
	public function getUpdated_stealth_1()		{ return $this->_updated_stealth_1; }
	public function getUpdated_detection_1()	{ return $this->_updated_detection_1; }
	public function getUpdated_firepower_2()	{ return $this->_updated_firepower_2; }
	public function getUpdated_penetration_2()	{ return $this->_updated_penetration_2; }
	public function getUpdated_targeting_2()	{ return $this->_updated_targeting_2; }
	public function getUpdated_durability_2()	{ return $this->_updated_durability_2; }
	public function getUpdated_armor_2()		{ return $this->_updated_armor_2; }
	public function getUpdated_evasion_2()		{ return $this->_updated_evasion_2; }
	public function getUpdated_stealth_2()		{ return $this->_updated_stealth_2; }
	public function getUpdated_detection_2()	{ return $this->_updated_detection_2; }


	public function setId( $id ) 								{ $this->_id = $id; }
	public function setName( $name ) 							{ $this->_name = $name; }
	public function setBonus_value_1( $value )					{ $this->_bonus_value_1 = $value; }
	public function setBonus_value_2( $value )					{ $this->_bonus_value_2 = $value; }
	public function setBonus_mult_1( $mult )					{ $this->_bonus_mult_1 = $mult; }
	public function setBonus_mult_2( $mult )					{ $this->_bonus_mult_2 = $mult; }
	public function setMalus_eqpt_value_1( $value )				{ $this->_malus_eqpt_value_1 = $value; }
	public function setMalus_eqpt_value_2( $value )				{ $this->_malus_eqpt_value_2 = $value; }
	public function setUpdated_firepower_1( $bool )				{ $this->_updated_firepower_1 = $bool; }
	public function setUpdated_penetration_1( $bool )			{ $this->_updated_penetration_1 = $bool; }
	public function setUpdated_targeting_1( $bool )				{ $this->_updated_targeting_1 = $bool; }
	public function setUpdated_durability_1( $bool )			{ $this->_updated_durability_1 = $bool; }
	public function setUpdated_armor_1( $bool )					{ $this->_updated_armor_1 = $bool; }
	public function setUpdated_evasion_1( $bool )				{ $this->_updated_evasion_1 = $bool; }
	public function setUpdated_stealth_1( $bool )				{ $this->_updated_stealth_1 = $bool; }
	public function setUpdated_detection_1( $bool )				{ $this->_updated_detection_1 = $bool; }
	public function setUpdated_firepower_2( $bool )				{ $this->_updated_firepower_2 = $bool; }
	public function setUpdated_penetration_2( $bool )			{ $this->_updated_penetration_2 = $bool; }
	public function setUpdated_targeting_2( $bool )				{ $this->_updated_targeting_2 = $bool; }
	public function setUpdated_durability_2( $bool )			{ $this->_updated_durability_2 = $bool; }
	public function setUpdated_armor_2( $bool )					{ $this->_updated_armor_2 = $bool; }
	public function setUpdated_evasion_2( $bool )				{ $this->_updated_evasion_2 = $bool; }
	public function setUpdated_stealth_2( $bool )				{ $this->_updated_stealth_2 = $bool; }
	public function setUpdated_detection_2( $bool )				{ $this->_updated_detection_2 = $bool; }
}
?>