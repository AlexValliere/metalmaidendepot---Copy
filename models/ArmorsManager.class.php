<?php
class ArmorsManager
{
	private $_dbhandler;

	public function __construct( $dbhandler )		{ $this->setDbhandler( $dbhandler ); }
	public function getDbhandler()					{ return $this->_dbhandler; }
	public function setDbhandler( PDO $dbhandler )	{ $this->_dbhandler = $dbhandler; }

	public function count() {
		return $this->_dbhandler->query('SELECT COUNT(*) FROM `armors`')->fetchColumn();
	}

	public function exists( $id ) {
		$query = $this->_dbhandler->prepare('SELECT COUNT(*) FROM `armors` WHERE id = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);

		return (bool) $query->fetchColumn();
	}

	public function get( $id ) {
		$query = $this->_dbhandler->prepare('
			SELECT *
			FROM `armors`
			WHERE `armors`.`id` = :id'
		);
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();

		$data = $query->fetch(PDO::FETCH_ASSOC);

		if ($data != false)
		{
			return new Armor($data);
		}
		else
			return false;
	}

	public function get_all() {
		$armors = array();

		$armor_query = $this->_dbhandler->query('
			SELECT *
			FROM `armors`
		');

		while ($data_armor = $armor_query->fetch(PDO::FETCH_ASSOC))
		{
			$armor = new Armor($data_armor);
			$armors[] = $armor;
		}

		return $armors;
	}

	public function get_by_category( $category ) {
		global $pw_armor;

		$armors = array();
		$category = strtolower($category);

		if (in_array($category, $pw_armor))
		{
			$armor_query = $this->_dbhandler->prepare('
				SELECT *
				FROM `armors`
				WHERE category = :category
			');
			$armor_query->bindValue(':category', strtolower($category));
			$armor_query->execute();

			while ($data_armor = $armor_query->fetch(PDO::FETCH_ASSOC))
			{
				$armor = new Armor($data_armor);
				$armors[] = $armor;
			}
		}

		return $armors;
	}

	public function add( Armor $armor ) {
		$query = $this->_dbhandler->prepare('INSERT INTO `armors`
			SET name = :name,
				category = :category,
				tier = :tier,
				level = :level,
				armor = :armor,
				durability = :durability,
				evasion = :evasion,
				stealth = :stealth,
				targeting = :targeting,
				cast = :cast,
				composite = :composite,
				hardened = :hardened,
				riveted = :riveted,
				spaced = :spaced,
				tempered = :tempered,
				wedge = :wedge,
				welded = :welded,
				created_on = FROM_UNIXTIME(:created_on),
				updated_on = FROM_UNIXTIME(:updated_on)'
			);

		$query->bindValue(':name', $armor->getName(), PDO::PARAM_STR);
		$query->bindValue(':category', $armor->getCategory(), PDO::PARAM_STR);
		$query->bindValue(':tier', $armor->getTier(), PDO::PARAM_INT);
		$query->bindValue(':level', $armor->getLevel(), PDO::PARAM_INT);
		$query->bindValue(':armor', $armor->getArmor(), PDO::PARAM_INT);
		$query->bindValue(':durability', $armor->getDurability(), PDO::PARAM_INT);
		$query->bindValue(':evasion', $armor->getEvasion(), PDO::PARAM_INT);
		$query->bindValue(':stealth', $armor->getStealth(), PDO::PARAM_INT);
		$query->bindValue(':targeting', $armor->getTargeting(), PDO::PARAM_INT);
		$query->bindValue(':cast', $armor->getCast(), PDO::PARAM_BOOL);
		$query->bindValue(':composite', $armor->getComposite(), PDO::PARAM_BOOL);
		$query->bindValue(':hardened', $armor->getHardened(), PDO::PARAM_BOOL);
		$query->bindValue(':riveted', $armor->getRiveted(), PDO::PARAM_BOOL);
		$query->bindValue(':spaced', $armor->getSpaced(), PDO::PARAM_BOOL);
		$query->bindValue(':tempered', $armor->getTempered(), PDO::PARAM_BOOL);
		$query->bindValue(':wedge', $armor->getWedge(), PDO::PARAM_BOOL);
		$query->bindValue(':welded', $armor->getWelded(), PDO::PARAM_BOOL);
		$query->bindValue(':created_on', time());
		$query->bindValue(':updated_on', time());

		$query->execute();
	}

	public function update( Armor $armor ) {
		$query = $this->_dbhandler->prepare('UPDATE `armors`
			SET name = :name,
				category = :category,
				tier = :tier,
				level = :level,
				armor = :armor,
				durability = :durability,
				evasion = :evasion,
				stealth = :stealth,
				targeting = :targeting,
				cast = :cast,
				composite = :composite,
				hardened = :hardened,
				riveted = :riveted,
				spaced = :spaced,
				tempered = :tempered,
				wedge = :wedge,
				welded = :welded,
				updated_on = FROM_UNIXTIME(:updated_on)
			WHERE id = :id');

		$query->bindValue(':id', $armor->getId(), PDO::PARAM_INT);
		$query->bindValue(':name', $armor->getName(), PDO::PARAM_STR);
		$query->bindValue(':category', $armor->getCategory(), PDO::PARAM_STR);
		$query->bindValue(':tier', $armor->getTier(), PDO::PARAM_INT);
		$query->bindValue(':level', $armor->getLevel(), PDO::PARAM_INT);
		$query->bindValue(':armor', $armor->getArmor(), PDO::PARAM_INT);
		$query->bindValue(':durability', $armor->getDurability(), PDO::PARAM_INT);
		$query->bindValue(':evasion', $armor->getEvasion(), PDO::PARAM_INT);
		$query->bindValue(':stealth', $armor->getStealth(), PDO::PARAM_INT);
		$query->bindValue(':targeting', $armor->getTargeting(), PDO::PARAM_INT);
		$query->bindValue(':cast', $armor->getCast(), PDO::PARAM_BOOL);
		$query->bindValue(':composite', $armor->getComposite(), PDO::PARAM_BOOL);
		$query->bindValue(':hardened', $armor->getHardened(), PDO::PARAM_BOOL);
		$query->bindValue(':riveted', $armor->getRiveted(), PDO::PARAM_BOOL);
		$query->bindValue(':spaced', $armor->getSpaced(), PDO::PARAM_BOOL);
		$query->bindValue(':tempered', $armor->getTempered(), PDO::PARAM_BOOL);
		$query->bindValue(':wedge', $armor->getWedge(), PDO::PARAM_BOOL);
		$query->bindValue(':welded', $armor->getWelded(), PDO::PARAM_BOOL);
		$query->bindValue(':updated_on', time());

		$query->execute() or die(print_r($query->errorInfo(), true));
	}
}