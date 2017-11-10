<?php
class Armor
{
	protected $_id;

	protected $_name;
	protected $_category;
	protected $_tier;
	protected $_level;
	protected $_armor;
	protected $_durability;
	protected $_evasion;
	protected $_stealth;
	protected $_targeting;
	protected $_cast;
	protected $_composite;
	protected $_hardened;
	protected $_riveted;
	protected $_spaced;
	protected $_tempered;
	protected $_wedge;
	protected $_welded;
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
	public function getCategory()				{ return $this->_category; }
	public function getTier()					{ return $this->_tier; }
	public function getLevel()					{ return $this->_level; }
	public function getArmor()					{ return $this->_armor; }
	public function getDurability()				{ return $this->_durability; }
	public function getEvasion()				{ return $this->_evasion; }
	public function getStealth()				{ return $this->_stealth; }
	public function getTargeting()				{ return $this->_targeting; }
	public function getCast()					{ return $this->_cast; }
	public function getComposite()				{ return $this->_composite; }
	public function getHardened()				{ return $this->_hardened; }
	public function getRiveted()				{ return $this->_riveted; }
	public function getSpaced()					{ return $this->_spaced; }
	public function getTempered()				{ return $this->_tempered; }
	public function getWedge()					{ return $this->_wedge; }
	public function getWelded()					{ return $this->_welded; }
	public function getCreated_on()				{ return $this->_created_on; }
	public function getUpdated_on()				{ return $this->_updated_on; }

	public function setId( $id ) 										{ $this->_id = $id; }
	public function setName( $name ) 									{ $this->_name = $name; }
	public function setCategory( $category ) 							{ $this->_category = $category; }
	public function setTier( $tier ) 									{ $this->_tier = $tier; }
	public function setLevel( $level ) 									{ $this->_level = $level; }
	public function setArmor( $armor ) 									{ $this->_armor = $armor; }
	public function setDurability( $durability ) 						{ $this->_durability = $durability; }
	public function setEvasion( $evasion ) 								{ $this->_evasion = $evasion; }
	public function setStealth( $stealth ) 								{ $this->_stealth = $stealth; }
	public function setTargeting( $targeting ) 							{ $this->_targeting = $targeting; }
	public function setCast( $cast )									{ $this->_cast = $cast; }
	public function setComposite( $composite )							{ $this->_composite = $composite; }
	public function setHardened( $hardened )							{ $this->_hardened = $hardened; }
	public function setRiveted( $riveted )								{ $this->_riveted = $riveted; }
	public function setSpaced( $spaced )								{ $this->_spaced = $spaced; }
	public function setTempered( $tempered )							{ $this->_tempered = $tempered; }
	public function setWedge( $wedge )									{ $this->_wedge = $wedge; }
	public function setWelded( $welded )								{ $this->_welded = $welded; }
	public function setCreated_on( $datetime ) 							{ $this->_created_on = $datetime; }
	public function setUpdated_on( $datetime ) 							{ $this->_updated_on = $datetime; }
}
?>