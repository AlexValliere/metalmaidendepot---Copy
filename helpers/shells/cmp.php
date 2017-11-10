<?php
function cmp_shell_id_asc(Shell $a, Shell $b)
{
	if ($a->getId() == $b->getId())
		return 0;
	return ($a->getId() < $b->getId()) ? -1 : 1;
}

function cmp_shell_id_desc(Shell $a, Shell $b)
{
	if ($a->getId() == $b->getId())
		return 0;
	return ($a->getId() < $b->getId()) ? 1 : -1;
}

function cmp_shell_name_asc(Shell $a, Shell $b)
{
	return strcmp($a->getName(), $b->getName());
}

function cmp_shell_name_desc(Shell $a, Shell $b)
{
	return strcmp($a->getName(), $b->getName()) * -1;
}

function cmp_shell_category_asc(Shell $a, Shell $b)
{
	return strcmp($a->getCategory(), $b->getCategory());
}

function cmp_shell_category_desc(Shell $a, Shell $b)
{
	return strcmp($a->getCategory(), $b->getCategory()) * -1;
}

function cmp_shell_tier_asc(Shell $a, Shell $b)
{
	if ($a->getTier() == $b->getTier())
	{
		if ($a->getLevel() < $b->getLevel())
			return -1;
		else if ($a->getLevel() > $b->getLevel())
			return 1;
		else
			return 0;
	}
	return ($a->getTier() < $b->getTier()) ? -1 : 1;
}

function cmp_shell_tier_desc(Shell $a, Shell $b)
{
	if ($a->getTier() == $b->getTier())
	{
		if ($a->getLevel() < $b->getLevel())
			return 1;
		else if ($a->getLevel() > $b->getLevel())
			return -1;
		else
			return 0;
	}
	return ($a->getTier() < $b->getTier()) ? 1 : -1;
}

function cmp_shell_firepower_asc(Shell $a, Shell $b)
{
	if ($a->getFirepower() == $b->getFirepower())
		return 0;
	return ($a->getFirepower() < $b->getFirepower()) ? -1 : 1;
}

function cmp_shell_firepower_desc(Shell $a, Shell $b)
{
	if ($a->getFirepower() == $b->getFirepower())
		return 0;
	return ($a->getFirepower() < $b->getFirepower()) ? 1 : -1;
}

function cmp_shell_penetration_asc(Shell $a, Shell $b)
{
	if ($a->getPenetration() == $b->getPenetration())
		return 0;
	return ($a->getPenetration() < $b->getPenetration()) ? -1 : 1;
}

function cmp_shell_penetration_desc(Shell $a, Shell $b)
{
	if ($a->getPenetration() == $b->getPenetration())
		return 0;
	return ($a->getPenetration() < $b->getPenetration()) ? 1 : -1;
}

function cmp_shell_targeting_asc(Shell $a, Shell $b)
{
	if ($a->getPenetration() == $b->getPenetration())
		return 0;
	return ($a->getPenetration() < $b->getPenetration()) ? -1 : 1;
}

function cmp_shell_targeting_desc(Shell $a, Shell $b)
{
	if ($a->getTargeting() == $b->getTargeting())
		return 0;
	return ($a->getTargeting() < $b->getTargeting()) ? 1 : -1;
}

function cmp_shell_evasion_asc(Shell $a, Shell $b)
{
	if ($a->getPenetration() == $b->getPenetration())
		return 0;
	return ($a->getPenetration() < $b->getPenetration()) ? -1 : 1;
}

function cmp_shell_evasion_desc(Shell $a, Shell $b)
{
	if ($a->getEvasion() == $b->getEvasion())
		return 0;
	return ($a->getEvasion() < $b->getEvasion()) ? 1 : -1;
}

function cmp_shell_stealth_asc(Shell $a, Shell $b)
{
	if ($a->getPenetration() == $b->getPenetration())
		return 0;
	return ($a->getPenetration() < $b->getPenetration()) ? -1 : 1;
}

function cmp_shell_stealth_desc(Shell $a, Shell $b)
{
	if ($a->getStealth() == $b->getStealth())
		return 0;
	return ($a->getStealth() < $b->getStealth()) ? 1 : -1;
}
?>