<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<h3>Tanks with missing level on R&amp;D section</h3>
		<p>Count : <?php echo count($metal_maidens_missing_rd_level); ?></p>

		<?php
		foreach ($metal_maidens_missing_rd_level as $metal_maiden)
		{
			?>
		<table class="table table-bordered">
		<tr>
			<td colspan="2">
				<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $metal_maiden->getTank_slug(); ?>" class="<?php echo $metal_maiden->getRarity(); ?>_rarity_text">
					<?php echo $metal_maiden->getTank(); ?>
				</a>
			</td>
		</tr>
		<?php
		$methods;

		for($i = 1; $i <= 3; $i++)
		{
			$methods[$i] = $metal_maiden->getRequirements("method_" . $i);

			for ($j = 1; $j <= 3; $j++)
			{
				if ($methods[$i]["tank_" . $j] != NULL)
				{
					if ($methods[$i]["tank_level_" . $j] == 0)
					{
						?>
						<tr>
							<td class="col-lg-3"><?php echo "Method " . $i . " : "; ?></td>
							<td class="col-lg-9">
								<?php
								for ($k = 1; $k <= 3; $k++)
								{
									if ($methods[$i]["tank_" . $k] != NULL)
									{
										$tank_req = $metalMaidensManager->get($metal_maiden->getRequirements("method_" . $i)["tank_" . $k]);
										if ($methods[$i]["tank_level_" . $k] != 0)
										{
											echo "Level " . $methods[$i]["tank_level_" . $k] . " <a href='" . link_to_route("metal_maiden") . "&amp;tank=" . $tank_req->getTank_slug() . "' class='" . $tank_req->getRarity() . "_rarity_text'>" . $tank_req->getTank() . "</a> ";
										}
										else
										{
											echo "<span style='color: orangered';>Level ?&nbsp;&nbsp;</span> " . " <a href='" . link_to_route("metal_maiden") . "&amp;tank=" . $tank_req->getTank_slug() . "' class='" . $tank_req->getRarity() . "_rarity_text'>" . $tank_req->getTank() . "</a> ";
										}
										echo "<br />";
									}
								}
								?>
							</td>
						</tr>
						<?php
						break;
					}
				}
			}
		}
		?>
		</table>
		<?php
		}
		?>
	</div>
</div>