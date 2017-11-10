<?php
$metalMaidensManager = new MetalMaidensManager($dbhandler);
$armorsManager = new ArmorsManager($dbhandler);
$enginesManager = new EnginesManager($dbhandler);
$chassisManager = new ChassisManager($dbhandler);
$shellsManager = new ShellsManager($dbhandler);

$engines = $enginesManager->get_all();
$shell_modifiers = $shellsManager->get_all_shell_modifiers();
$shell_properties = $shellsManager->get_all_shell_properties();

if (isset($_GET['tank']))
{
	$view_tank = $metalMaidensManager->get_by_tank_slug($_GET['tank']);
	$view_tank_rd = $metalMaidensManager->get_upward_relations($view_tank);

	$armor_ids = $metalMaidensManager->get_attached_armors($view_tank);

	$engines_available = $view_tank->getEngines();
	$engines_override = [];

	if (!empty($view_tank->getEngine_ids()))
	{
		foreach ($engines as $engine)
		{
			if (in_array($engine->getId(), $view_tank->getEngine_ids()))
			{
				$engines_override[] = $engine;
			}
		}
	}

	$shell_ids = $metalMaidensManager->get_attached_shells($view_tank);
	$shells = [];

	foreach (array_keys($shell_ids) as $shell_id)
	{
		$shells[] = $shellsManager->get($shell_id);
	}

	$shell_properties_ids = [];
	foreach ($shells as $shell) {	$shell_properties_ids = array_merge($shell->getShell_properties_ids(), $shell_properties_ids); }
	$shell_properties_ids = array_unique($shell_properties_ids);

	$shell_modifiers_ids = [];
	foreach ($shells as $shell) {	$shell_modifiers_ids = array_merge($shell->getShell_modifiers_ids(), $shell_modifiers_ids); }
	$shell_modifiers_ids = array_unique($shell_modifiers_ids);
	?>
<script language="javascript">
	document.title = "<?php echo $view_tank->getTank(); ?>".concat(" - ").concat(document.title)
</script>
	<?php
}
?>
