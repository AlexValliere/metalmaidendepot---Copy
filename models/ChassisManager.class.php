<?php
class ChassisManager
{
	private $_dbhandler;

	public function __construct( $dbhandler )		{ $this->setDbhandler( $dbhandler ); }
	public function getDbhandler()					{ return $this->_dbhandler; }
	public function setDbhandler( PDO $dbhandler )	{ $this->_dbhandler = $dbhandler; }

	public function count() {
		return $this->_dbhandler->query('SELECT COUNT(*) FROM `chassis`')->fetchColumn();
	}

	public function exists( $id ) {
		$query = $this->_dbhandler->prepare('SELECT COUNT(*) FROM `chassis` WHERE id = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);

		return (bool) $query->fetchColumn();
	}

	public function get( $id ) {
		$query = $this->_dbhandler->prepare('
			SELECT *
			FROM `chassis`
			WHERE `chassis`.`id` = :id'
		);
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();

		$data = $query->fetch(PDO::FETCH_ASSOC);

		if ($data != false)
		{
			return new Chassis($data);
		}
		else
			return false;
	}

	public function get_all() {
		$chassis_array = array();

		$chassis_query = $this->_dbhandler->query('
			SELECT *
			FROM `chassis`
		');

		while ($data_chassis = $chassis_query->fetch(PDO::FETCH_ASSOC))
		{
			$chassis = new Chassis($data_chassis);
			$chassis_array[] = $chassis;
		}

		return $chassis_array;
	}

	public function add( Chassis $chassis ) {
		$query = $this->_dbhandler->prepare('INSERT INTO `chassis`
			SET name = :name,
				tier = :tier,
				level = :level,
				armor = :armor,
				detection = :detection,
				durability = :durability,
				evasion = :evasion,
				firepower = :firepower,
				penetration = :penetration,
				stealth = :stealth,
				targeting = :targeting,
				angled = :angled,
				flat_top = :flat_top,
				front = :front,
				light = :light,
				low = :low,
				rear = :rear,
				sloped = :sloped,
				tires = :tires,
				treads = :treads,
				created_on = FROM_UNIXTIME(:created_on),
				updated_on = FROM_UNIXTIME(:updated_on)
			');

		$query->bindValue(':name', $chassis->getName(), PDO::PARAM_STR);
		$query->bindValue(':tier', $chassis->getTier(), PDO::PARAM_INT);
		$query->bindValue(':level', $chassis->getLevel(), PDO::PARAM_INT);
		$query->bindValue(':armor', $chassis->getArmor(), PDO::PARAM_INT);
		$query->bindValue(':detection', $chassis->getDetection(), PDO::PARAM_INT);
		$query->bindValue(':durability', $chassis->getDurability(), PDO::PARAM_INT);
		$query->bindValue(':evasion', $chassis->getEvasion(), PDO::PARAM_INT);
		$query->bindValue(':firepower', $chassis->getFirepower(), PDO::PARAM_INT);
		$query->bindValue(':penetration', $chassis->getPenetration(), PDO::PARAM_INT);
		$query->bindValue(':stealth', $chassis->getStealth(), PDO::PARAM_INT);
		$query->bindValue(':targeting', $chassis->getTargeting(), PDO::PARAM_INT);
		$query->bindValue(':angled', $chassis->getAngled(), PDO::PARAM_BOOL);
		$query->bindValue(':flat_top', $chassis->getFlat_top(), PDO::PARAM_BOOL);
		$query->bindValue(':front', $chassis->getFront(), PDO::PARAM_BOOL);
		$query->bindValue(':light', $chassis->getLight(), PDO::PARAM_BOOL);
		$query->bindValue(':low', $chassis->getLow(), PDO::PARAM_BOOL);
		$query->bindValue(':rear', $chassis->getRear(), PDO::PARAM_BOOL);
		$query->bindValue(':sloped', $chassis->getSloped(), PDO::PARAM_BOOL);
		$query->bindValue(':tires', $chassis->getTires(), PDO::PARAM_BOOL);
		$query->bindValue(':treads', $chassis->getTreads(), PDO::PARAM_BOOL);
		$query->bindValue(':created_on', time());
		$query->bindValue(':updated_on', time());

		$query->execute();
	}

	public function update( Chassis $chassis ) {
		$query = $this->_dbhandler->prepare('UPDATE `chassis`
			SET name = :name,
				tier = :tier,
				level = :level,
				armor = :armor,
				detection = :detection,
				durability = :durability,
				evasion = :evasion,
				firepower = :firepower,
				penetration = :penetration,
				stealth = :stealth,
				targeting = :targeting,
				angled = :angled,
				flat_top = :flat_top,
				front = :front,
				light = :light,
				low = :low,
				rear = :rear,
				sloped = :sloped,
				tires = :tires,
				treads = :treads,
				updated_on = FROM_UNIXTIME(:updated_on)
			WHERE id = :id');

		$query->bindValue(':id', $chassis->getId(), PDO::PARAM_INT);
		$query->bindValue(':name', $chassis->getName(), PDO::PARAM_STR);
		$query->bindValue(':tier', $chassis->getTier(), PDO::PARAM_INT);
		$query->bindValue(':level', $chassis->getLevel(), PDO::PARAM_INT);
		$query->bindValue(':armor', $chassis->getArmor(), PDO::PARAM_INT);
		$query->bindValue(':detection', $chassis->getDetection(), PDO::PARAM_INT);
		$query->bindValue(':durability', $chassis->getDurability(), PDO::PARAM_INT);
		$query->bindValue(':evasion', $chassis->getEvasion(), PDO::PARAM_INT);
		$query->bindValue(':firepower', $chassis->getFirepower(), PDO::PARAM_INT);
		$query->bindValue(':penetration', $chassis->getPenetration(), PDO::PARAM_INT);
		$query->bindValue(':stealth', $chassis->getStealth(), PDO::PARAM_INT);
		$query->bindValue(':targeting', $chassis->getTargeting(), PDO::PARAM_INT);
		$query->bindValue(':angled', $chassis->getAngled(), PDO::PARAM_BOOL);
		$query->bindValue(':flat_top', $chassis->getFlat_top(), PDO::PARAM_BOOL);
		$query->bindValue(':front', $chassis->getFront(), PDO::PARAM_BOOL);
		$query->bindValue(':light', $chassis->getLight(), PDO::PARAM_BOOL);
		$query->bindValue(':low', $chassis->getLow(), PDO::PARAM_BOOL);
		$query->bindValue(':rear', $chassis->getRear(), PDO::PARAM_BOOL);
		$query->bindValue(':sloped', $chassis->getSloped(), PDO::PARAM_BOOL);
		$query->bindValue(':tires', $chassis->getTires(), PDO::PARAM_BOOL);
		$query->bindValue(':treads', $chassis->getTreads(), PDO::PARAM_BOOL);
		$query->bindValue(':updated_on', time());

		$query->execute() or die(print_r($query->errorInfo(), true));
	}
}