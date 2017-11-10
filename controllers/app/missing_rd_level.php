<?php
$metalMaidensManager = new MetalMaidensManager($dbhandler);
$metal_maidens_array = $metalMaidensManager->get_all();
$metal_maidens_missing_rd_level = [];

foreach ($metal_maidens_array as $metal_maiden)
{
	$methods;

	for ($i = 1; $i <= 3; $i++)
	{
		$methods[$i] = $metal_maiden->getRequirements("method_" . $i);
	}

	if ($methods[1] != NULL)
	{
		for ($i = 1; $i <= 3; $i++)
		{
			for ($j = 1; $j <= 3; $j++)
			{
				if ($methods[$i]["tank_" . $j] != NULL)
				{
					if ($methods[$i]["tank_level_" . $j] == 0)
					{
						$metal_maidens_missing_rd_level[] = $metal_maiden;
					}
				}
			}
		}
	}
}

$metal_maidens_missing_rd_level = array_unique($metal_maidens_missing_rd_level);
?>