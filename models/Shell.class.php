<?php
class Shell
{
	protected $_id;

	protected $_name;
	protected $_category;
	protected $_tier;
	protected $_level;
	protected $_firepower;
	protected $_penetration;
	protected $_targeting;
	protected $_evasion;
	protected $_stealth;
	protected $_icon_file_name;
	protected $_shell_modifiers_ids;
	protected $_shell_properties_ids;

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
	public function getFirepower()				{ return $this->_firepower; }
	public function getPenetration()			{ return $this->_penetration; }
	public function getTargeting()				{ return $this->_targeting; }
	public function getEvasion()				{ return $this->_evasion; }
	public function getStealth()				{ return $this->_stealth; }
	public function getIcon_file_name()			{ return $this->_icon_file_name; }
	public function getShell_modifiers_ids()	{ return $this->_shell_modifiers_ids; }
	public function getShell_properties_ids()	{ return $this->_shell_properties_ids; }

	public function setId( $id ) 										{ $this->_id = $id; }
	public function setName( $name ) 									{ $this->_name = $name; }
	public function setCategory( $category ) 							{ $this->_category = $category; }
	public function setTier( $tier ) 									{ $this->_tier = $tier; }
	public function setLevel( $level ) 									{ $this->_level = $level; }
	public function setFirepower( $firepower ) 							{ $this->_firepower = $firepower; }
	public function setPenetration( $penetration ) 						{ $this->_penetration = $penetration; }
	public function setTargeting( $targeting ) 							{ $this->_targeting = $targeting; }
	public function setEvasion( $evasion ) 								{ $this->_evasion = $evasion; }
	public function setStealth( $stealth ) 								{ $this->_stealth = $stealth; }
	public function setIcon_file_name( $icon_file_name )				{ $this->_icon_file_name = $icon_file_name; }
	public function setShell_modifiers_ids( $shell_modifiers_ids )		{ $this->_shell_modifiers_ids = $shell_modifiers_ids; }
	public function setShell_properties_ids( $shell_properties_ids )	{ $this->_shell_properties_ids = $shell_properties_ids; }
}
?>