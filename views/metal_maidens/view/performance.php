<div class="row">
	<div class="col-lg-12">
		<h4 class="page-header">Terrain performance based on chassis and engine bonus</h4>

		<div class="alert alert-warning" role="alert">
			<p>Warning : This is only an approximation and a work-in-progress.<br />Some metal maidens may have more than one type of engine/chassis and therefore can not accumulate all the bonuses from theirs engines/chassis at the same time.<br />You will also have to take into account the range of the shells available.</p>
		</div>

		<?php
		$tank_chassis_bonus = [];
		$tank_engine_bonus = [];
		$missing_counters = [];

		foreach ($view_tank->getChassis_bonus() as $chassis_bonus => $available)
		{
			if ($available)
			{
				$tank_chassis_bonus[] = $chassis_bonus;
			}
		}

		// echo var_dump($tank_chassis_bonus);

		foreach ($view_tank->getEngine_bonus() as $engine_bonus => $available)
		{
			if ($available)
			{
				$tank_engine_bonus[] = $engine_bonus;
			}
		}

		// echo var_dump($tank_engine_bonus);

		foreach ($pw_terrains as $terrain => $effects)
		{
			// echo ucfirst($terrain) . ' : ';
			// echo implode($effects, " - ");

			$terrain_counters = [];
			foreach ($effects as $effect)
				$terrain_counters[] = $pw_terrains_counter[$effect];

			$terrain_counter_size = count($terrain_counters);
			$tank_counter_effectiveness = 0;

			// echo var_dump($terrain_counters);

			foreach ($terrain_counters as $terrain_counter)
			{
				if (in_array($terrain_counter, $tank_chassis_bonus) || in_array($terrain_counter, $tank_engine_bonus))
				{
					++$tank_counter_effectiveness;
				}
			}

			$tank_performance = $tank_counter_effectiveness / $terrain_counter_size * 100;
			$tank_performance = round($tank_performance, 0);
			
			// echo $tank_performance . " %";
			// echo "<br />";

			// echo " : " . implode($terrain_counter, " - ") . "<br />";

			?>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
				<div class="table-responsive">
					<table class="table table-bordered attribute performance">
						<tr>
							<td>
								<?php
								if ($tank_performance == 0)			echo '<span style="color: red;">';
								else if ($tank_performance < 34)	echo '<span style="color: orangered;">';
								else if ($tank_performance < 51)	echo '<span style="color: orange;">';
								else if ($tank_performance < 51)	echo '<span style="color: yellow;">';
								else if ($tank_performance < 99)	echo '<span style="color: yellow;">';
								else								echo '<span style="color: yellowgreen;">';
								
								echo $tank_performance . "%</span>";
								?>
							</td>
							<td colspan="2">
								<?php
								echo ucfirst($terrain) . "<br />";

								echo "<small>Adequate equipment : " . $tank_counter_effectiveness . " out of " . count($terrain_counters) . "</small><br />";

								if ($tank_performance < 100)
								{
									echo "<small>Missing : ";
									foreach ($terrain_counters as $terrain_counter)
									{
										if (!(in_array($terrain_counter, $tank_chassis_bonus) || in_array($terrain_counter, $tank_engine_bonus)))
										{
											$missing_counters[] = $terrain_counter;
											echo " " . $terrain_counter;
										}
									}
									echo "</small>";

									$missing_counters = array_unique($missing_counters);
								}
								?>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<?php
		}
		?>
	</div>

	<?php
	if (!empty($missing_counters))
	{
		?>
		<div class="col-lg-12">
			<h5 class="page-header">Effects of missing equipment :</h5>
			<?php
			foreach ($missing_counters as $missing_counter)
			{
				if (array_key_exists($missing_counter, $pw_chassis_description))
					echo $pw_chassis_description[$missing_counter];
				if (array_key_exists($missing_counter, $pw_engine_description))
					echo $pw_engine_description[$missing_counter];
				echo "<br />";
			}
			?>
		</div>
		<?php
	}
	?>
</div>