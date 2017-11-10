<?php
class Chassis
{
	protected $_id;

	protected $_name;
	protected $_tier;
	protected $_level;
	protected $_armor;
	protected $_detection;
	protected $_durability;
	protected $_evasion;
	protected $_firepower;
	protected $_penetration;
	protected $_stealth;
	protected $_targeting;
	protected $_angled;
	protected $_flat_top;
	protected $_front;
	protected $_light;
	protected $_low;
	protected $_rear;
	protected $_sloped;
	protected $_tires;
	protected $_treads;
	protected $_created_on;
	protected $_updated_on;

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
	public function getTier()					{ return $this->_tier; }
	public function getLevel()					{ return $this->_level; }
	public function getArmor()					{ return $this->_armor; }
	public function getDetection()				{ return $this->_detection; }
	public function getDurability()				{ return $this->_durability; }
	public function getEvasion()				{ return $this->_evasion; }
	public function getFirepower()				{ return $this->_firepower; }
	public function getPenetration()			{ return $this->_penetration; }
	public function getStealth()				{ return $this->_stealth; }
	public function getTargeting()				{ return $this->_targeting; }
	public function getAngled()					{ return $this->_angled; }
	public function getFlat_top()				{ return $this->_flat_top; }
	public function getFront()					{ return $this->_front; }
	public function getLight()					{ return $this->_light; }
	public function getLow()					{ return $this->_low; }
	public function getRear()					{ return $this->_rear; }
	public function getSloped()					{ return $this->_sloped; }
	public function getTires()					{ return $this->_tires; }
	public function getTreads()					{ return $this->_treads; }
	public function getCreated_on()				{ return $this->_created_on; }
	public function getUpdated_on()				{ return $this->_updated_on; }

	public function setId( $id ) 										{ $this->_id = $id; }
	public function setName( $name ) 									{ $this->_name = $name; }
	public function setTier( $tier ) 									{ $this->_tier = $tier; }
	public function setLevel( $level ) 									{ $this->_level = $level; }
	public function setArmor( $armor ) 									{ $this->_armor = $armor; }
	public function setDetection( $detection ) 							{ $this->_detection = $detection; }
	public function setDurability( $durability ) 						{ $this->_durability = $durability; }
	public function setEvasion( $evasion ) 								{ $this->_evasion = $evasion; }
	public function setFirepower( $firepower ) 							{ $this->_firepower = $firepower; }
	public function setPenetration( $penetration ) 						{ $this->_penetration = $penetration; }
	public function setStealth( $stealth ) 								{ $this->_stealth = $stealth; }
	public function setTargeting( $targeting ) 							{ $this->_targeting = $targeting; }
	public function setAngled( $angled )								{ $this->_angled = $angled; }
	public function setFlat_top( $flat_top )							{ $this->_flat_top = $flat_top; }
	public function setFront( $front )									{ $this->_front = $front; }
	public function setLight( $light )									{ $this->_light = $light; }
	public function setLow( $low )										{ $this->_low = $low; }
	public function setRear( $rear )									{ $this->_rear = $rear; }
	public function setSloped( $sloped )								{ $this->_sloped = $sloped; }
	public function setTires( $tires )									{ $this->_tires = $tires; }
	public function setTreads( $treads )								{ $this->_treads = $treads; }
	public function setCreated_on( $datetime ) 							{ $this->_created_on = $datetime; }
	public function setUpdated_on( $datetime ) 							{ $this->_updated_on = $datetime; }
}
?>