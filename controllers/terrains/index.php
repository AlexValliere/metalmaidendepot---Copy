<?php
if (isset($_GET['terrain']))
{
	$view_terrain = strtolower(str_replace("_", " ", $_GET['terrain']));

	if (array_key_exists($view_terrain, $pw_terrains))
	{
		$view_terrain = array ( $view_terrain => $pw_terrains[$view_terrain] );
	}
	else
	{
		$view_terrain = array ( array_keys($pw_terrains)[0] => array_values($pw_terrains)[0] );
	}
}
else
{
	$view_terrain = array ( array_keys($pw_terrains)[0] => array_values($pw_terrains)[0] );
}

///////////////////////////////////////////////////////////////////////////////////////////////////

$metalMaidensManager = new MetalMaidensManager($dbhandler);
$tank_list = $metalMaidensManager->get_all();

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

// usort($tank_list, 'cmp_rarity_then_category_then_tank_desc');
usort($tank_list, 'cmp_category_then_rarity_then_tank_desc');

///////////////////////////////////////////////////////////////////////////////////////////////////

$terrain_name = array_keys($view_terrain)[0];
$terrain_effects = array_values($view_terrain)[0];
$terrain_counter_effects = [];

foreach ($terrain_effects as $terrain_effect)
{
	$terrain_counter_effects[] = $pw_terrains_counter[$terrain_effect];
}

$terrain_counter_effects_size = count($terrain_counter_effects);

?>