<?php
class EnginesManager
{
	private $_dbhandler;

	public function __construct( $dbhandler )		{ $this->setDbhandler( $dbhandler ); }
	public function getDbhandler()					{ return $this->_dbhandler; }
	public function setDbhandler( PDO $dbhandler )	{ $this->_dbhandler = $dbhandler; }

	public function count() {
		return $this->_dbhandler->query('SELECT COUNT(*) FROM `engines`')->fetchColumn();
	}

	public function exists( $id ) {
		$query = $this->_dbhandler->prepare('SELECT COUNT(*) FROM `engines` WHERE id = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);

		return (bool) $query->fetchColumn();
	}

	public function get( $id ) {
		$query = $this->_dbhandler->prepare('
			SELECT *
			FROM `engines`
			WHERE `engines`.`id` = :id'
		);
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();

		$data = $query->fetch(PDO::FETCH_ASSOC);

		if ($data != false)
		{
			return new Engine($data);
		}
		else
			return false;
	}

	public function get_all() {
		$engines = array();

		$engine_query = $this->_dbhandler->query('
			SELECT *
			FROM `engines`
		');

		while ($data_engine = $engine_query->fetch(PDO::FETCH_ASSOC))
		{
			$engine = new Engine($data_engine);
			$engines[] = $engine;
		}

		return $engines;
	}

	public function add( Engine $engine ) {
		$query = $this->_dbhandler->prepare('INSERT INTO `engines`
			SET name = :name,
				tier = :tier,
				level = :level,
				detection = :detection,
				durability = :durability,
				evasion = :evasion,
				stealth = :stealth,
				targeting = :targeting,
				c_proof = :c_proof,
				d_proof = :d_proof,
				h_proof = :h_proof,
				s_proof = :s_proof,
				w_proof = :w_proof,
				silent = :silent,
				created_on = FROM_UNIXTIME(:created_on),
				updated_on = FROM_UNIXTIME(:updated_on)'
			);

		$query->bindValue(':name', $engine->getName(), PDO::PARAM_STR);
		$query->bindValue(':tier', $engine->getTier(), PDO::PARAM_INT);
		$query->bindValue(':level', $engine->getLevel(), PDO::PARAM_INT);
		$query->bindValue(':detection', $engine->getDetection(), PDO::PARAM_INT);
		$query->bindValue(':durability', $engine->getDurability(), PDO::PARAM_INT);
		$query->bindValue(':evasion', $engine->getEvasion(), PDO::PARAM_INT);
		$query->bindValue(':stealth', $engine->getStealth(), PDO::PARAM_INT);
		$query->bindValue(':targeting', $engine->getTargeting(), PDO::PARAM_INT);
		$query->bindValue(':c_proof', $engine->getC_proof(), PDO::PARAM_BOOL);
		$query->bindValue(':d_proof', $engine->getD_proof(), PDO::PARAM_BOOL);
		$query->bindValue(':h_proof', $engine->getH_proof(), PDO::PARAM_BOOL);
		$query->bindValue(':s_proof', $engine->getS_proof(), PDO::PARAM_BOOL);
		$query->bindValue(':w_proof', $engine->getW_proof(), PDO::PARAM_BOOL);
		$query->bindValue(':silent', $engine->getSilent(), PDO::PARAM_BOOL);
		$query->bindValue(':created_on', time());
		$query->bindValue(':updated_on', time());

		$query->execute();
	}

	public function update( Engine $engine ) {
		$query = $this->_dbhandler->prepare('UPDATE `engines`
			SET name = :name,
				tier = :tier,
				level = :level,
				detection = :detection,
				durability = :durability,
				evasion = :evasion,
				stealth = :stealth,
				targeting = :targeting,
				c_proof = :c_proof,
				d_proof = :d_proof,
				h_proof = :h_proof,
				s_proof = :s_proof,
				w_proof = :w_proof,
				silent = :silent,
				updated_on = FROM_UNIXTIME(:updated_on)
			WHERE id = :id');

		$query->bindValue(':id', $engine->getId(), PDO::PARAM_INT);
		$query->bindValue(':name', $engine->getName(), PDO::PARAM_STR);
		$query->bindValue(':tier', $engine->getTier(), PDO::PARAM_INT);
		$query->bindValue(':level', $engine->getLevel(), PDO::PARAM_INT);
		$query->bindValue(':detection', $engine->getDetection(), PDO::PARAM_INT);
		$query->bindValue(':durability', $engine->getDurability(), PDO::PARAM_INT);
		$query->bindValue(':evasion', $engine->getEvasion(), PDO::PARAM_INT);
		$query->bindValue(':stealth', $engine->getStealth(), PDO::PARAM_INT);
		$query->bindValue(':targeting', $engine->getTargeting(), PDO::PARAM_INT);
		$query->bindValue(':c_proof', $engine->getC_proof(), PDO::PARAM_BOOL);
		$query->bindValue(':d_proof', $engine->getD_proof(), PDO::PARAM_BOOL);
		$query->bindValue(':h_proof', $engine->getH_proof(), PDO::PARAM_BOOL);
		$query->bindValue(':s_proof', $engine->getS_proof(), PDO::PARAM_BOOL);
		$query->bindValue(':w_proof', $engine->getW_proof(), PDO::PARAM_BOOL);
		$query->bindValue(':silent', $engine->getSilent(), PDO::PARAM_BOOL);
		$query->bindValue(':updated_on', time());

		$query->execute() or die(print_r($query->errorInfo(), true));
	}
}