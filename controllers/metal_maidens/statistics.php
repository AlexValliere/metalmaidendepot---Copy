<?php
if (isset($_GET['category']) && array_key_exists(strtolower($_GET['category']), $pw_tank_categories))	{ $view_category = strtolower($_GET['category']); }
else																									{ $view_category = 'atg'; }

$metalMaidensManager = new MetalMaidensManager($dbhandler);
$tank_list = $metalMaidensManager->get_category( $view_category );

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

$tank_list_size = count($tank_list);

$min_stats = array(
	"firepower" => "0",
	"penetration" => "0",
	"durability" => "0",
	"armor" => "0",
	"targeting" => "0",
	"evasion" => "0",
	"stealth" => "0",
	"detection" => "0"
);

$max_stats = $min_stats;
$median_stats = $min_stats;
$average_stats = $min_stats;

// Iterate over all tanks to get mix and max attributes values
foreach ($tank_list as $tank)
{
	foreach ($pw_tank_attributes as $attribute)
	{
		if ($min_stats[$attribute] == 0 || $tank->getAttribute($attribute) < $min_stats[$attribute])
			$min_stats[$attribute] = $tank->getAttribute($attribute);
		if ($max_stats[$attribute] == 0 || $tank->getAttribute($attribute) > $max_stats[$attribute])
			$max_stats[$attribute] = $tank->getAttribute($attribute);
		$average_stats[$attribute] += $tank->getAttribute($attribute);
	}
}

// Get average and median values for each attributes
foreach ($pw_tank_attributes as $attribute)
{
	$average_stats[$attribute] /= $tank_list_size;
	$tank_list_sorted_by[$attribute] = $tank_list;

	if (($view_category == "ht") && $attribute == "stealth")
		usort($tank_list_sorted_by[$attribute], 'cmp_' . $attribute . '_asc');
	else
		usort($tank_list_sorted_by[$attribute], 'cmp_' . $attribute . '_desc');

	$median_stats[$attribute] = $tank_list_sorted_by[$attribute][intval($tank_list_size / 2)]->getAttribute($attribute);
}
?>