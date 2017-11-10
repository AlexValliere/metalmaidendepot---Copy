<a href="<?php echo link_to_route("new_passive_skill"); ?>">
	<button>Add a new passive skill</button>
</a>

<br />

<table class="table table-hover table-condensed">
<tr>
	<th class="dark">ID</th>
	<th class="dark">Name</th>
	<th class="dark" style="width: 100px;">Icon</th>
	<th class="dark">Effect 1</th>
	<th class="dark">Effect 2</th>
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
if (isset($passive_skills) && is_array($passive_skills))
{
	$i = 0;
	foreach ($passive_skills as $passive_skill)
	{
		++$i;

		if ($i % 15 == 0)
		{
			?>
<tr>
	<th class="dark">ID</th>
	<th class="dark">Name</th>
	<th class="dark" style="width: 100px;">Icon</th>
	<th class="dark">Effect 1</th>
	<th class="dark">Effect 2</th>
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
	<td><?php echo $passive_skill->getId(); ?></td>
	<td><?php echo $passive_skill->getName(); ?></td>
	<?php
	echo '<td><img src=".png" alt="'.$passive_skill->getName().' icon" style="max-height: 35px;"></td>';
	?>
	<td></td>
	<td></td>
	<td></td>
</tr>
		<?php
	}
}
?>
</table>