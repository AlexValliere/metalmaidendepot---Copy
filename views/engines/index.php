<a href="<?php echo link_to_route("new_engine"); ?>">
	<button>Add a new engine</button>
</a>

<br />

<?php
foreach ($pw_engine_description as $property => $description)
{
	echo '<img src="' . ENGINES_DIR . 'properties/' . $property . '.png" alt="' . ucfirst($property) . '\'s icon" style="max-height: 28px;" title="' . ucfirst($property) . '" /> ';
	echo $description . "<br />";
}
?>

<br />

<table class="table table-hover table-condensed">
<tr>
	<th class="dark">ID</th>
	<th class="dark" style="width: 100px;">Icon</th>
	<th class="dark">Name</th>
	<th class="dark">Tier</th>
	<th class="dark">Level</th>
	<th class="dark">Detection</th>
	<th class="dark">Durability</th>
	<th class="dark">Evasion</th>
	<th class="dark">Stealth</th>
	<th class="dark">Targeting</th>
	<th class="dark">Properties</th>
	<th class="dark">Last updated</th>
	<?php
	if (isset($current_user) && $current_user != NULL && ($current_user->has_roles("contributors")))
	{
		?>
	<th class="dark">Actions</th>
		<?php
	}
	?>
</tr>
<?php
if ($engines != NULL && is_array($engines))
{
	$i = 0;
	foreach ($engines as $engine)
	{
		++$i;

		if ($i % 15 == 0)
		{
			?>
<tr>
	<th class="dark">ID</th>
	<th class="dark" style="width: 100px;">Icon</th>
	<th class="dark">Name</th>
	<th class="dark">Tier</th>
	<th class="dark">Level</th>
	<th class="dark">Detection</th>
	<th class="dark">Durability</th>
	<th class="dark">Evasion</th>
	<th class="dark">Stealth</th>
	<th class="dark">Targeting</th>
	<th class="dark">Properties</th>
	<th class="dark">Last updated</th>
	<?php
	if (isset($current_user) && $current_user != NULL && ($current_user->has_roles("contributors")))
	{
		?>
	<th class="dark">Actions</th>
		<?php
	}
	?>
</tr>
			<?php
		}
		?>
<tr>
	<td><?php echo $engine->getId(); ?></td>
	<?php
	echo '<td><img src="'.strtolower(ENGINES_DIR).'/tech_'.$engine->getTier().'/'.$engine->getName().'.png" alt="'.$engine->getName().' icon" style="max-height: 35px;"></td>';
	?>
	<td><?php echo $engine->getName(); ?></td>
	<td><?php echo $engine->getTier(); ?></td>
	<td><?php echo $engine->getLevel(); ?></td>
	<td><?php echo $engine->getDetection(); ?></td>
	<td><?php echo $engine->getDurability(); ?></td>
	<td><?php echo $engine->getEvasion(); ?></td>
	<td><?php echo $engine->getStealth(); ?></td>
	<td><?php echo $engine->getTargeting(); ?></td>
	<td>
		<?php
		foreach (array_keys($pw_engine_description) as $property_value)
		{
			if ($engine->{"get".ucfirst($property_value)}())
				echo '<img src="' . ENGINES_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . ucfirst($property_value) . '" /> ';
		}
		?>
	</td>
	<td><?php echo $engine->getUpdated_on(); ?></td>
	<?php
	if (isset($current_user) && $current_user != NULL && ($current_user->has_roles("contributors")))
	{
		?>
	<td>
		<a href="<?php echo link_to_route("edit_engine") . "&amp;engine_id=" . $engine->getId(); ?>">
			<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
		</a>
		<!--<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>-->
	</td>
		<?php
	}
	?>
</tr>
		<?php
	}
}
?>
</table>