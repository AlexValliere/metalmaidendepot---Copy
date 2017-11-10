<?php
class PassiveSkillsManager
{
	private $_dbhandler;

	public function __construct( $dbhandler )		{ $this->setDbhandler( $dbhandler ); }
	public function getDbhandler()					{ return $this->_dbhandler; }
	public function setDbhandler( PDO $dbhandler )	{ $this->_dbhandler = $dbhandler; }

	public function count() {
		return $this->_dbhandler->query('SELECT COUNT(*) FROM `passive_skills`')->fetchColumn();
	}

	public function exists( $id ) {
		$query = $this->_dbhandler->prepare('SELECT COUNT(*) FROM `passive_skills` WHERE id = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);

		return (bool) $query->fetchColumn();
	}

	public function get( $id ) {
		$query = $this->_dbhandler->prepare('
			SELECT *
			FROM `passive_skills`
			WHERE `passive_skills`.`id` = :id'
		);
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();

		$data = $query->fetch(PDO::FETCH_ASSOC);

		if ($data != false)
		{
			return new PassiveSkill($data);
		}
		else
			return false;
	}

	public function get_all() {
		$passive_skills = array();

		$passive_skill_query = $this->_dbhandler->query('
			SELECT *
			FROM `passive_skills`
		');

		while ($data_passive_skill = $passive_skill_query->fetch(PDO::FETCH_ASSOC))
		{
			$passive_skill = new PassiveSkill($data_passive_skill);
			$passive_skills[] = $passive_skill;
		}

		return $passive_skills;
	}

	public function add( PassiveSkill $passive_skill ) {
		$query = $this->_dbhandler->prepare('INSERT INTO `passive_skills`
			SET name = :name,
				bonus_value_1 = :bonus_value_1,
				bonus_value_2 = :bonus_value_2,
				bonus_mult_1 = :bonus_mult_1,
				bonus_mult_2 = :bonus_mult_2,
				malus_eqpt_value_1 = :malus_eqpt_value_1,
				malus_eqpt_value_2 = :malus_eqpt_value_2,
				update_firepower_1 = :update_firepower_1,
				update_penetration_1 = :update_penetration_1,
				update_targeting_1 = :update_targeting_1,
				update_durability_1 = :update_durability_1,
				update_armor_1 = :update_armor_1,
				update_evasion_1 = :update_evasion_1,
				update_stealth_1 = :update_stealth_1,
				update_detection_1 = :update_detection_1,
				update_firepower_2 = :update_firepower_2,
				update_penetration_2 = :update_penetration_2,
				update_targeting_2 = :update_targeting_2,
				update_durability_2 = :update_durability_2,
				update_armor_2 = :update_armor_2,
				update_evasion_2 = :update_evasion_2,
				update_stealth_2 = :update_stealth_2,
				update_detection_2 = :update_detection_2
			');

		$query->bindValue(':name', $passive_skill->getName(), PDO::PARAM_STR);
		$query->bindValue(':bonus_value_1', $passive_skill->getBonus_value_1(), PDO::PARAM_INT);
		$query->bindValue(':bonus_value_2', $passive_skill->getBonus_value_2(), PDO::PARAM_INT);
		$query->bindValue(':bonus_mult_1', $passive_skill->getBonus_mult_1(), PDO::PARAM_INT);
		$query->bindValue(':bonus_mult_2', $passive_skill->getBonus_mult_2(), PDO::PARAM_INT);
		$query->bindValue(':malus_eqpt_value_1', $passive_skill->getMalus_eqpt_value_1(), PDO::PARAM_INT);
		$query->bindValue(':malus_eqpt_value_2', $passive_skill->getMalus_eqpt_value_2(), PDO::PARAM_INT);
		$query->bindValue(':update_firepower_1', $passive_skill->getUpdated_firepower_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_penetration_1', $passive_skill->getUpdated_penetration_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_targeting_1', $passive_skill->getUpdated_targeting_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_durability_1', $passive_skill->getUpdated_durability_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_armor_1', $passive_skill->getUpdated_armor_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_evasion_1', $passive_skill->getUpdated_evasion_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_stealth_1', $passive_skill->getUpdated_stealth_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_detection_1', $passive_skill->getUpdated_detection_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_firepower_2', $passive_skill->getUpdated_firepower_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_penetration_2', $passive_skill->getUpdated_penetration_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_targeting_2', $passive_skill->getUpdated_targeting_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_durability_2', $passive_skill->getUpdated_durability_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_armor_2', $passive_skill->getUpdated_armor_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_evasion_2', $passive_skill->getUpdated_evasion_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_stealth_2', $passive_skill->getUpdated_stealth_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_detection_2', $passive_skill->getUpdated_detection_2(), PDO::PARAM_BOOL);

		$query->execute();
	}

	public function update( Armor $armor ) {
		$query = $this->_dbhandler->prepare('UPDATE `passive_skills`
			SET name = :name,
				bonus_value_1 = :bonus_value_1,
				bonus_value_2 = :bonus_value_2,
				bonus_mult_1 = :bonus_mult_1,
				bonus_mult_2 = :bonus_mult_2,
				malus_eqpt_value_1 = :malus_eqpt_value_1,
				malus_eqpt_value_2 = :malus_eqpt_value_2,
				update_firepower_1 = :update_firepower_1,
				update_penetration_1 = :update_penetration_1,
				update_targeting_1 = :update_targeting_1,
				update_durability_1 = :update_durability_1,
				update_armor_1 = :update_armor_1,
				update_evasion_1 = :update_evasion_1,
				update_stealth_1 = :update_stealth_1,
				update_detection_1 = :update_detection_1,
				update_firepower_2 = :update_firepower_2,
				update_penetration_2 = :update_penetration_2,
				update_targeting_2 = :update_targeting_2,
				update_durability_2 = :update_durability_2,
				update_armor_2 = :update_armor_2,
				update_evasion_2 = :update_evasion_2,
				update_stealth_2 = :update_stealth_2,
				update_detection_2 = :update_detection_2
			WHERE id = :id');

		$query->bindValue(':name', $passive_skill->getName(), PDO::PARAM_STR);
		$query->bindValue(':bonus_value_1', $passive_skill->getBonus_value_1(), PDO::PARAM_INT);
		$query->bindValue(':bonus_value_2', $passive_skill->getBonus_value_2(), PDO::PARAM_INT);
		$query->bindValue(':bonus_mult_1', $passive_skill->getBonus_mult_1(), PDO::PARAM_INT);
		$query->bindValue(':bonus_mult_2', $passive_skill->getBonus_mult_2(), PDO::PARAM_INT);
		$query->bindValue(':malus_eqpt_value_1', $passive_skill->getMalus_eqpt_value_1(), PDO::PARAM_INT);
		$query->bindValue(':malus_eqpt_value_2', $passive_skill->getMalus_eqpt_value_2(), PDO::PARAM_INT);
		$query->bindValue(':update_firepower_1', $passive_skill->getUpdated_firepower_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_penetration_1', $passive_skill->getUpdated_penetration_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_targeting_1', $passive_skill->getUpdated_targeting_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_durability_1', $passive_skill->getUpdated_durability_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_armor_1', $passive_skill->getUpdated_armor_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_evasion_1', $passive_skill->getUpdated_evasion_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_stealth_1', $passive_skill->getUpdated_stealth_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_detection_1', $passive_skill->getUpdated_detection_1(), PDO::PARAM_BOOL);
		$query->bindValue(':update_firepower_2', $passive_skill->getUpdated_firepower_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_penetration_2', $passive_skill->getUpdated_penetration_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_targeting_2', $passive_skill->getUpdated_targeting_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_durability_2', $passive_skill->getUpdated_durability_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_armor_2', $passive_skill->getUpdated_armor_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_evasion_2', $passive_skill->getUpdated_evasion_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_stealth_2', $passive_skill->getUpdated_stealth_2(), PDO::PARAM_BOOL);
		$query->bindValue(':update_detection_2', $passive_skill->getUpdated_detection_2(), PDO::PARAM_BOOL);

		$query->execute() or die(print_r($query->errorInfo(), true));
	}
}