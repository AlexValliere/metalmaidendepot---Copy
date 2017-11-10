<div class="col-lg-3">
	<p><strong>Lifestyle skills :</strong></p>
	<table class="table table-bordered table-width-auto">
	<tr>
		<th colspan="2">Skills</th>
		<th>Level</th>
	</tr>
	<?php
	for ($i = 1; $i <= 3; ++$i)
	{
		if (isset($view_tank->getLifestyle_skills()["skill_$i"]) && $view_tank->getLifestyle_skills()["skill_$i"] != "null")
		{
			?>
			<tr>
				<td class="icon">
					<img
						src="<?php echo LIFESTYLE_SKILLS . $view_tank->getLifestyle_skills()["skill_$i"]; ?>.png"
						alt="<?php echo $view_tank->getLifestyle_skills()["skill_$i"]; ?>'s icon"
						class="icon-size-1"
					/>
				</td>
				<td><?php echo ucfirst($view_tank->getLifestyle_skills()["skill_$i"]); ?></td>
				<td class="text-align-center"><?php echo $view_tank->getLifestyle_skills()["skill_".$i."_level"]; ?></td>
			</tr>
			<?php
		}
	}
	?>
	</table>
</div>