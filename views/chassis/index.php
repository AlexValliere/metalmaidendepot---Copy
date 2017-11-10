<a href="<?php echo link_to_route("new_chassis"); ?>">
	<button>Add a new chassis</button>
</a>

<br />

<?php
foreach ($pw_chassis_description as $property => $description)
{
	echo '<img src="' . CHASSIS_DIR . 'properties/' . $property . '.png" alt="' . ucfirst($property) . '\'s icon" style="max-height: 28px;" title="' . ucfirst($property) . '" /> ';
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
	<th class="dark">Armor</th>
	<th class="dark">Detection</th>
	<th class="dark">Durability</th>
	<th class="dark">Evasion</th>
	<th class="dark">Firepower</th>
	<th class="dark">Penetration</th>
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
if ($chassis_array != NULL && is_array($chassis_array))
{
	$i = 0;
	foreach ($chassis_array as $chassis)
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
	<th class="dark">Armor</th>
	<th class="dark">Detection</th>
	<th class="dark">Durability</th>
	<th class="dark">Evasion</th>
	<th class="dark">Firepower</th>
	<th class="dark">Penetration</th>
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
	<td><?php echo $chassis->getId(); ?></td>
	<?php
	echo '<td><img src="'.CHASSIS_DIR.'tech_'.$chassis->getTier().'/'.$chassis->getName().'.png" alt="'.$chassis->getName().' icon" style="max-height: 35px;"></td>';
	?>
	<td><?php echo $chassis->getName(); ?></td>
	<td><?php echo $chassis->getTier(); ?></td>
	<td><?php echo $chassis->getLevel(); ?></td>
	<td><?php echo $chassis->getArmor(); ?></td>
	<td><?php echo $chassis->getDetection(); ?></td>
	<td><?php echo $chassis->getDurability(); ?></td>
	<td><?php echo $chassis->getEvasion(); ?></td>
	<td><?php echo $chassis->getFirepower(); ?></td>
	<td><?php echo $chassis->getPenetration(); ?></td>
	<td><?php echo $chassis->getStealth(); ?></td>
	<td><?php echo $chassis->getTargeting(); ?></td>
	<td>
		<?php
		foreach (array_keys($pw_chassis_description) as $property_value)
		{
			if ($chassis->{"get".ucfirst($property_value)}())
				echo '<img src="' . CHASSIS_DIR . 'properties/' . $property_value . '.png" alt="' . ucfirst($property_value) . '\'s icon" style="max-height: 28px;" title="' . strip_tags($pw_chassis_description[$property_value]) . '" /> ';
		}
		?>
	</td>
	<td><?php echo $chassis->getUpdated_on(); ?></td>
	<?php
	if (isset($current_user) && $current_user != NULL && ($current_user->has_roles("contributors")))
	{
		?>
	<td>
		<a href="<?php echo link_to_route("edit_chassis") . "&amp;chassis_id=" . $chassis->getId(); ?>">
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