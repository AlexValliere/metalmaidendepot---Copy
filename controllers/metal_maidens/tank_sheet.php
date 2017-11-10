<?php
$sortableValues = array_merge(["tank", "rarity", "blueprint_rank", "category"], $pw_tank_attributes);

if (isset($_GET['sort']) && in_array(strtolower($_GET['sort']), $sortableValues))							{ $sort = strtolower($_GET['sort']); }
else																										{ $sort = NULL; }
if (isset($_GET['order']) && (strtolower($_GET['order']) == "asc" || strtolower($_GET['order']) == "desc"))	{ $order = strtolower($_GET['order']); }
else																										{ $order= NULL; }

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

if (isset($sort) && isset($order))
{
	usort($tank_list, 'cmp_' . $sort . '_' . $order);
}
?>
