<?php
$shell_categories = ["all" => "All"] + $pw_ammo;
$sortableValues = ["id", "name", "tier", "firepower", "penetration", "targeting", "evasion", "stealth"];

if (isset($_GET['category']) && array_key_exists(strtolower($_GET['category']), $shell_categories))	{ $view_category = strtolower($_GET['category']); }
else																								{ $view_category = 'ap'; }
if (isset($_GET['sort']) && in_array(strtolower($_GET['sort']), $sortableValues))							{ $sort = strtolower($_GET['sort']); }
else																										{ $sort = NULL; }
if (isset($_GET['order']) && (strtolower($_GET['order']) == "asc" || strtolower($_GET['order']) == "desc"))	{ $order = strtolower($_GET['order']); }
else																										{ $order= NULL; }

$shellsManager = new ShellsManager( $dbhandler );
if ($view_category != "all")
	$shells = $shellsManager->get_by_category($view_category);
else
	$shells = $shellsManager->get_all();
$shell_modifiers = $shellsManager->get_all_shell_modifiers();
$shell_properties = $shellsManager->get_all_shell_properties();

if (isset($sort) && isset($order))
{
	usort($shells, 'cmp_shell_' . $sort . '_' . $order);
}

$shell_properties_ids = [];
foreach ($shells as $shell) {	$shell_properties_ids = array_merge($shell->getShell_properties_ids(), $shell_properties_ids); }
$shell_properties_ids = array_unique($shell_properties_ids);

$shell_modifiers_ids = [];
foreach ($shells as $shell) {	$shell_modifiers_ids = array_merge($shell->getShell_modifiers_ids(), $shell_modifiers_ids); }
$shell_modifiers_ids = array_unique($shell_modifiers_ids);
?>