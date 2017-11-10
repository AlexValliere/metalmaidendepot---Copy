<?php
class Engine
{
	protected $_id;

	protected $_name;
	protected $_tier;
	protected $_level;
	protected $_detection;
	protected $_durability;
	protected $_evasion;
	protected $_stealth;
	protected $_targeting;
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
	public function getDetection()				{ return $this->_detection; }
	public function getDurability()				{ return $this->_durability; }
	public function getEvasion()				{ return $this->_evasion; }
	public function getStealth()				{ return $this->_stealth; }
	public function getTargeting()				{ return $this->_targeting; }
	public function getC_proof()				{ return $this->_c_proof; }
	public function getD_proof()				{ return $this->_d_proof; }
	public function getH_proof()				{ return $this->_h_proof; }
	public function getS_proof()				{ return $this->_s_proof; }
	public function getW_proof()				{ return $this->_w_proof; }
	public function getSilent()					{ return $this->_silent; }
	public function getCreated_on()				{ return $this->_created_on; }
	public function getUpdated_on()				{ return $this->_updated_on; }

	public function getEngine_properties()
	{
		global $pw_engine_description;
		$engine_properties = [];

		foreach (array_keys($pw_engine_description) as $engine_bonus)
		{
			if ($this->{'_' . $engine_bonus} == 1)
			{
				$engine_properties[] = $engine_bonus;
			}	
		}

		return ($engine_properties);
	}

	public function setId( $id ) 										{ $this->_id = $id; }
	public function setName( $name ) 									{ $this->_name = $name; }
	public function setTier( $tier ) 									{ $this->_tier = $tier; }
	public function setLevel( $level ) 									{ $this->_level = $level; }
	public function setDetection( $detection ) 							{ $this->_detection = $detection; }
	public function setDurability( $durability ) 						{ $this->_durability = $durability; }
	public function setEvasion( $evasion ) 								{ $this->_evasion = $evasion; }
	public function setStealth( $stealth ) 								{ $this->_stealth = $stealth; }
	public function setTargeting( $targeting ) 							{ $this->_targeting = $targeting; }
	public function setC_proof( $c_proof )								{ $this->_c_proof = $c_proof; }
	public function setD_proof( $d_proof )								{ $this->_d_proof = $d_proof; }
	public function setH_proof( $h_proof )								{ $this->_h_proof = $h_proof; }
	public function setS_proof( $s_proof )								{ $this->_s_proof = $s_proof; }
	public function setW_proof( $w_proof )								{ $this->_w_proof = $w_proof; }
	public function setSilent( $silent )								{ $this->_silent = $silent; }
	public function setCreated_on( $datetime ) 							{ $this->_created_on = $datetime; }
	public function setUpdated_on( $datetime ) 							{ $this->_updated_on = $datetime; }
}
?>