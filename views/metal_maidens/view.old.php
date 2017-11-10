<section class="view_tank">
	<?php
	if (isset($view_tank))
	{
		?>
		<h1 class="page-header"><?php echo $view_tank->getTank(); ?> <small><?php echo $view_tank->getName(); ?></small></h1>

		<p class="timestamps">
			Created on : <?php echo $view_tank->getCreated_on(); ?>
			<br />
			Last updated : <?php echo $view_tank->getUpdated_on(); ?>
			<br />
			Profile updated to game version : <span class="profile_version" style="background-color: <?php echo to_color($view_tank->getProfile_game_version()); ?>; border-color: <?php echo to_color($view_tank->getProfile_game_version()); ?>;"><?php echo $view_tank->getProfile_game_version(); ?></span>
		</p>

		<a href="<?php echo link_to_route("metal_maiden_tree") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">See R&amp;D tree</button></a>

		<?php
		if ($view_tank->getLive2d() == "1" && !empty($view_tank->getLive2d_name()))
		{
			?>
			<a href="<?php echo link_to_route("metal_maiden_live2d") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">See Live2D</button></a>
			<?php
		}
		?>

		<?php
		if (current_user_has_roles("contributors"))
		{
			?>
		<a href="<?php echo link_to_route("edit_metal_maiden") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">Edit this page</button></a>
		<a href="<?php echo link_to_route("edit_metal_maiden_armors") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">Edit armors</button></a>
		<a href="<?php echo link_to_route("edit_metal_maiden_chassis") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">Edit chassis</button></a>
		<a href="<?php echo link_to_route("edit_metal_maiden_engines") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">Edit engines</button></a>
		<a href="<?php echo link_to_route("edit_metal_maiden_shells") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">Edit shells</button></a>
		<a href="<?php echo link_to_route("edit_metal_maiden_requirements") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">Edit requirements</button></a>
			<?php
		}
		?>
		<?php include("view/export_to_wiki.php"); ?>

		<?php
		if ( $view_tank->getHidden() )
		{
			?>
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<div class="alert alert-danger" role="alert">
						<p>Warning : This tank is hidden, it means it is not available on the global server and may never become available. Moreover, its characteristics are subject to change.</p>
					</div>
				</div>
			</div>
			<?php
		}
		?>

		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="row">
					<?php include("view/profile.php"); ?>
					<?php include("view/lifestyle.php"); ?>
					<?php include("view/research.php"); ?>
				</div>
				<br />
				<div class="row equipment">
					<?php include("view/equipment.php"); ?>
					<br />
					<?php include("view/attributes.php"); ?>
				</div>
				<br />
				<?php include("view/performance.php"); ?>
				<br />
				<?php include("view/requirements.php"); ?>
				<br />
				<?php include("view/engines.php"); ?>
				<br />
				<?php include("view/chassis.php"); ?>
				<br />
				<?php include("view/armors.php"); ?>
				<br />
				<?php include("view/shells.php"); ?>
				<br />
				<?php include("view/quotes.php"); ?>
			</div>		
			<?php include("view/illustration.php"); ?>
		</div>
		<?php
	}
	?>
</section>