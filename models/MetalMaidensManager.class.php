<?php
class MetalMaidensManager
{
	private $_dbhandler;

	public function __construct( $dbhandler )		{ $this->setDbhandler( $dbhandler ); }
	public function getDbhandler()					{ return $this->_dbhandler; }
	public function setDbhandler( PDO $dbhandler )	{ $this->_dbhandler = $dbhandler; }

	/*
	 *  Index:
	 *	count()									Return the number of tanks indexed
	 *	exists( $id )							Return a boolean | True if $id is found
	 *	tank_slug_exists( $tank_slug )			Return a boolean | True if $tank_slug is found
	 *
	 *  Getter:
	 *  get( $id )								Return a Metal Maiden object WHERE id = $id
	 *  get_by_tank_slug( $tank_slug )			Return a Metal Maiden object WHERE tank_slug = $tank_slug
	 *  get_like_name( $name )					Return an array of Metal Maiden objects WHERE name contains by $name
	 *  get_like_tank_slug( $tank_slug )		Return an array of Metal Maiden objects WHERE tank_slug start by $tank_slug
	 *  get_all()								Return an array of Metal Maiden objects with all Metal Maidens available
	 *  get_from_columns( $columns )			Return an array of Metal Maiden objects WHERE $columns["key"] == $columns["value"]
	 *  get_category( $category )				Return an array of Metal Maiden objects with all Metal Maidens from a specified category $category
	 *  get_nation( $nation )					Return an array of Metal Maiden objects with all Metal Maidens from a specified nation $nation
	 *  get_rarity( $rarity )					Return an array of Metal Maiden objects with all Metal Maidens from a specified rarity $rarity
	 *  get_attribute_rank_for_id_in_category( $tank_id, $tank_category, $tank_attribute )
	 *											Return an array with rank and delta median of a tank attribute for a specified tank id and tank category: array("rank" => rank_value, "delta_median" => delta_median_value)
	 *  get_upward_relations( MetalMaiden $metalMaiden )						Get an array of Metal Maidens unlockable with $metalMaiden
	 *  get_downward_relations( MetalMaiden $metalMaiden )						Get an array of Metal Maidens that lead to $metalMaiden
	 *  get_attached_armors(MetalMaiden $metalMaiden)							Get an array of armor relations
	 *  get_attached_chassis(MetalMaiden $metalMaiden)							Get an array of chassis relations
	 *  get_attached_engines(MetalMaiden $metalMaiden)							Get an array of engine relations
	 *  get_attached_shells(MetalMaiden $metalMaiden)							Get an array of shell relations $array["shell_id"] = range
	 *
	 *  Database:
	 *  add( MetalMaiden $metalMaiden )												Add $metalMaiden of the database
	 *  add_upward_relations( MetalMaiden $metalMaiden, $metalMaidens)				Add upward relations to $metalMaiden
	 *  add_downward_relations( MetalMaiden $metalMaiden, $metalMaidens)			Add downward relations to $metalMaiden
	 *  attach_armor_to_metal_maiden(MetalMaiden $metalMaiden, $armor_id = 0)		Add armor relation to a metal maiden
	 *  attach_chassis_to_metal_maiden(MetalMaiden $metalMaiden, $chassis_id = 0)	Add chassis relation to a metal maiden
	 *  attach_engine_to_metal_maiden(MetalMaiden $metalMaiden, $engine_id = 0)		Add engine relation to a metal maiden
	 *  attach_shell_to_metal_maiden(MetalMaiden $metalMaiden, $shell_id = 0, $shell_range = 0)	Add shell relation with range to a metal maiden
	 *  update_shell_range_from_metal_maiden(MetalMaiden $metalMaiden, $shell_id = 0, $shell_range = 0) Update range on shell relation
	 *  remove_armor_from_metal_maiden(MetalMaiden $metalMaiden, $armor_id = 0)		Remove armor relation from a metal maiden
	 *  remove_chassis_from_metal_maiden(MetalMaiden $metalMaiden, $chassis_id = 0)	Remove chassis relation from a metal maiden
	 *  remove_engine_from_metal_maiden(MetalMaiden $metalMaiden, $engine_id = 0)	Remove engine relation from a metal maiden
	 *  remove_shell_from_metal_maiden(MetalMaiden $metalMaiden, $shell_id = 0)		Remove shell relation from a metal maiden
	 *  update( MetalMaiden $metalMaiden )  										Update a Metal Maiden object
	 *  updateRequirements( MetalMaiden $metalMaiden, $requirements )				Update requirements for a Metal Maiden object
	 *	delete( MetalMaiden $metalMaiden )											Remove a Metal Maiden from the database
	 */

	public function count( $include_hidden = FALSE ) {
		if ( $include_hidden == TRUE )
		{
			return $this->_dbhandler->query('SELECT COUNT(*) FROM `metal_maidens`')->fetchColumn();
		}
		else
		{
			return $this->_dbhandler->query('SELECT COUNT(*) FROM `metal_maidens` WHERE `hidden` = 0')->fetchColumn();
		}
	}

	public function exists( $id ) {
		$query = $this->_dbhandler->prepare('SELECT COUNT(*) FROM `metal_maidens` WHERE id = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);

		return (bool) $query->fetchColumn();
	}

	public function tank_slug_exists( $tank_slug ) {
		$query = $this->_dbhandler->prepare('SELECT COUNT(*) FROM `metal_maidens` WHERE tank_slug = :tank_slug');
		$query->execute(array(':tank_slug' => $tank_slug));

		return (bool) $query->fetchColumn();
	}

	public function get( $id ) {
		$query = $this->_dbhandler->prepare('
			SELECT `metal_maidens`.*,
			`metal_maidens_req`.*,
			(SELECT GROUP_CONCAT(`armors_metal_maidens`.`armor_id`)
				FROM `armors_metal_maidens`
				WHERE `armors_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS armor_ids,
			(SELECT GROUP_CONCAT(`engines_metal_maidens`.`engine_id`)
				FROM `engines_metal_maidens`
				WHERE `engines_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS engine_ids,
			(SELECT GROUP_CONCAT(`metal_maidens_shells`.`shell_id`)
				FROM `metal_maidens_shells`
				WHERE `metal_maidens_shells`.`metal_maiden_id` = `metal_maidens`.`id`) AS shell_ids,
			(SELECT GROUP_CONCAT(`chassis_metal_maidens`.`chassis_id`)
				FROM `chassis_metal_maidens`
				WHERE `chassis_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS chassis_ids
			FROM `metal_maidens`
			LEFT JOIN `metal_maidens_req`
				ON `metal_maidens`.`id` = `metal_maidens_req`.`tank_id`
			WHERE `metal_maidens`.`id` = :id'
		);
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();

		$data = $query->fetch(PDO::FETCH_ASSOC);

		if ($data != false)
			return new MetalMaiden($data);
		else
			return false;
	}

	public function get_by_tank_slug( $tank_slug ) {
		$query = $this->_dbhandler->prepare('
			SELECT `metal_maidens`.*,
			`metal_maidens_req`.*,
			(SELECT GROUP_CONCAT(`armors_metal_maidens`.`armor_id`)
				FROM `armors_metal_maidens`
				WHERE `armors_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS armor_ids,
			(SELECT GROUP_CONCAT(`engines_metal_maidens`.`engine_id`)
				FROM `engines_metal_maidens`
				WHERE `engines_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS engine_ids,
			(SELECT GROUP_CONCAT(`metal_maidens_shells`.`shell_id`)
				FROM `metal_maidens_shells`
				WHERE `metal_maidens_shells`.`metal_maiden_id` = `metal_maidens`.`id`) AS shell_ids,
			(SELECT GROUP_CONCAT(`chassis_metal_maidens`.`chassis_id`)
				FROM `chassis_metal_maidens`
				WHERE `chassis_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS chassis_ids
			FROM `metal_maidens`
			LEFT JOIN `metal_maidens_req`
				ON `metal_maidens`.`id` = `metal_maidens_req`.`tank_id`
			WHERE `metal_maidens`.`tank_slug` = :tank_slug'
		);
		$query->bindValue(':tank_slug', $tank_slug);
		$query->execute();

		$data = $query->fetch(PDO::FETCH_ASSOC);

		if ($data != false)
			return new MetalMaiden($data);
		else
			return false;
	}

	public function get_like_tank_slug( $tank_slug ) {
		$metalMaidens = array();

		$query = $this->_dbhandler->prepare('
			SELECT `metal_maidens`.*,
			`metal_maidens_req`.*,
			(SELECT GROUP_CONCAT(`armors_metal_maidens`.`armor_id`)
				FROM `armors_metal_maidens`
				WHERE `armors_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS armor_ids,
			(SELECT GROUP_CONCAT(`engines_metal_maidens`.`engine_id`)
				FROM `engines_metal_maidens`
				WHERE `engines_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS engine_ids,
			(SELECT GROUP_CONCAT(`metal_maidens_shells`.`shell_id`)
				FROM `metal_maidens_shells`
				WHERE `metal_maidens_shells`.`metal_maiden_id` = `metal_maidens`.`id`) AS shell_ids,
			(SELECT GROUP_CONCAT(`chassis_metal_maidens`.`chassis_id`)
				FROM `chassis_metal_maidens`
				WHERE `chassis_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS chassis_ids
			FROM `metal_maidens`
			LEFT JOIN `metal_maidens_req`
				ON `metal_maidens`.`id` = `metal_maidens_req`.`tank_id`
			WHERE `metal_maidens`.`tank_slug` LIKE :tank_slug
			GROUP BY `metal_maidens`.`id`;
		');
		$query->bindValue(':tank_slug', '%' . $tank_slug . '%');
		$query->execute();

		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$metalMaidens[] = new MetalMaiden($data);
		}

		return $metalMaidens;
	}

	public function get_like_name( $name ) {
		$metalMaidens = array();

		$query = $this->_dbhandler->prepare('
			SELECT `metal_maidens`.*,
			`metal_maidens_req`.*,
			(SELECT GROUP_CONCAT(`armors_metal_maidens`.`armor_id`)
				FROM `armors_metal_maidens`
				WHERE `armors_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS armor_ids,
			(SELECT GROUP_CONCAT(`engines_metal_maidens`.`engine_id`)
				FROM `engines_metal_maidens`
				WHERE `engines_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS engine_ids,
			(SELECT GROUP_CONCAT(`metal_maidens_shells`.`shell_id`)
				FROM `metal_maidens_shells`
				WHERE `metal_maidens_shells`.`metal_maiden_id` = `metal_maidens`.`id`) AS shell_ids,
			(SELECT GROUP_CONCAT(`chassis_metal_maidens`.`chassis_id`)
				FROM `chassis_metal_maidens`
				WHERE `chassis_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS chassis_ids
			FROM `metal_maidens`
			LEFT JOIN `metal_maidens_req`
				ON `metal_maidens`.`id` = `metal_maidens_req`.`tank_id`
			WHERE `metal_maidens`.`name` LIKE :name
			GROUP BY `metal_maidens`.`id`;
		');
		$query->bindValue(':name', '%' . $name . '%');
		$query->execute();

		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$metalMaidens[] = new MetalMaiden($data);
		}

		return $metalMaidens;
	}

	public function get_all() {
		$metalMaidens = array();

		$query = $this->_dbhandler->query('
			SELECT `metal_maidens`.*,
			`metal_maidens_req`.*,
			(SELECT GROUP_CONCAT(`armors_metal_maidens`.`armor_id`)
				FROM `armors_metal_maidens`
				WHERE `armors_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS armor_ids,
			(SELECT GROUP_CONCAT(`engines_metal_maidens`.`engine_id`)
				FROM `engines_metal_maidens`
				WHERE `engines_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS engine_ids,
			(SELECT GROUP_CONCAT(`metal_maidens_shells`.`shell_id`)
				FROM `metal_maidens_shells`
				WHERE `metal_maidens_shells`.`metal_maiden_id` = `metal_maidens`.`id`) AS shell_ids,
			(SELECT GROUP_CONCAT(`chassis_metal_maidens`.`chassis_id`)
				FROM `chassis_metal_maidens`
				WHERE `chassis_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS chassis_ids
			FROM `metal_maidens`
			LEFT JOIN `metal_maidens_req`
				ON `metal_maidens`.`id` = `metal_maidens_req`.`tank_id`
			ORDER BY `metal_maidens`.`tank`');

		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$metalMaidens[] = new MetalMaiden($data);
		}

		return $metalMaidens;
	}

	public function get_from_columns( $columns ) {
		$metalMaidens = array();
		$where_conditions = "";
		$bind_columns = array();

		global $pw_tank_categories, $pw_nations, $pw_tank_rarities;

		$query = 'SELECT `metal_maidens`.*,
			`metal_maidens_req`.*,
			(SELECT GROUP_CONCAT(`armors_metal_maidens`.`armor_id`)
				FROM `armors_metal_maidens`
				WHERE `armors_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS armor_ids,
			(SELECT GROUP_CONCAT(`engines_metal_maidens`.`engine_id`)
				FROM `engines_metal_maidens`
				WHERE `engines_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS engine_ids,
			(SELECT GROUP_CONCAT(`metal_maidens_shells`.`shell_id`)
				FROM `metal_maidens_shells`
				WHERE `metal_maidens_shells`.`metal_maiden_id` = `metal_maidens`.`id`) AS shell_ids,
			(SELECT GROUP_CONCAT(`chassis_metal_maidens`.`chassis_id`)
				FROM `chassis_metal_maidens`
				WHERE `chassis_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS chassis_ids
			FROM `metal_maidens`
			LEFT JOIN `metal_maidens_req`
				ON `metal_maidens`.`id` = `metal_maidens_req`.`tank_id`
			WHERE ';

		if (array_key_exists("category", $columns) && array_key_exists($columns["category"], $pw_tank_categories))
		{
			$where_conditions .= " category = :category";
			$bind_columns[] = "category";
		}

		if (array_key_exists("nation", $columns) && in_array($columns["nation"], $pw_nations))
		{
			if (!empty($where_conditions)) $where_conditions .= " AND";
			$where_conditions .= " nation = :nation";
			$bind_columns[] = "nation";
		}

		if (array_key_exists("rarity", $columns) && array_key_exists($columns["rarity"], $pw_tank_rarities))
		{
			if (!empty($where_conditions)) $where_conditions .= " AND";
			$where_conditions .= " rarity = :rarity";
			$bind_columns[] = "rarity";
		}

		if (!empty($where_conditions))
		{

			$query .= $where_conditions;
			$query .= ' ORDER BY `metal_maidens`.`tank`';
			$query = $this->_dbhandler->prepare($query);

			foreach ($bind_columns as $column)
			{
				$query->bindValue(':' . $column, $columns[$column]);
			}
			$query->execute();

			while ($data = $query->fetch(PDO::FETCH_ASSOC))
			{
				$metalMaidens[] = new MetalMaiden($data);
			}
		}

		return $metalMaidens;
	}

	public function get_category( $category ) {
		global $pw_tank_categories;

		$metalMaidens = array();
		$category = strtolower($category);

		if (array_key_exists($category, $pw_tank_categories))
		{
			$query = $this->_dbhandler->prepare('
				SELECT `metal_maidens`.*,
				`metal_maidens_req`.*,
				(SELECT GROUP_CONCAT(`armors_metal_maidens`.`armor_id`)
					FROM `armors_metal_maidens`
					WHERE `armors_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS armor_ids,
				(SELECT GROUP_CONCAT(`engines_metal_maidens`.`engine_id`)
					FROM `engines_metal_maidens`
					WHERE `engines_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS engine_ids,
				(SELECT GROUP_CONCAT(`metal_maidens_shells`.`shell_id`)
					FROM `metal_maidens_shells`
					WHERE `metal_maidens_shells`.`metal_maiden_id` = `metal_maidens`.`id`) AS shell_ids,
				(SELECT GROUP_CONCAT(`chassis_metal_maidens`.`chassis_id`)
					FROM `chassis_metal_maidens`
					WHERE `chassis_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS chassis_ids
				FROM `metal_maidens`
				LEFT JOIN `metal_maidens_req`
					ON `metal_maidens`.`id` = `metal_maidens_req`.`tank_id`
				WHERE category = :category ORDER BY `metal_maidens`.`tank`');
			$query->bindValue(':category', $category);
			$query->execute();

			while ($data = $query->fetch(PDO::FETCH_ASSOC))
			{
				$metalMaidens[] = new MetalMaiden($data);
			}
		}

		return $metalMaidens;
	}

	public function get_nation( $nation ) {
		global $pw_nations;

		$metalMaidens = array();
		$nation = strtolower($nation);

		if (in_array($nation, $pw_nations))
		{
			$query = $this->_dbhandler->prepare('
				SELECT `metal_maidens`.*,
				`metal_maidens_req`.*,
				(SELECT GROUP_CONCAT(`armors_metal_maidens`.`armor_id`)
					FROM `armors_metal_maidens`
					WHERE `armors_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS armor_ids,
				(SELECT GROUP_CONCAT(`engines_metal_maidens`.`engine_id`)
					FROM `engines_metal_maidens`
					WHERE `engines_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS engine_ids,
				(SELECT GROUP_CONCAT(`metal_maidens_shells`.`shell_id`)
					FROM `metal_maidens_shells`
					WHERE `metal_maidens_shells`.`metal_maiden_id` = `metal_maidens`.`id`) AS shell_ids,
				(SELECT GROUP_CONCAT(`chassis_metal_maidens`.`chassis_id`)
					FROM `chassis_metal_maidens`
					WHERE `chassis_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS chassis_ids
				FROM `metal_maidens`
				LEFT JOIN `metal_maidens_req`
					ON `metal_maidens`.`id` = `metal_maidens_req`.`tank_id`
				WHERE nation = :nation ORDER BY `metal_maidens`.`tank`');
			$query->bindValue(':nation', $nation);
			$query->execute();

			while ($data = $query->fetch(PDO::FETCH_ASSOC))
			{
				$metalMaidens[] = new MetalMaiden($data);
			}
		}

		return $metalMaidens;
	}

	public function get_rarity( $rarity ) {
		global $pw_tank_rarities;

		$metalMaidens = array();
		$rarity = strtolower($rarity);

		if (array_key_exists(strtolower($rarity), $pw_tank_rarities))
		{
			$query = $this->_dbhandler->prepare('
				SELECT `metal_maidens`.*,
				`metal_maidens_req`.*,
				(SELECT GROUP_CONCAT(`armors_metal_maidens`.`armor_id`)
					FROM `armors_metal_maidens`
					WHERE `armors_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS armor_ids,
				(SELECT GROUP_CONCAT(`engines_metal_maidens`.`engine_id`)
					FROM `engines_metal_maidens`
					WHERE `engines_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS engine_ids,
				(SELECT GROUP_CONCAT(`metal_maidens_shells`.`shell_id`)
					FROM `metal_maidens_shells`
					WHERE `metal_maidens_shells`.`metal_maiden_id` = `metal_maidens`.`id`) AS shell_ids,
				(SELECT GROUP_CONCAT(`chassis_metal_maidens`.`chassis_id`)
					FROM `chassis_metal_maidens`
					WHERE `chassis_metal_maidens`.`metal_maiden_id` = `metal_maidens`.`id`) AS chassis_ids
				FROM `metal_maidens`
				LEFT JOIN `metal_maidens_req`
					ON `metal_maidens`.`id` = `metal_maidens_req`.`tank_id`
				WHERE rarity = :rarity ORDER BY `metal_maidens`.`tank`');
			$query->bindValue(':rarity', $rarity);
			$query->execute();

			while ($data = $query->fetch(PDO::FETCH_ASSOC))
			{
				$metalMaidens[] = new MetalMaiden($data);
			}
		}

		return $metalMaidens;
	}

	public function get_attribute_rank_for_id_in_category( $tank_id, $tank_category, $tank_attribute ) {
		global $pw_tank_categories;
		global $pw_tank_attributes;

		$tank_category = strtolower($tank_category);
		$tank_attribute = strtolower($tank_attribute);

		$allowed_categories = array_merge(["all"], array_keys($pw_tank_categories));

		if (in_array($tank_category, $allowed_categories) && in_array($tank_attribute, $pw_tank_attributes))
		{
			$tanks_array = array();
			$rank = "n/a";
			$delta_median = "n/a";

			$query = "SELECT * FROM `metal_maidens`";

			if ($tank_category != "all")									$query .= " WHERE category = :category";
			if ($tank_attribute == "stealth" && ($tank_category == "ht"))	$query .= " ORDER BY stealth asc";
			else															$query .= " ORDER BY " . $tank_attribute . " desc";

			$query = $this->_dbhandler->prepare($query);
			$query->bindValue(':category', $tank_category);
			$query->execute();

			while ($data = $query->fetch(PDO::FETCH_ASSOC))
				$tanks_array[] = new MetalMaiden($data);

			$i = 1;
			$last_attribute_value = $tanks_array[0]->getAttribute($tank_attribute);
			foreach ($tanks_array as $tank)
			{
				if ($last_attribute_value != $tank->getAttribute($tank_attribute))
					++$i;
				$last_attribute_value = $tank->getAttribute($tank_attribute);
			
				if ($tank->getId() == $tank_id)
				{
					$rank = $i;
					$delta_median = intval($tank->getAttribute($tank_attribute) - $tanks_array[count($tanks_array) / 2]->getAttribute($tank_attribute));
				}
			}
			return array("rank" => $rank, "delta_median" => $delta_median);
		}

		return NULL;
	}

	public function get_attached_armors(MetalMaiden $metalMaiden) {
		if (empty($metalMaiden->getArmor_ids()))
		{
			return [];
		}
		else
		{
			$query = $this->_dbhandler->prepare('
			SELECT *
			FROM `armors_metal_maidens`
			WHERE metal_maiden_id = :metal_maiden_id');
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId());
			$query->execute();

			$armors = [];

			while ($data = $query->fetch(PDO::FETCH_ASSOC))
			{
				$armors[] = $data["armor_id"];
			}

			return $armors;
		}
	}

	public function get_attached_chassis(MetalMaiden $metalMaiden) {
		$query = $this->_dbhandler->prepare('
		SELECT *
		FROM `chassis_metal_maidens`
		WHERE metal_maiden_id = :metal_maiden_id');
		$query->bindValue(':metal_maiden_id', $metalMaiden->getId());
		$query->execute();

		$chassis_array = [];

		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$chassis_array[] = $data["chassis_id"];
		}

		return $chassis_array;
	}

	public function get_attached_engines(MetalMaiden $metalMaiden) {
		if (empty($metalMaiden->getEngine_ids()))
		{
			return [];
		}
		else
		{
			$query = $this->_dbhandler->prepare('
			SELECT *
			FROM `engines_metal_maidens`
			WHERE metal_maiden_id = :metal_maiden_id');
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId());
			$query->execute();

			$engines = [];

			while ($data = $query->fetch(PDO::FETCH_ASSOC))
			{
				$engines[] = $data["engine_id"];
			}

			return $engines;
		}
	}

	public function get_attached_shells(MetalMaiden $metalMaiden) {
		if (empty($metalMaiden->getShell_ids()))
		{
			return [];
		}
		else
		{
			$query = $this->_dbhandler->prepare('
			SELECT *
			FROM `metal_maidens_shells`
			WHERE metal_maiden_id = :metal_maiden_id');
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId());
			$query->execute();

			$shells = [];

			while ($data = $query->fetch(PDO::FETCH_ASSOC))
			{
				$shells[$data["shell_id"]]["shell_range"] = $data["shell_range"];
			}

			return $shells;
		}
	}

	public function get_upward_relations( MetalMaiden $metalMaiden ) {
		$metalMaidens = array();

		$query = $this->_dbhandler->prepare('
			SELECT *
			FROM `metal_maidens_rel`
			WHERE from_id = :tank_id');
		$query->bindValue(':tank_id', $metalMaiden->getId());
		$query->execute();

		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$query2 = $this->_dbhandler->prepare('
				SELECT *
				FROM `metal_maidens`
				INNER JOIN `metal_maidens_req`
				ON `metal_maidens`.`id` = `metal_maidens_req`.`tank_id`
				WHERE `metal_maidens`.`id` = :id'
			);
			$query2->bindValue(':id', $data["to_id"], PDO::PARAM_INT);
			$query2->execute();

			$data2 = $query2->fetch(PDO::FETCH_ASSOC);

			if ($data2 != false)
				$metalMaidens[] = new MetalMaiden($data2);
		}

		if (!empty($metalMaidens))
			$metalMaidens = array_unique($metalMaidens);

		return $metalMaidens;
	}

	public function get_downward_relations( MetalMaiden $metalMaiden ) {
		$metalMaidens = array();

		$query = $this->_dbhandler->prepare('
			SELECT *
			FROM `metal_maidens_rel`
			WHERE to_id = :tank_id');
		$query->bindValue(':tank_id', $metalMaiden->getId());
		$query->execute();

		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$query2 = $this->_dbhandler->prepare('
				SELECT *
				FROM `metal_maidens`
				INNER JOIN `metal_maidens_req`
				ON `metal_maidens`.`id` = `metal_maidens_req`.`tank_id`
				WHERE `metal_maidens`.`id` = :id'
			);
			$query2->bindValue(':id', $data["from_id"], PDO::PARAM_INT);
			$query2->execute();

			$data2 = $query2->fetch(PDO::FETCH_ASSOC);

			if ($data2 != false)
				$metalMaidens[] = new MetalMaiden($data2);
		}

		if (!empty($metalMaidens))
			$metalMaidens = array_unique($metalMaidens);

		return $metalMaidens;
	}

	public function add( MetalMaiden $metalMaiden ) {
		$query = $this->_dbhandler->prepare('INSERT INTO `metal_maidens`
			SET name = :name,
				tank = :tank,
				tank_slug = :tank_slug,
				root_head_id = :root_head_id,
				category = :category,
				nation = :nation,
				rarity = :rarity,
				character_voice = :character_voice,
				live2d = :live2d,
				live2d_name = :live2d_name,
				ammo = :ammo,
				ammo_game_version = :ammo_game_version,
				profile_game_version = :profile_game_version,
				lifestyle_skills = :lifestyle_skills,
				equipment_slots = :equipment_slots,
				engine_bonus = :engine_bonus,
				chassis_bonus = :chassis_bonus,
				firepower = :firepower,
				penetration = :penetration,
				durability = :durability,
				armor = :armor,
				stealth = :stealth,
				detection = :detection,
				targeting = :targeting,
				evasion = :evasion,
				fire_resist = :fire_resist,
				crit_resist = :crit_resist,
				crit_defense = :crit_defense,
				firepower_lvl60 = :firepower_lvl60,
				penetration_lvl60 = :penetration_lvl60,
				durability_lvl60 = :durability_lvl60,
				armor_lvl60 = :armor_lvl60,
				min_range = :min_range,
				max_range = :max_range,
				quote_intro = :quote_intro,
				quote_main_screen_1 = :quote_main_screen_1,
				quote_main_screen_2 = :quote_main_screen_2,
				quote_main_screen_3 = :quote_main_screen_3,
				quote_main_screen_4 = :quote_main_screen_4,
				quote_main_screen_5 = :quote_main_screen_5,
				quote_main_screen_6 = :quote_main_screen_6,
				quote_upgrading = :quote_upgrading,
				quote_pre_attack_1 = :quote_pre_attack_1,
				quote_pre_attack_2 = :quote_pre_attack_2,
				quote_pre_attack_3 = :quote_pre_attack_3,
				quote_on_attack_1 = :quote_on_attack_1,
				quote_on_attack_2 = :quote_on_attack_2,
				quote_on_attack_3 = :quote_on_attack_3,
				quote_on_attack_4 = :quote_on_attack_4,
				quote_on_attack_5 = :quote_on_attack_5,
				quote_on_attack_6 = :quote_on_attack_6,
				quote_on_attack_7 = :quote_on_attack_7,
				quote_getting_hit = :quote_getting_hit,
				quote_upon_destruction = :quote_upon_destruction,
				quote_added_to_squad = :quote_added_to_squad,
				quote_choice_of_essential_equipment_1 = :quote_choice_of_essential_equipment_1,
				quote_choice_of_essential_equipment_2 = :quote_choice_of_essential_equipment_2,
				quote_choice_of_essential_equipment_3 = :quote_choice_of_essential_equipment_3,
				quote_choice_of_essential_equipment_4 = :quote_choice_of_essential_equipment_4,
				quote_when_updating_equipment_1 = :quote_when_updating_equipment_1,
				quote_when_updating_equipment_2 = :quote_when_updating_equipment_2,
				quote_when_updating_equipment_3 = :quote_when_updating_equipment_3,
				quote_unequip_all_gear = :quote_unequip_all_gear,
				quote_battle_victory_1 = :quote_battle_victory_1,
				quote_battle_victory_2 = :quote_battle_victory_2,
				quote_battle_victory_3 = :quote_battle_victory_3,
				quote_battle_loss = :quote_battle_loss,
				quote_fate = :quote_fate,
				hidden = :hidden'
			);

		$query->bindValue(':name', $metalMaiden->getName(), PDO::PARAM_STR);
		$query->bindValue(':tank', $metalMaiden->getTank(), PDO::PARAM_STR);
		$query->bindValue(':tank_slug', $metalMaiden->getTank_slug(), PDO::PARAM_STR);
		$query->bindValue(':root_head_id', $metalMaiden->getRoot_head_id(), PDO::PARAM_INT);
		$query->bindValue(':category', $metalMaiden->getCategory(), PDO::PARAM_STR);
		$query->bindValue(':nation', $metalMaiden->getNation(), PDO::PARAM_STR);
		$query->bindValue(':rarity', $metalMaiden->getRarity(), PDO::PARAM_STR);
		$query->bindValue(':character_voice', $metalMaiden->getCharacter_voice(), PDO::PARAM_STR);
		$query->bindValue(':live2d', $metalMaiden->getLive2d(), PDO::PARAM_STR);
		$query->bindValue(':live2d_name', $metalMaiden->getLive2d_name(), PDO::PARAM_STR);
		$query->bindValue(':ammo', serialize($metalMaiden->getAmmo()));
		$query->bindValue(':ammo_game_version', $metalMaiden->getAmmo_game_version(), PDO::PARAM_STR);
		$query->bindValue(':profile_game_version', $metalMaiden->getProfile_game_version(), PDO::PARAM_STR);
		$query->bindValue(':lifestyle_skills', serialize($metalMaiden->getLifestyle_skills()));
		$query->bindValue(':equipment_slots', serialize($metalMaiden->getEquipment_slots()));
		$query->bindValue(':engine_bonus', serialize($metalMaiden->getEngine_bonus()));
		$query->bindValue(':chassis_bonus', serialize($metalMaiden->getChassis_bonus()));
		$query->bindValue(':firepower', $metalMaiden->getFirepower(), PDO::PARAM_INT);
		$query->bindValue(':penetration', $metalMaiden->getPenetration(), PDO::PARAM_INT);
		$query->bindValue(':durability', $metalMaiden->getDurability(), PDO::PARAM_INT);
		$query->bindValue(':armor', $metalMaiden->getArmor(), PDO::PARAM_INT);
		$query->bindValue(':stealth', $metalMaiden->getStealth(), PDO::PARAM_INT);
		$query->bindValue(':detection', $metalMaiden->getDetection(), PDO::PARAM_INT);
		$query->bindValue(':targeting', $metalMaiden->getTargeting(), PDO::PARAM_INT);
		$query->bindValue(':evasion', $metalMaiden->getEvasion(), PDO::PARAM_INT);
		$query->bindValue(':fire_resist', $metalMaiden->getFire_resist(), PDO::PARAM_STR);
		$query->bindValue(':crit_resist', $metalMaiden->getCrit_resist(), PDO::PARAM_STR);
		$query->bindValue(':crit_defense', $metalMaiden->getCrit_defense(), PDO::PARAM_STR);
		$query->bindValue(':firepower_lvl60', $metalMaiden->getFirepower_lvl60(), PDO::PARAM_INT);
		$query->bindValue(':penetration_lvl60', $metalMaiden->getPenetration_lvl60(), PDO::PARAM_INT);
		$query->bindValue(':durability_lvl60', $metalMaiden->getDurability_lvl60(), PDO::PARAM_INT);
		$query->bindValue(':armor_lvl60', $metalMaiden->getArmor_lvl60(), PDO::PARAM_INT);
		$query->bindValue(':min_range', $metalMaiden->getMin_range(), PDO::PARAM_INT);
		$query->bindValue(':max_range', $metalMaiden->getMax_range(), PDO::PARAM_INT);
		$query->bindValue(':quote_intro', $metalMaiden->getQuote_intro());
		$query->bindValue(':quote_main_screen_1', $metalMaiden->getQuote_main_screen_1());
		$query->bindValue(':quote_main_screen_2', $metalMaiden->getQuote_main_screen_2());
		$query->bindValue(':quote_main_screen_3', $metalMaiden->getQuote_main_screen_3());
		$query->bindValue(':quote_main_screen_4', $metalMaiden->getQuote_main_screen_4());
		$query->bindValue(':quote_main_screen_5', $metalMaiden->getQuote_main_screen_5());
		$query->bindValue(':quote_main_screen_6', $metalMaiden->getQuote_main_screen_6());
		$query->bindValue(':quote_upgrading', $metalMaiden->getQuote_upgrading());
		$query->bindValue(':quote_pre_attack_1', $metalMaiden->getQuote_pre_attack_1());
		$query->bindValue(':quote_pre_attack_2', $metalMaiden->getQuote_pre_attack_2());
		$query->bindValue(':quote_pre_attack_3', $metalMaiden->getQuote_pre_attack_3());
		$query->bindValue(':quote_on_attack_1', $metalMaiden->getQuote_on_attack_1());
		$query->bindValue(':quote_on_attack_2', $metalMaiden->getQuote_on_attack_2());
		$query->bindValue(':quote_on_attack_3', $metalMaiden->getQuote_on_attack_3());
		$query->bindValue(':quote_on_attack_4', $metalMaiden->getQuote_on_attack_4());
		$query->bindValue(':quote_on_attack_5', $metalMaiden->getQuote_on_attack_5());
		$query->bindValue(':quote_on_attack_6', $metalMaiden->getQuote_on_attack_6());
		$query->bindValue(':quote_on_attack_7', $metalMaiden->getQuote_on_attack_7());
		$query->bindValue(':quote_getting_hit', $metalMaiden->getQuote_getting_hit());
		$query->bindValue(':quote_upon_destruction', $metalMaiden->getQuote_upon_destruction());
		$query->bindValue(':quote_added_to_squad', $metalMaiden->getQuote_added_to_squad());
		$query->bindValue(':quote_choice_of_essential_equipment_1', $metalMaiden->getQuote_choice_of_essential_equipment_1());
		$query->bindValue(':quote_choice_of_essential_equipment_2', $metalMaiden->getQuote_choice_of_essential_equipment_2());
		$query->bindValue(':quote_choice_of_essential_equipment_3', $metalMaiden->getQuote_choice_of_essential_equipment_3());
		$query->bindValue(':quote_choice_of_essential_equipment_4', $metalMaiden->getQuote_choice_of_essential_equipment_4());
		$query->bindValue(':quote_when_updating_equipment_1', $metalMaiden->getQuote_when_updating_equipment_1());
		$query->bindValue(':quote_when_updating_equipment_2', $metalMaiden->getQuote_when_updating_equipment_2());
		$query->bindValue(':quote_when_updating_equipment_3', $metalMaiden->getQuote_when_updating_equipment_3());
		$query->bindValue(':quote_unequip_all_gear', $metalMaiden->getQuote_unequip_all_gear());
		$query->bindValue(':quote_battle_victory_1', $metalMaiden->getQuote_battle_victory_1());
		$query->bindValue(':quote_battle_victory_2', $metalMaiden->getQuote_battle_victory_2());
		$query->bindValue(':quote_battle_victory_3', $metalMaiden->getQuote_battle_victory_3());
		$query->bindValue(':quote_battle_loss', $metalMaiden->getQuote_battle_loss());
		$query->bindValue(':quote_fate', $metalMaiden->getQuote_fate());
		$query->bindValue(':hidden', $metalMaiden->getHidden(), PDO::PARAM_BOOL);

		$query->execute();

		$query = $this->_dbhandler->prepare('
			SELECT *
			FROM `metal_maidens`
			WHERE `metal_maidens`.`tank_slug` = :tank_slug'
		);
		$query->bindValue(':tank_slug', $metalMaiden->getTank_slug());
		$query->execute();
		$metalMaiden = new MetalMaiden($query->fetch(PDO::FETCH_ASSOC));

		if ($metalMaiden != false)
		{
			$query = $this->_dbhandler->prepare('INSERT INTO `metal_maidens_req`
				SET tank_id = :tank_id,
					tank_slug = :tank_slug'
			);
			$query->bindValue(':tank_id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':tank_slug', $metalMaiden->getTank_slug());
			$query->execute();
		}
		else
			echo var_dump($metalMaiden);
	}

	public function add_upward_relations( MetalMaiden $metalMaiden, $metalMaidens)
	{
		if (!empty($metalMaidens))
		{
			if (is_array($metalMaidens))
				$metalMaidens = array_unique($metalMaidens);
			else
				$metalMaidens = array($metalMaidens);
			$upward_relations = $this->get_upward_relations($metalMaiden);

			foreach($metalMaidens as $ite)
			{
				if (!in_array($ite, $upward_relations))
				{
					$query = $this->_dbhandler->prepare('INSERT INTO `metal_maidens_rel`
						SET from_id = :from_id,
							to_id = :to_id
					');
					$query->bindValue(':from_id', $metalMaiden->getId(), PDO::PARAM_INT);
					$query->bindValue(':to_id', $ite->getId(), PDO::PARAM_INT);
					$query->execute();
				}
			}
		}
	}

	public function add_downward_relations( MetalMaiden $metalMaiden, $metalMaidens)
	{
		if (!empty($metalMaidens))
		{
			if (is_array($metalMaidens))
				$metalMaidens = array_unique($metalMaidens);
			else
				$metalMaidens = array($metalMaidens);
			$downward_relations = $this->get_downward_relations($metalMaiden);

			foreach($metalMaidens as $ite)
			{
				if (!in_array($ite, $downward_relations))
				{
					$query = $this->_dbhandler->prepare('INSERT INTO `metal_maidens_rel`
						SET from_id = :from_id,
							to_id = :to_id
					');
					$query->bindValue(':from_id', $ite->getId(), PDO::PARAM_INT);
					$query->bindValue(':to_id', $metalMaiden->getId(), PDO::PARAM_INT);
					$query->execute();
				}
			}
		}
	}

	public function attach_armor_to_metal_maiden(MetalMaiden $metalMaiden, $armor_id = 0) {
		$current_armor_ids = $metalMaiden->getArmor_ids();

		if (!in_array($armor_id, $current_armor_ids))
		{
			$query = 'INSERT INTO `armors_metal_maidens`
				SET armor_id = :armor_id,
					metal_maiden_id = :metal_maiden_id';

			$query = $this->_dbhandler->prepare($query);
			$query->bindValue(':armor_id', $armor_id, PDO::PARAM_INT);
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->execute();

			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens`
				SET updated_on = FROM_UNIXTIME(:updated_on)
				WHERE id = :id');
			$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':updated_on', time());
			$query->execute() or die(print_r($query->errorInfo(), true));
		}
	}

	public function attach_engine_to_metal_maiden(MetalMaiden $metalMaiden, $engine_id = 0) {
		$current_engine_ids = $metalMaiden->getEngine_ids();

		if (!in_array($engine_id, $current_engine_ids))
		{
			$query = 'INSERT INTO `engines_metal_maidens`
				SET engine_id = :engine_id,
					metal_maiden_id = :metal_maiden_id';

			$query = $this->_dbhandler->prepare($query);
			$query->bindValue(':engine_id', $engine_id, PDO::PARAM_INT);
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->execute();

			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens`
				SET updated_on = FROM_UNIXTIME(:updated_on)
				WHERE id = :id');
			$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':updated_on', time());
			$query->execute() or die(print_r($query->errorInfo(), true));
		}
	}

	public function attach_chassis_to_metal_maiden(MetalMaiden $metalMaiden, $chassis_id = 0) {
		$current_chassis_ids = $metalMaiden->getChassis_ids();

		if (!in_array($chassis_id, $current_chassis_ids))
		{
			$query = 'INSERT INTO `chassis_metal_maidens`
				SET chassis_id = :chassis_id,
					metal_maiden_id = :metal_maiden_id';

			$query = $this->_dbhandler->prepare($query);
			$query->bindValue(':chassis_id', $chassis_id, PDO::PARAM_INT);
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->execute() or die(print_r($query->errorInfo(), true));

			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens`
				SET updated_on = FROM_UNIXTIME(:updated_on)
				WHERE id = :id');
			$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':updated_on', time());
			$query->execute() or die(print_r($query->errorInfo(), true));
		}
	}

	public function attach_shell_to_metal_maiden(MetalMaiden $metalMaiden, $shell_id = 0, $shell_range = 0) {
		$current_shell_ids = $metalMaiden->getShell_ids();

		if (!in_array($shell_id, $current_shell_ids))
		{
			$query = 'INSERT INTO `metal_maidens_shells`
				SET metal_maiden_id = :metal_maiden_id,
					shell_id = :shell_id,
					shell_range = :shell_range';

			$query = $this->_dbhandler->prepare($query);
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':shell_id', $shell_id, PDO::PARAM_INT);
			$query->bindValue(':shell_range', $shell_range, PDO::PARAM_INT);
			$query->execute();

			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens`
				SET updated_on = FROM_UNIXTIME(:updated_on)
				WHERE id = :id');
			$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':updated_on', time());
			$query->execute() or die(print_r($query->errorInfo(), true));
		}
	}

	public function update_shell_range_from_metal_maiden(MetalMaiden $metalMaiden, $shell_id = 0, $shell_range = 0) {
		$current_shell_ids = $metalMaiden->getShell_ids();

		if (in_array($shell_id, $current_shell_ids))
		{
			$query = 'UPDATE `metal_maidens_shells`
				SET shell_range = :shell_range
				WHERE shell_id = :shell_id
					AND metal_maiden_id = :metal_maiden_id';

			$query = $this->_dbhandler->prepare($query);
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':shell_id', $shell_id, PDO::PARAM_INT);
			$query->bindValue(':shell_range', $shell_range, PDO::PARAM_INT);
			$query->execute();

			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens`
				SET updated_on = FROM_UNIXTIME(:updated_on)
				WHERE id = :id');
			$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':updated_on', time());
			$query->execute() or die(print_r($query->errorInfo(), true));
		}
	}

	public function remove_armor_from_metal_maiden(MetalMaiden $metalMaiden, $armor_id = 0) {
		$current_armor_ids = $metalMaiden->getArmor_ids();

		if (in_array($armor_id, $current_armor_ids))
		{
			$query = 'DELETE FROM `armors_metal_maidens`
				WHERE metal_maiden_id = :metal_maiden_id
					AND armor_id = :armor_id';

			$query = $this->_dbhandler->prepare($query);
			$query->bindValue(':armor_id', $armor_id, PDO::PARAM_INT);
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->execute();

			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens`
				SET updated_on = FROM_UNIXTIME(:updated_on)
				WHERE id = :id');
			$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':updated_on', time());
			$query->execute() or die(print_r($query->errorInfo(), true));
		}
	}

	public function remove_chassis_from_metal_maiden(MetalMaiden $metalMaiden, $chassis_id = 0) {
		$current_chassis_ids = $metalMaiden->getChassis_ids();

		if (in_array($chassis_id, $current_chassis_ids))
		{
			$query = 'DELETE FROM `chassis_metal_maidens`
				WHERE metal_maiden_id = :metal_maiden_id
					AND chassis_id = :chassis_id';

			$query = $this->_dbhandler->prepare($query);
			$query->bindValue(':chassis_id', $chassis_id, PDO::PARAM_INT);
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->execute() or die(print_r($query->errorInfo(), true));

			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens`
				SET updated_on = FROM_UNIXTIME(:updated_on)
				WHERE id = :id');
			$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':updated_on', time());
			$query->execute() or die(print_r($query->errorInfo(), true));
		}
	}

	public function remove_engine_from_metal_maiden(MetalMaiden $metalMaiden, $engine_id = 0) {
		$current_engine_ids = $metalMaiden->getEngine_ids();

		if (in_array($engine_id, $current_engine_ids))
		{
			$query = 'DELETE FROM `engines_metal_maidens`
				WHERE metal_maiden_id = :metal_maiden_id
					AND engine_id = :engine_id';

			$query = $this->_dbhandler->prepare($query);
			$query->bindValue(':engine_id', $engine_id, PDO::PARAM_INT);
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->execute();

			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens`
				SET updated_on = FROM_UNIXTIME(:updated_on)
				WHERE id = :id');
			$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':updated_on', time());
			$query->execute() or die(print_r($query->errorInfo(), true));
		}
	}

	public function remove_shell_from_metal_maiden(MetalMaiden $metalMaiden, $shell_id = 0) {
		$current_shell_ids = $metalMaiden->getShell_ids();

		if (in_array($shell_id, $current_shell_ids))
		{
			$query = 'DELETE FROM `metal_maidens_shells`
				WHERE metal_maiden_id = :metal_maiden_id
					AND shell_id = :shell_id';

			$query = $this->_dbhandler->prepare($query);
			$query->bindValue(':metal_maiden_id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':shell_id', $shell_id, PDO::PARAM_INT);
			$query->execute();

			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens`
				SET updated_on = FROM_UNIXTIME(:updated_on)
				WHERE id = :id');
			$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->bindValue(':updated_on', time());
			$query->execute() or die(print_r($query->errorInfo(), true));
		}
	}

	public function update( MetalMaiden $metalMaiden ) {
		$metalMaidensManager = new MetalMaidensManager($this->_dbhandler);

		$currentTank_slug = $metalMaiden->getTank_slug();

		$query = $this->_dbhandler->prepare('UPDATE `metal_maidens`
			SET name = :name,
				tank = :tank,
				tank_slug = :tank_slug,
				root_head_id = :root_head_id,
				category = :category,
				nation = :nation,
				rarity = :rarity,
				character_voice = :character_voice,
				live2d = :live2d,
				live2d_name = :live2d_name,
				ammo = :ammo,
				ammo_game_version = :ammo_game_version,
				profile_game_version = :profile_game_version,
				lifestyle_skills = :lifestyle_skills,
				equipment_slots = :equipment_slots,
				engine_bonus = :engine_bonus,
				chassis_bonus = :chassis_bonus,
				firepower = :firepower,
				penetration = :penetration,
				durability = :durability,
				armor = :armor,
				stealth = :stealth,
				detection = :detection,
				targeting = :targeting,
				evasion = :evasion,
				fire_resist = :fire_resist,
				crit_resist = :crit_resist,
				crit_defense = :crit_defense,
				firepower_lvl60 = :firepower_lvl60,
				penetration_lvl60 = :penetration_lvl60,
				durability_lvl60 = :durability_lvl60,
				armor_lvl60 = :armor_lvl60,
				min_range = :min_range,
				max_range = :max_range,
				quote_intro = :quote_intro,
				quote_main_screen_1 = :quote_main_screen_1,
				quote_main_screen_2 = :quote_main_screen_2,
				quote_main_screen_3 = :quote_main_screen_3,
				quote_main_screen_4 = :quote_main_screen_4,
				quote_main_screen_5 = :quote_main_screen_5,
				quote_main_screen_6 = :quote_main_screen_6,
				quote_upgrading = :quote_upgrading,
				quote_pre_attack_1 = :quote_pre_attack_1,
				quote_pre_attack_2 = :quote_pre_attack_2,
				quote_pre_attack_3 = :quote_pre_attack_3,
				quote_on_attack_1 = :quote_on_attack_1,
				quote_on_attack_2 = :quote_on_attack_2,
				quote_on_attack_3 = :quote_on_attack_3,
				quote_on_attack_4 = :quote_on_attack_4,
				quote_on_attack_5 = :quote_on_attack_5,
				quote_on_attack_6 = :quote_on_attack_6,
				quote_on_attack_7 = :quote_on_attack_7,
				quote_getting_hit = :quote_getting_hit,
				quote_upon_destruction = :quote_upon_destruction,
				quote_added_to_squad = :quote_added_to_squad,
				quote_choice_of_essential_equipment_1 = :quote_choice_of_essential_equipment_1,
				quote_choice_of_essential_equipment_2 = :quote_choice_of_essential_equipment_2,
				quote_choice_of_essential_equipment_3 = :quote_choice_of_essential_equipment_3,
				quote_choice_of_essential_equipment_4 = :quote_choice_of_essential_equipment_4,
				quote_when_updating_equipment_1 = :quote_when_updating_equipment_1,
				quote_when_updating_equipment_2 = :quote_when_updating_equipment_2,
				quote_when_updating_equipment_3 = :quote_when_updating_equipment_3,
				quote_unequip_all_gear = :quote_unequip_all_gear,
				quote_battle_victory_1 = :quote_battle_victory_1,
				quote_battle_victory_2 = :quote_battle_victory_2,
				quote_battle_victory_3 = :quote_battle_victory_3,
				quote_battle_loss = :quote_battle_loss,
				quote_fate = :quote_fate,
				hidden = :hidden,
				updated_on = FROM_UNIXTIME(:updated_on)
			WHERE id = :id');

		$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
		$query->bindValue(':name', $metalMaiden->getName(), PDO::PARAM_STR);
		$query->bindValue(':tank', $metalMaiden->getTank(), PDO::PARAM_STR);
		$query->bindValue(':tank_slug', $metalMaiden->getTank_slug(), PDO::PARAM_STR);
		$query->bindValue(':root_head_id', $metalMaiden->getRoot_head_id(), PDO::PARAM_INT);
		$query->bindValue(':category', $metalMaiden->getCategory(), PDO::PARAM_STR);
		$query->bindValue(':nation', $metalMaiden->getNation(), PDO::PARAM_STR);
		$query->bindValue(':rarity', $metalMaiden->getRarity(), PDO::PARAM_STR);
		$query->bindValue(':character_voice', $metalMaiden->getCharacter_voice(), PDO::PARAM_STR);
		$query->bindValue(':live2d', $metalMaiden->getLive2d(), PDO::PARAM_STR);
		$query->bindValue(':live2d_name', $metalMaiden->getLive2d_name(), PDO::PARAM_STR);
		$query->bindValue(':ammo', serialize($metalMaiden->getAmmo()));
		$query->bindValue(':ammo_game_version', $metalMaiden->getAmmo_game_version(), PDO::PARAM_STR);
		$query->bindValue(':profile_game_version', $metalMaiden->getProfile_game_version(), PDO::PARAM_STR);
		$query->bindValue(':lifestyle_skills', serialize($metalMaiden->getLifestyle_skills()));
		$query->bindValue(':equipment_slots', serialize($metalMaiden->getEquipment_slots()));
		$query->bindValue(':engine_bonus', serialize($metalMaiden->getEngine_bonus()));
		$query->bindValue(':chassis_bonus', serialize($metalMaiden->getChassis_bonus()));
		$query->bindValue(':firepower', $metalMaiden->getFirepower(), PDO::PARAM_INT);
		$query->bindValue(':penetration', $metalMaiden->getPenetration(), PDO::PARAM_INT);
		$query->bindValue(':durability', $metalMaiden->getDurability(), PDO::PARAM_INT);
		$query->bindValue(':armor', $metalMaiden->getArmor(), PDO::PARAM_INT);
		$query->bindValue(':stealth', $metalMaiden->getStealth(), PDO::PARAM_INT);
		$query->bindValue(':detection', $metalMaiden->getDetection(), PDO::PARAM_INT);
		$query->bindValue(':targeting', $metalMaiden->getTargeting(), PDO::PARAM_INT);
		$query->bindValue(':evasion', $metalMaiden->getEvasion(), PDO::PARAM_INT);
		$query->bindValue(':fire_resist', $metalMaiden->getFire_resist(), PDO::PARAM_STR);
		$query->bindValue(':crit_resist', $metalMaiden->getCrit_resist(), PDO::PARAM_STR);
		$query->bindValue(':crit_defense', $metalMaiden->getCrit_defense(), PDO::PARAM_STR);
		$query->bindValue(':firepower_lvl60', $metalMaiden->getFirepower_lvl60(), PDO::PARAM_INT);
		$query->bindValue(':penetration_lvl60', $metalMaiden->getPenetration_lvl60(), PDO::PARAM_INT);
		$query->bindValue(':durability_lvl60', $metalMaiden->getDurability_lvl60(), PDO::PARAM_INT);
		$query->bindValue(':armor_lvl60', $metalMaiden->getArmor_lvl60(), PDO::PARAM_INT);
		$query->bindValue(':min_range', $metalMaiden->getMin_range(), PDO::PARAM_INT);
		$query->bindValue(':max_range', $metalMaiden->getMax_range(), PDO::PARAM_INT);
		$query->bindValue(':quote_intro', $metalMaiden->getQuote_intro());
		$query->bindValue(':quote_main_screen_1', $metalMaiden->getQuote_main_screen_1());
		$query->bindValue(':quote_main_screen_2', $metalMaiden->getQuote_main_screen_2());
		$query->bindValue(':quote_main_screen_3', $metalMaiden->getQuote_main_screen_3());
		$query->bindValue(':quote_main_screen_4', $metalMaiden->getQuote_main_screen_4());
		$query->bindValue(':quote_main_screen_5', $metalMaiden->getQuote_main_screen_5());
		$query->bindValue(':quote_main_screen_6', $metalMaiden->getQuote_main_screen_6());
		$query->bindValue(':quote_upgrading', $metalMaiden->getQuote_upgrading());
		$query->bindValue(':quote_pre_attack_1', $metalMaiden->getQuote_pre_attack_1());
		$query->bindValue(':quote_pre_attack_2', $metalMaiden->getQuote_pre_attack_2());
		$query->bindValue(':quote_pre_attack_3', $metalMaiden->getQuote_pre_attack_3());
		$query->bindValue(':quote_on_attack_1', $metalMaiden->getQuote_on_attack_1());
		$query->bindValue(':quote_on_attack_2', $metalMaiden->getQuote_on_attack_2());
		$query->bindValue(':quote_on_attack_3', $metalMaiden->getQuote_on_attack_3());
		$query->bindValue(':quote_on_attack_4', $metalMaiden->getQuote_on_attack_4());
		$query->bindValue(':quote_on_attack_5', $metalMaiden->getQuote_on_attack_5());
		$query->bindValue(':quote_on_attack_6', $metalMaiden->getQuote_on_attack_6());
		$query->bindValue(':quote_on_attack_7', $metalMaiden->getQuote_on_attack_7());
		$query->bindValue(':quote_getting_hit', $metalMaiden->getQuote_getting_hit());
		$query->bindValue(':quote_upon_destruction', $metalMaiden->getQuote_upon_destruction());
		$query->bindValue(':quote_added_to_squad', $metalMaiden->getQuote_added_to_squad());
		$query->bindValue(':quote_choice_of_essential_equipment_1', $metalMaiden->getQuote_choice_of_essential_equipment_1());
		$query->bindValue(':quote_choice_of_essential_equipment_2', $metalMaiden->getQuote_choice_of_essential_equipment_2());
		$query->bindValue(':quote_choice_of_essential_equipment_3', $metalMaiden->getQuote_choice_of_essential_equipment_3());
		$query->bindValue(':quote_choice_of_essential_equipment_4', $metalMaiden->getQuote_choice_of_essential_equipment_4());
		$query->bindValue(':quote_when_updating_equipment_1', $metalMaiden->getQuote_when_updating_equipment_1());
		$query->bindValue(':quote_when_updating_equipment_2', $metalMaiden->getQuote_when_updating_equipment_2());
		$query->bindValue(':quote_when_updating_equipment_3', $metalMaiden->getQuote_when_updating_equipment_3());
		$query->bindValue(':quote_unequip_all_gear', $metalMaiden->getQuote_unequip_all_gear());
		$query->bindValue(':quote_battle_victory_1', $metalMaiden->getQuote_battle_victory_1());
		$query->bindValue(':quote_battle_victory_2', $metalMaiden->getQuote_battle_victory_2());
		$query->bindValue(':quote_battle_victory_3', $metalMaiden->getQuote_battle_victory_3());
		$query->bindValue(':quote_battle_loss', $metalMaiden->getQuote_battle_loss());
		$query->bindValue(':quote_fate', $metalMaiden->getQuote_fate());
		$query->bindValue(':hidden', $metalMaiden->getHidden(), PDO::PARAM_BOOL);
		$query->bindValue(':updated_on', time());

		$query->execute() or die(print_r($query->errorInfo(), true));

		if (VERBOSE)
		{

		}

		$metalMaiden = $metalMaidensManager->get_by_tank_slug($metalMaiden->getTank_slug());

		if ($currentTank_slug != $metalMaiden->getTank_slug())
		{
			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens_req`
				SET tank_slug = :tank_slug,
					tank_id = :tank_id
				WHERE tank_slug = :tank_slug_old');
			$query->bindValue(':tank_slug', $metalMaiden->getTank_slug());
			$query->bindValue(':tank_slug_old', $currentTank_slug);
			$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
			$query->execute();
		}
	}

	public function updateRequirements( MetalMaiden $metalMaiden, $requirements ) {
		$metalMaidensManager = new MetalMaidensManager($this->_dbhandler);
		$metalMaiden = $metalMaidensManager->get($metalMaiden->getId());

		if ($requirements != NULL || empty($requirements))
		{
			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens_req`
				SET forge = :forge,
					naval_port = :naval_port,
					refactor = :refactor,
					chapter = :chapter,
					method_1 = :method_1,
					method_2 = :method_2,
					method_3 = :method_3,
					develop = :develop,
					research = :research
				WHERE tank_id = :tank_id');
			$query->bindValue(':forge', $requirements["forge"]);
			$query->bindValue(':naval_port', $requirements["naval_port"]);
			$query->bindValue(':refactor', $requirements["refactor"]);
			$query->bindValue(':chapter', serialize($requirements["chapter"]));
			$query->bindValue(':method_1', serialize($requirements["method_1"]));
			$query->bindValue(':method_2', serialize($requirements["method_2"]));
			$query->bindValue(':method_3', serialize($requirements["method_3"]));
			$query->bindValue(':develop', serialize($requirements["develop"]));
			$query->bindValue(':research', serialize($requirements["research"]));
			$query->bindValue(':tank_id', $metalMaiden->getId());
		}
		else
		{
			$query = $this->_dbhandler->prepare('UPDATE `metal_maidens_req`
				SET forge = :forge,
					naval_port = :naval_port,
					refactor = :refactor,
					chapter = :chapter,
					method_1 = :method_1,
					method_2 = :method_2,
					method_3 = :method_3,
					develop = :develop,
					research = :research
				WHERE tank_id = :tank_id');
			$query->bindValue(':forge', 0);
			$query->bindValue(':naval_port', 0);
			$query->bindValue(':refactor', 0);
			$query->bindValue(':chapter', serialize(NULL));
			$query->bindValue(':method_1', serialize(NULL));
			$query->bindValue(':method_2', serialize(NULL));
			$query->bindValue(':method_3', serialize(NULL));
			$query->bindValue(':develop', serialize(NULL));
			$query->bindValue(':research', serialize(NULL));
			$query->bindValue(':tank_id', $metalMaiden->getId());
		}
		$query->execute();

		$query = $this->_dbhandler->prepare('UPDATE `metal_maidens`
			SET	updated_on = FROM_UNIXTIME(:updated_on)
			WHERE id = :id');
		$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
		$query->bindValue(':updated_on', time());
		$query->execute();
	}

	public function delete( MetalMaiden $metalMaiden ) {
		$query = $this->_dbhandler->prepare('DELETE FROM `metal_maidens` WHERE id = :id');
		$query->bindValue(':id', $metalMaiden->getId(), PDO::PARAM_INT);
		$query->execute();
	}
}