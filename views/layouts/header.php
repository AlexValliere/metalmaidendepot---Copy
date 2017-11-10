<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo link_to_route("home"); ?>"><?php echo PROJECT_NAME; ?></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo link_to_route("advanced_search"); ?>">Advanced search</a></li>
				<li><a href="<?php echo link_to_route("statistics"); ?>">Statistics</a></li>
				<li><a href="<?php echo link_to_route("sheets_index"); ?>">Sheets index</a></li>
				<!--<li><a href="<?php echo link_to_route("tank_sheet"); ?>">Tanks sheet</a></li>
				<li><a href="<?php echo link_to_route("armors"); ?>">Armors sheet</a></li>
				<li><a href="<?php echo link_to_route("chassis"); ?>">Chassis sheet</a></li>
				<li><a href="<?php echo link_to_route("engines"); ?>">Engines sheet</a></li>
				<li><a href="<?php echo link_to_route("shells"); ?>">Shells sheet</a></li>-->
				<li><a href="<?php echo link_to_route("terrains"); ?>">Terrains</a></li>
				<li><a href="<?php echo link_to_route("help_mmd"); ?>">Help MMD</a></li>
				<li><a href="<?php echo link_to_route("changelog"); ?>">Changelog</a></li>
				<li><a href="<?php echo link_to_route("plain_text_database"); ?>">Plain text database</a></li>
				<?php if (!isset($current_user) || $current_user == NULL) { ?>
					<!--<li><a href="<?php // echo link_to_route("login"); ?>">Sign in</a></li>-->
				<?php } else { ?>
					<?php if ($current_user->has_roles("contributors")) { ?>
						<li><a href="<?php echo link_to_route("create_metal_maiden"); ?>">Add new Metal Maiden</a></li>
					<?php } ?>
					<?php if ($current_user->has_roles("redditors")) { ?>
						<li><a href="<?php echo link_to_route("reddit_flairs"); ?>">Reddit flairs</a></li>
					<?php } ?>
					<?php if ($current_user->has_roles("admins")) { ?>
						<li><a href="<?php echo link_to_route("admin"); ?>">Admin</a></li>
					<?php } ?>
					<li><a href="<?php echo link_to_route("logout"); ?>">Logout</a></li>
				<?php } ?>
			</ul>
			<form class="navbar-form navbar-right" action="index.php" method="get">
				<input type="hidden" id="route" name="route" value="search" />
				<input type="text" class="form-control" placeholder="Search..." id="query" name="query" />
			</form>
		</div>
	</div>
</nav>