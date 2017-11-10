<?php
class ShellsManager
{
	private $_dbhandler;

	public function __construct( $dbhandler )		{ $this->setDbhandler( $dbhandler ); }
	public function getDbhandler()					{ return $this->_dbhandler; }
	public function setDbhandler( PDO $dbhandler )	{ $this->_dbhandler = $dbhandler; }

	public function count() {
		return $this->_dbhandler->query('SELECT COUNT(*) FROM `shells`')->fetchColumn();
	}

	public function exists( $id ) {
		$query = $this->_dbhandler->prepare('SELECT COUNT(*) FROM `shells` WHERE id = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);

		return (bool) $query->fetchColumn();
	}

	public function get( $id ) {
		$query_shell = $this->_dbhandler->prepare('
			SELECT *
			FROM `shells`
			WHERE `shells`.`id` = :id'
		);
		$query_shell->bindValue(':id', $id, PDO::PARAM_INT);
		$query_shell->execute();

		$data_shell = $query_shell->fetch(PDO::FETCH_ASSOC);

		if ($data_shell != false)
		{
			$query_shell_modifier = $this->_dbhandler->query('
				SELECT *
				FROM `shell_modifiers_shells`
				WHERE `shell_id` = ' . $data_shell["id"] . '
			');
			$query_shell_property = $this->_dbhandler->query('
				SELECT *
				FROM `shell_properties_shells`
				WHERE `shell_id` = ' . $data_shell["id"] . '
			');

			$data_shell_modifier_ids = [];
			$data_shell_property_ids = [];

			while ($data_shell_modifier = $query_shell_modifier->fetch(PDO::FETCH_ASSOC))
			{
				$data_shell_modifier_ids[] = $data_shell_modifier["shell_modifier_id"];
			}


			while ($data_shell_property = $query_shell_property->fetch(PDO::FETCH_ASSOC))
			{
				$data_shell_property_ids[] = $data_shell_property["shell_property_id"];
			}

			$data_shell["shell_modifiers_ids"] = $data_shell_modifier_ids;
			$data_shell["shell_properties_ids"] = $data_shell_property_ids;

			return new Shell($data_shell);
		}
		else
			return false;
	}

	public function get_all() {
		$shells = array();

		$shell_query = $this->_dbhandler->query('
			SELECT *
			FROM `shells`
		');

		while ($data_shell = $shell_query->fetch(PDO::FETCH_ASSOC))
		{
			$query_shell_modifier = $this->_dbhandler->query('
				SELECT *
				FROM `shell_modifiers_shells`
				WHERE `shell_id` = ' . $data_shell["id"] . '
			');
			$query_shell_property = $this->_dbhandler->query('
				SELECT *
				FROM `shell_properties_shells`
				WHERE `shell_id` = ' . $data_shell["id"] . '
			');

			$data_shell_modifier_ids = [];
			$data_shell_property_ids = [];

			while ($data_shell_modifier = $query_shell_modifier->fetch(PDO::FETCH_ASSOC))
			{
				$data_shell_modifier_ids[] = $data_shell_modifier["shell_modifier_id"];
			}


			while ($data_shell_property = $query_shell_property->fetch(PDO::FETCH_ASSOC))
			{
				$data_shell_property_ids[] = $data_shell_property["shell_property_id"];
			}

			$data_shell["shell_modifiers_ids"] = $data_shell_modifier_ids;
			$data_shell["shell_properties_ids"] = $data_shell_property_ids;

			$shell = new Shell($data_shell);
			$shells[] = $shell;
		}

		return $shells;
	}

	public function get_by_category( $category ) {
		global $pw_ammo;

		$shells = array();
		$category = strtolower($category);

		if (array_key_exists($category, $pw_ammo))
		{
			$shell_query = $this->_dbhandler->prepare('
				SELECT *
				FROM `shells`
				WHERE category = :category
			');
			$shell_query->bindValue(':category', strtoupper($category));
			$shell_query->execute();

			while ($data_shell = $shell_query->fetch(PDO::FETCH_ASSOC))
			{
				$query_shell_modifier = $this->_dbhandler->query('
					SELECT *
					FROM `shell_modifiers_shells`
					WHERE `shell_id` = ' . $data_shell["id"] . '
				');
				$query_shell_property = $this->_dbhandler->query('
					SELECT *
					FROM `shell_properties_shells`
					WHERE `shell_id` = ' . $data_shell["id"] . '
				');

				$data_shell_modifier_ids = [];
				$data_shell_property_ids = [];

				while ($data_shell_modifier = $query_shell_modifier->fetch(PDO::FETCH_ASSOC))
				{
					$data_shell_modifier_ids[] = $data_shell_modifier["shell_modifier_id"];
				}


				while ($data_shell_property = $query_shell_property->fetch(PDO::FETCH_ASSOC))
				{
					$data_shell_property_ids[] = $data_shell_property["shell_property_id"];
				}

				$data_shell["shell_modifiers_ids"] = $data_shell_modifier_ids;
				$data_shell["shell_properties_ids"] = $data_shell_property_ids;

				$shell = new Shell($data_shell);
				$shells[] = $shell;
			}
		}

		return $shells;
	}

	public function get_all_shell_modifiers() {
		$shell_modifiers = [];

		$query = $this->_dbhandler->query('
			SELECT *
			FROM `shell_modifiers`
			ORDER BY id
		');

		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$shell_modifiers[] = $data;
		}

		return $shell_modifiers;
	}

	public function get_all_shell_properties() {
		$shell_properties = [];

		$query = $this->_dbhandler->query('
			SELECT *
			FROM `shell_properties`
			ORDER BY id
		');

		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$shell_properties[] = $data;
		}

		return $shell_properties;
	}

	public function update( Shell $shell ) {
		$shellsManager = new ShellsManager($this->_dbhandler);

		$query = $this->_dbhandler->prepare('UPDATE `shells`
			SET category = :category,
				name = :name,
				tier = :tier,
				level = :level,
				firepower = :firepower,
				penetration = :penetration,
				targeting = :targeting,
				evasion = :evasion,
				stealth = :stealth
			WHERE id = :id');

		$query->bindValue(':id', $shell->getId(), PDO::PARAM_INT);
		$query->bindValue(':category', $shell->getCategory(), PDO::PARAM_STR);
		$query->bindValue(':name', $shell->getName(), PDO::PARAM_STR);
		$query->bindValue(':tier', $shell->getTier(), PDO::PARAM_INT);
		$query->bindValue(':level', $shell->getLevel(), PDO::PARAM_INT);
		$query->bindValue(':firepower', $shell->getFirepower(), PDO::PARAM_INT);
		$query->bindValue(':penetration', $shell->getPenetration(), PDO::PARAM_INT);
		$query->bindValue(':targeting', $shell->getTargeting(), PDO::PARAM_INT);
		$query->bindValue(':evasion', $shell->getEvasion(), PDO::PARAM_INT);
		$query->bindValue(':stealth', $shell->getStealth(), PDO::PARAM_INT);

		$query->execute() or die(print_r($query->errorInfo(), true));
	}
}