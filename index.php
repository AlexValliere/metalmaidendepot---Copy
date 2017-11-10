<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("ASSETS_DIR", 'assets/');
define("CONFIG_DIR", 'config/');
define("CONTROLLERS_DIR", 'controllers/');
define("HELPERS_DIR", 'helpers/');
define("MODELS_DIR", 'models/');
define("VIEWS_DIR", 'views/');

define("PROJECT_NAME", "Metal Maiden Depot");
define("VERBOSE", FALSE);

define("ARMORS_DIR", ASSETS_DIR . 'images/armors/');
define("CHASSIS_DIR", ASSETS_DIR . 'images/chassis/');
define("ENGINES_DIR", ASSETS_DIR . 'images/engines/');
define("LIFESTYLE_SKILLS", ASSETS_DIR . 'images/lifestyle_skills/');
define("NATIONAL_FLAGS_DIR", ASSETS_DIR . 'images/national_flags/');
define("PW_RESOURCES_DIR", ASSETS_DIR . 'images/pw_resources/');
define("SUPPLY_DIR", ASSETS_DIR . 'images/supply/');
define("SHELLS_DIR", ASSETS_DIR . 'images/shells/');
define("TANKS_DIR", ASSETS_DIR . 'images/tanks/');
define("TANK_ATTRIBUTES_DIR", TANKS_DIR . 'attributes/');
define("TANK_CATEGORIES_DIR", TANKS_DIR . 'categories/');
define("TANK_EQUIPMENTS_DIR", TANKS_DIR . 'equipments/');
define("TERRAINS_DIR", ASSETS_DIR . 'images/terrains/');

require_once(CONFIG_DIR	. 'classLoader.php');
require_once(CONFIG_DIR	. 'database.php');
require_once(CONFIG_DIR	. 'panzerwaltz_variables.php');
require_once(CONFIG_DIR	. 'roles.php');
require_once(CONFIG_DIR	. 'routes.php');
require_once(HELPERS_DIR . 'metal_maidens/cmp.php');
require_once(HELPERS_DIR . 'shells/cmp.php');
require_once(HELPERS_DIR . 'compare_objects.php');
require_once(HELPERS_DIR . 'users/current_user.php');
require_once(HELPERS_DIR . 'post_slug.php');
require_once(HELPERS_DIR . 'redirection.php');
require_once(HELPERS_DIR . 'remove_accents.php');
require_once(HELPERS_DIR . 'summary.php');
require_once(HELPERS_DIR . 'to_color.php');

try { $dbhandler = new PDOConfig(); $dbhandler->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); }
catch(PDOException $e) { die('Unable to open database connection'); }

$current_user = current_user();

$controller_name = get_controller_name(); // Get name of the current controller
$route = get_route(); // Get current route from URL
$routes = get_route_destination(); // Return all available routes when arg is NULL
$route_firewall = get_route_firewall( $route ); // Return privileges required for the route specified
$has_route_permission = ((!isset($route_firewall) || current_user_has_roles($route_firewall)) ? TRUE : FALSE); // Look if the current user has access to the requested route
$route_title = ""; // Add $route_title as a prexife to the page's title
if ($route != "home" && $route != "metal_maiden")
	$route_title = str_replace("_", " ", ucfirst($route));

if (isset($_GET['tank']))
{
	$metalMaidensManager = new MetalMaidensManager($dbhandler);
	$tank_parameter = $metalMaidensManager->get_by_tank_slug(htmlentities($_GET['tank']));
}

// Render route
require_once(VIEWS_DIR . 'layouts/layout_pre.php');

if (!array_key_exists($route, $routes))						include_once(VIEWS_DIR . 'errors/001.php'); // Route is not referenced
elseif (!is_file(CONTROLLERS_DIR . $routes[$route].'.php'))	include_once(VIEWS_DIR . 'errors/002.php'); // Route is referenced but missing
elseif(!$has_route_permission)								include_once(VIEWS_DIR . 'errors/003.php'); // Current user does not have the permission to view the route
else
{
	require_once(CONTROLLERS_DIR . get_route_destination($route) . '.php');

	if (is_file(VIEWS_DIR . get_route_destination($route) . '.php'))
		include(VIEWS_DIR . get_route_destination($route) . '.php');
}

require_once(VIEWS_DIR . 'layouts/layout_post.php');
?>