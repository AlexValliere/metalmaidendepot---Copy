<a href="<?php echo link_to_route("new_armor"); ?>">
	<button>Add a new armor</button>
</a>

<br />

<?php
foreach ($pw_armor_description as $property => $description)
{
	echo '<img src="' . ARMORS_DIR . 'properties/' . $property . '.png" alt="' . ucfirst($property) . '\'s icon" style="max-height: 28px;" title="' . ucfirst($property) . '" /> ';
	echo $description . "<br />";
}
?>

<br />

<table class="table table-hover table-condensed">
<tr>
	<th class="dark">ID</th>
	<th class="dark">Category</th>
	<th class="dark" style="width: 100px;">Icon</th>
	<th class="dark">Name</th>
	<th class="dark">Tier</th>
	<th class="dark">Level</th>
	<th class="dark">Armor</th>
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
if ($armors != NULL && is_array($armors))
{
	$i = 0;
	foreach ($armors as $armor)
	{
		++$i;

		if ($i % 15 == 0)
		{
			?>
<tr>
	<th class="dark">ID</th>
	<th class="dark">Category</th>
	<th class="dark" style="width: 100px;">Icon</th>
	<th class="dark">Name</th>
	<th class="dark">Tier</th>
	<th class="dark">Level</th>
	<th class="dark">Armor</th>
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
	<td><?php echo $armor->getId(); ?></td>
	<td><?php echo ucfirst($armor->getCategory()); ?></td>
	<?php
	echo '<td><img src="'.strtolower(ARMORS_DIR.$armor->getCategory()).'/tech_'.$armor->getTier().'/'.$armor->getName().'.png" alt="'.$armor->getName().' icon" style="max-height: 35px;"></td>';
	?>
	<td><?php echo $armor->getName(); ?></td>
	<td><?php echo $armor->getTier(); ?></td>
	<td><?php echo $armor->getLevel(); ?></td>
	<td><?php echo $armor->getArmor(); ?></td>
	<td><?php echo $armor->getDurability(); ?></td>
	<td><?php echo $armor->getEvasion(); ?></td>
	<td><?php echo $armor->getStealth(); ?></td>
	<td><?php echo $armor->getTargeting(); ?></td>
	<td>
		<?php
		$properties_array = ["cast", "composite", "hardened", "riveted", "spaced", "tempered", "wedge", "welded"];

		foreach ($properties_array as $property_value)
		{
			if ($armor->{"get".ucfirst($property_value)}())
				echo '<img src="' . ARMORS_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . ucfirst($property_value) . '" /> ';
		}
		?>
	</td>
	<td><?php echo $armor->getUpdated_on(); ?></td>
	<?php
	if (isset($current_user) && $current_user != NULL && ($current_user->has_roles("contributors")))
	{
		?>
	<td>
		<a href="<?php echo link_to_route("edit_armor") . "&amp;armor_id=" . $armor->getId(); ?>">
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