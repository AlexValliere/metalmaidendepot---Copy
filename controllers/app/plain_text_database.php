<?php
$sortableValues = ["tank"];

$armorsManager = new ArmorsManager( $dbhandler );
$chassisManager = new ChassisManager( $dbhandler );
$enginesManager = new EnginesManager( $dbhandler );
$metalMaidensManager = new MetalMaidensManager( $dbhandler );
$shellsManager = new ShellsManager( $dbhandler );

$armor_list = $armorsManager->get_all();
$chassis_list = $chassisManager->get_all();
$engine_list = $enginesManager->get_all();
$shell_list = $shellsManager->get_all();
$tank_list = $metalMaidensManager->get_all();
usort($tank_list, 'cmp_tank_asc');

$shell_modifiers = $shellsManager->get_all_shell_modifiers();
$shell_properties = $shellsManager->get_all_shell_properties();

$new_shell_modifiers = array(
	"Ballistic Cap"		=> "Increases targeting",
	"Cross"				=> "Increases targeting, reduces firepower",
	"Fin Stabilized"	=> "Increases targeting, reduces penetration",
	"High Explosive"	=> "Greatly increases firepower, reduces penetration",
	"Turbo"				=> "Increases targeting"
);

$new_shell_properties = array(
	"Assault"			=> "The closer the target, the greater the penetration",
	"Burning Agent"	=> "Shells have a chance to ignite targets without penetrating them.",
	"Burst"				=> "Applies a debuff that reduces the target's armor",
	"Capped"			=> "Reduces ricochet chance against specialised armors",
	"Composite Rigid"	=> "The closer the target, the greater the firepower",
	"Discarding Sabot"	=> "Penetrator rod ignores a portion of target's armor",
	"EFP"				=> "Affected by target's armor, low armor targets preferred",
	"Extended-Range"	=> "Has longer range than similar weapon",
	"Fragment"			=> "Chance to hit an additional target during Shelling",
	"Frangible"		=> "Increases damage against infantry, if no infantry left then crit rate increased",
	"Guerrilla"		=> "Small increase in crit chance and crit damage",
	"Hardened"			=> "Affected by target's armor, low armor targets preferred",
	"Heavy"			=> "The closer the target, the greater the penetration",
	"High Explosive"	=> "Target's armor is less effective",
	"Long-Rod"		=> "Ignores more armor than regular APDS",
	"Molten"			=> "Increases burning effect from combustion",
	"MSC"				=> "Target's armor is less effective",
	"Multi-Launch"		=> "Chance to hit an additional target during Shelling",
	"Multi-Launch"		=> "Chance to hit 2 additional targets during Shelling",
	"Quickfire"			=> "Quickfire clip increases damage by a certain percentage",
	"Rod-Cap"			=> "Reduces ricochet chance against specialised armors",
	"Shaped"		=> "Shells have a small chance to ignite targets without penetrating them.",
	"Shockwave"			=> "Increases critical chance by decreasing critical damage",
	"Spinning"			=> "Reduces ricochet chance against specialised armors",
	"Tandem"			=> "Reduces ricochet chance against specialised armors",
	"Tempered"			=> "Target's armor is less effective",
	"Tracer"			=> "Increases the target's chance to be targeted more often"
);

$indexes = ["armor", "chassis", "engine", "shell"];

$armor_indexed = array();
$chassis_indexed = array();
$engine_indexed = array();
$shell_indexed = array();

foreach ( $indexes as $index )
{
	foreach ( ${$index . "_list"} as $object )
	{
		${$index . "_indexed"}[$object->getId()] = $object;
	}
}
?>
