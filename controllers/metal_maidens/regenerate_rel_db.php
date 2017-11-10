<?php
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST' && $_POST["regenerate"] == "true")
{
	$dbhandler->query("DROP TABLE IF EXISTS `metal_maidens_rel`;
	CREATE TABLE IF NOT EXISTS `metal_maidens_rel` (
		`from_id` int(11) NOT NULL,
		`to_id` int(11) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

	$metalMaidensManager = new MetalMaidensManager($dbhandler);
	$tank_list = $metalMaidensManager->get_all();

	foreach($tank_list as $tank)
	{
		$requirements = ["method_1", "method_2", "method_3", "develop", "research"];

		foreach ($requirements as $requirement)
		{
/*			echo "Current tank : " . $tank->getName() . "<br />";
			echo var_dump($tank->getRequirements($requirement));*/
			$requirement_tmp = $tank->getRequirements($requirement);

			if (!empty($requirement_tmp))
			{
				for ($i = 1; $i <= 3; $i++)
				{
					$tank_id = $tank->getRequirements($requirement)["tank_" . $i];

					if ($tank_id != NULL)
					{
						$tank_required = $metalMaidensManager->get($tank_id);
						$metalMaidensManager->add_downward_relations($tank, $tank_required);
					}
				}
			}
		}
	}
}
?>