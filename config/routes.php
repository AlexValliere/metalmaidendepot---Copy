<?php
require_once(HELPERS_DIR . 'post_slug.php');

// Retrieve the route from the URL
function get_route()
{
	$route = (!empty($_GET['route'])) ? htmlentities($_GET['route']) : 'home';

	return $route;
}

// Get the path associated to a route
function get_route_destination( $route = NULL )
{
	$routes = array(
		'armors'							=> 'armors/index',
		'edit_armor'						=> 'armors/edit',
		'new_armor'							=> 'armors/add',
		'admin'								=> 'app/admin',
		'changelog'							=> 'app/changelog',
		'help_mmd'							=> 'app/help_mmd',
		'missing_illustration'				=> 'app/missing_illustration',
		'missing_rd_level'					=> 'app/missing_rd_level',
		'plain_text_database'				=> 'app/plain_text_database',
		'policy'							=> 'app/policy',
		'sheets_index'						=> 'app/sheets_index',
		'reddit_flairs'						=> 'app/reddit_flairs',
		'chassis'							=> 'chassis/index',
		'edit_chassis'						=> 'chassis/edit',
		'new_chassis'						=> 'chassis/add',
		'engines'							=> 'engines/index',
		'edit_engine'						=> 'engines/edit',
		'new_engine'						=> 'engines/add',
		'create_metal_maiden'				=> 'metal_maidens/add',
		'edit_metal_maiden'					=> 'metal_maidens/edit',
		'edit_metal_maiden_requirements'	=> 'metal_maidens/edit_req',
		'edit_metal_maiden_armors'			=> 'metal_maidens/edit_armor',
		'edit_metal_maiden_chassis'			=> 'metal_maidens/edit_chassis',
		'edit_metal_maiden_engines'			=> 'metal_maidens/edit_engine',
		'edit_metal_maiden_shells'			=> 'metal_maidens/edit_shell',
		'home'								=> 'metal_maidens/index',
		'hidden_index'						=> 'metal_maidens/hidden_index',
		'metal_maiden_live2d'				=> 'metal_maidens/live2d',
		'regenerate_metal_maidens_rel_db'	=> 'metal_maidens/regenerate_rel_db',
		'advanced_search'					=> 'metal_maidens/advanced_search',
		'search'							=> 'metal_maidens/search',
		'statistics'						=> 'metal_maidens/statistics',
		'tank_sheet'						=> 'metal_maidens/tank_sheet',
		'metal_maiden'						=> 'metal_maidens/view',
		'metal_maiden_tree'					=> 'metal_maidens/tree',
		'passive_skills'					=> 'passive_skills/index',
		'edit_passive_skill'				=> 'passive_skills/edit',
		'new_passive_skill'					=> 'passive_skills/add',
		'view_passive_skill'				=> 'passive_skills/view',
		'shells'							=> 'shells/index',
		'edit_shell'						=> 'shells/edit',
		'terrains'							=> 'terrains/index',
		'edit_user'							=> 'users/edit',
		'login'								=> 'users/login',
		'logout'							=> 'users/logout',
		'register'							=> 'users/register',
		'users'								=> 'users/index'
	);

	if (isset($route) && !empty($route) && array_key_exists($route, $routes))
		return ($routes[$route]);

	return $routes;
}

// Get the required privileges to access a route
function get_route_firewall( $route = NULL )
{
	$routes_firewalls = array(
		'admin'								=> 'admins',
		'users'								=> 'admins',
		'edit_user'							=> 'admins',
		'regenerate_metal_maidens_rel_db'	=> 'admins',
		'edit_armor'						=> 'contributors',
		'new_armor'							=> 'contributors',
		'edit_engine'						=> 'contributors',
		'new_engine'						=> 'contributors',
		'edit_chassis'						=> 'contributors',
		'new_chassis'						=> 'contributors',
		'create_metal_maiden'				=> 'contributors',
		'edit_metal_maiden'					=> 'contributors',
		'edit_metal_maiden_requirements'	=> 'contributors',
		'edit_metal_maiden_armors'			=> 'contributors',
		'edit_metal_maiden_chassis'			=> 'contributors',
		'edit_metal_maiden_engines'			=> 'contributors',
		'edit_metal_maiden_shells'			=> 'contributors',
		'edit_shell'						=> 'contributors',
		'reddit_flairs'						=> 'redditors'
	);

	if (isset($route) && !empty($route))
	{
		if (array_key_exists($route, $routes_firewalls))
			return ($routes_firewalls[$route]);
		else
			return NULL;
	}

	return $routes_firewalls;
}

// Get the controller's name of the current route
function get_controller_name()
{
	$controller_name = NULL;
	$routes = get_route_destination();
	$route = get_route();

	if (isset($route) && !empty($route) && array_key_exists($route, $routes))
	{
		$pieces = explode('/', get_route_destination($route));

		if (is_dir('controller/' . $pieces[0]))
			$controller_name = $pieces[0];
	}

	return $controller_name;
}

// Get the CSS path to load based on current route
function get_route_css( $route = NULL )
{
	$css = NULL;
	$routes = get_route_destination();
	$route = get_route();

	if ($route == NULL)
		$route = get_controller_name();

	if (isset($route) && !empty($route) && array_key_exists($route, $routes))
	{
		$pieces = explode('/', get_route_destination($route));

		if (is_dir(VIEWS_DIR . $pieces[0]) && is_file(VIEWS_DIR . $pieces[0] . '/style.css'))
			$css = VIEWS_DIR . $pieces[0] . '/style.css';
	}

	return $css;
}

// Returns relative path to a route
function link_to_route( $route = NULL )
{
	$routes = get_route_destination();

	if ($route != NULL && array_key_exists($route, $routes))
	{
		return "index.php?route=" . $route;
	}
	return "#";
}
?>