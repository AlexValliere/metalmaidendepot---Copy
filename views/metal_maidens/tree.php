<h1 class="page-header"><?php echo $view_tank->getTank(); ?> <small><?php echo $view_tank->getName(); ?></small></h1>
<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">See profile</button></a>

<?php
if ($view_tank->getLive2d() == "1" && !empty($view_tank->getLive2d_name()))
{
	?>
	<a href="<?php echo link_to_route("metal_maiden_live2d") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">See Live2D</button></a>
	<?php
}
?>

<div class="row">
	<?php
	if ($view_tank != NULL)
	{
		echo $view_tank->getTank() . "'s tree :<br />";	
		$view_tank_tree->printTree();
	}
	?>
</div>