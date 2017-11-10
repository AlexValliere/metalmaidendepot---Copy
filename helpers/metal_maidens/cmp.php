<?php
function cmp_tank_asc($a, $b)
{
	return strcmp($a->getTank(), $b->getTank());
}

function cmp_tank_desc($a, $b)
{
	return strcmp($a->getTank(), $b->getTank()) * -1;
}

function cmp_root_head_id_asc($a, $b)
{
	if ($a->getRoot_head_id() == $b->getRoot_head_id())
		return 0;
	return ($a->getRoot_head_id() < $b->getRoot_head_id()) ? -1 : 1;
}

function cmp_root_head_id_desc($a, $b)
{
	if ($a->getRoot_head_id() == $b->getRoot_head_id())
		return 0;
	return ($a->getRoot_head_id() < $b->getRoot_head_id()) ? 1 : -1;
}

function cmp_rarity_asc($a, $b)
{
	$rarities_table = array("gold" => 3, "purple" => 2, "blue" => 1);
	if ($a->getRarity() == $b->getRarity())
		return 0;
	else
		return $rarities_table[$a->getRarity()] < $rarities_table[$b->getRarity()] ? -1 : 1;
}

function cmp_rarity_desc($a, $b)
{
	$rarities_table = array("gold" => 3, "purple" => 2, "blue" => 1);
	if ($a->getRarity() == $b->getRarity())
		return 0;
	else
		return $rarities_table[$a->getRarity()] < $rarities_table[$b->getRarity()] ? 1 : -1;
}

function cmp_blueprint_rank_asc($a, $b)
{
	if ($a->getBlueprint_rank() == $b->getBlueprint_rank())
		return 0;
	return ($a->getBlueprint_rank() < $b->getBlueprint_rank()) ? -1 : 1;
}

function cmp_blueprint_rank_desc($a, $b)
{
	if ($a->getBlueprint_rank() == $b->getBlueprint_rank())
		return 0;
	return ($a->getBlueprint_rank() < $b->getBlueprint_rank()) ? 1 : -1;
}

function cmp_category_asc($a, $b)
{
	return strcmp($a->getCategory(), $b->getCategory());
}

function cmp_category_desc($a, $b)
{
	return strcmp($a->getCategory(), $b->getCategory()) * -1;
}

function cmp_firepower_asc($a, $b)
{
	if ($a->getFirepower() == $b->getFirepower())
		return 0;
	return ($a->getFirepower() < $b->getFirepower()) ? -1 : 1;
}

function cmp_firepower_desc($a, $b)
{
	if ($a->getFirepower() == $b->getFirepower())
		return 0;
	return ($a->getFirepower() < $b->getFirepower()) ? 1 : -1;
}

function cmp_penetration_asc($a, $b)
{
	if ($a->getPenetration() == $b->getPenetration())
		return 0;
	return ($a->getPenetration() < $b->getPenetration()) ? -1 : 1;
}

function cmp_penetration_desc($a, $b)
{
	if ($a->getPenetration() == $b->getPenetration())
		return 0;
	return ($a->getPenetration() < $b->getPenetration()) ? 1 : -1;
}

function cmp_durability_asc($a, $b)
{
	if ($a->getDurability() == $b->getDurability())
		return 0;
	return ($a->getDurability() < $b->getDurability()) ? -1 : 1;
}

function cmp_durability_desc($a, $b)
{
	if ($a->getDurability() == $b->getDurability())
		return 0;
	return ($a->getDurability() < $b->getDurability()) ? 1 : -1;
}

function cmp_armor_asc($a, $b)
{
	if ($a->getArmor() == $b->getArmor())
		return 0;
	return ($a->getArmor() < $b->getArmor()) ? -1 : 1;
}

function cmp_armor_desc($a, $b)
{
	if ($a->getArmor() == $b->getArmor())
		return 0;
	return ($a->getArmor() < $b->getArmor()) ? 1 : -1;
}

function cmp_targeting_asc($a, $b)
{
	if ($a->getTargeting() == $b->getTargeting())
		return 0;
	return ($a->getTargeting() < $b->getTargeting()) ? -1 : 1;
}

function cmp_targeting_desc($a, $b)
{
	if ($a->getTargeting() == $b->getTargeting())
		return 0;
	return ($a->getTargeting() < $b->getTargeting()) ? 1 : -1;
}

function cmp_evasion_asc($a, $b)
{
	if ($a->getEvasion() == $b->getEvasion())
		return 0;
	return ($a->getEvasion() < $b->getEvasion()) ? -1 : 1;
}

function cmp_evasion_desc($a, $b)
{
	if ($a->getEvasion() == $b->getEvasion())
		return 0;
	return ($a->getEvasion() < $b->getEvasion()) ? 1 : -1;
}

function cmp_stealth_asc($a, $b)
{
	if ($a->getStealth() == $b->getStealth())
		return 0;
	return ($a->getStealth() < $b->getStealth()) ? -1 : 1;
}

function cmp_stealth_desc($a, $b)
{
	if ($a->getStealth() == $b->getStealth())
		return 0;
	return ($a->getStealth() < $b->getStealth()) ? 1 : -1;
}

function cmp_detection_asc($a, $b)
{
	if ($a->getDetection() == $b->getDetection())
		return 0;
	return ($a->getDetection() < $b->getDetection()) ? -1 : 1;
}

function cmp_detection_desc($a, $b)
{
	if ($a->getDetection() == $b->getDetection())
		return 0;
	return ($a->getDetection() < $b->getDetection()) ? 1 : -1;
}

///////////////////////////////////////////////////////////////////////////////////////////////////
//			Hybrid comparaison with previous functions
///////////////////////////////////////////////////////////////////////////////////////////////////

function cmp_rarity_then_tank_asc($a, $b)
{
	$rarities_table = array("gold" => 3, "purple" => 2, "blue" => 1);
	if ($a->getRarity() == $b->getRarity())
		return cmp_tank_asc($a, $b);
	else
		return $rarities_table[$a->getRarity()] < $rarities_table[$b->getRarity()] ? -1 : 1;
}

function cmp_rarity_then_tank_desc($a, $b)
{
	$rarities_table = array("gold" => 3, "purple" => 2, "blue" => 1);
	if ($a->getRarity() == $b->getRarity())
		return cmp_tank_asc($a, $b);
	else
		return $rarities_table[$a->getRarity()] < $rarities_table[$b->getRarity()] ? 1 : -1;
}

function cmp_category_then_rarity_then_tank_asc($a, $b)
{
	$rarities_table = array("gold" => 3, "purple" => 2, "blue" => 1);
	
	if ($a->getRarity() == $b->getRarity() && $a->getCategory() == $b->getCategory())
	{
		return cmp_tank_asc($a, $b);
	}
	else if ($a->getCategory() == $b->getCategory() && $a->getRarity() != $b->getRarity())
	{
		return cmp_rarity_asc($a, $b);
	}
	else
	{
		return cmp_category_asc($a, $b);
	}
}

function cmp_category_then_rarity_then_tank_desc($a, $b)
{
	$rarities_table = array("gold" => 3, "purple" => 2, "blue" => 1);
	
	if ($a->getRarity() == $b->getRarity() && $a->getCategory() == $b->getCategory())
	{
		return cmp_tank_asc($a, $b);
	}
	else if ($a->getCategory() == $b->getCategory() && $a->getRarity() != $b->getRarity())
	{
		return cmp_rarity_desc($a, $b);
	}
	else
	{
		return cmp_category_asc($a, $b);
	}
}

function cmp_rarity_then_category_then_tank_asc($a, $b)
{
	$rarities_table = array("gold" => 3, "purple" => 2, "blue" => 1);
	
	if ($a->getRarity() == $b->getRarity() && $a->getCategory() == $b->getCategory())
	{
		return cmp_tank_asc($a, $b);
	}
	else if ($a->getRarity() == $b->getRarity() && $a->getCategory() != $b->getCategory())
	{
		return cmp_category_asc($a, $b);
	}
	else
	{
		return cmp_rarity_asc($a, $b);
	}
}

function cmp_rarity_then_category_then_tank_desc($a, $b)
{
	$rarities_table = array("gold" => 3, "purple" => 2, "blue" => 1);
	
	if ($a->getRarity() == $b->getRarity() && $a->getCategory() == $b->getCategory())
	{
		return cmp_tank_asc($a, $b);
	}
	else if ($a->getRarity() == $b->getRarity() && $a->getCategory() != $b->getCategory())
	{
		return cmp_category_asc($a, $b);
	}
	else
	{
		return cmp_rarity_desc($a, $b);
	}
}
?>