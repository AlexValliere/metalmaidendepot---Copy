<?php
$metalMaidensManager = new MetalMaidensManager($dbhandler);
$armorsManager = new ArmorsManager($dbhandler);
$chassisManager = new ChassisManager($dbhandler);
$enginesManager = new EnginesManager($dbhandler);
$shellsManager = new ShellsManager($dbhandler);

$chassis_list = $chassisManager->get_all();
$engine_list = $enginesManager->get_all();
$tank_list = $metalMaidensManager->get_all();

foreach ( array_keys( $pw_ammo ) as $shell_category )
{
	$shell_list[$shell_category] = $shellsManager->get_by_category($shell_category);
	unset( $shell_list[$shell_category][0] );
	$shell_list[$shell_category] = array_values( $shell_list[$shell_category] );
}

foreach ( $pw_armor as $armor_category )
{
	$armor_list[$armor_category] = $armorsManager->get_by_category($armor_category);
}

if ( $tank_list )
{
	// Remove hidden metal maidens
	for ( $i = 0; $i < count( $tank_list ); $i++ )
	{
		if ( $tank_list[ $i ]->getHidden() == TRUE )
		{
			unset( $tank_list[ $i ] );
		}
	}

	// Normalize integer keys
	$tank_list = array_values( $tank_list );
}

$tank_list_json = json_encode($tank_list, JSON_PRETTY_PRINT);

$sortableValues = array_merge(["tank", "rarity", "blueprint_rank", "category"], $pw_tank_attributes);

// print_r($tank_list_json);
?>