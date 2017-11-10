<section class="advanced_search">
	<form class="form-horizontal" action="<?php echo link_to_route("advanced_search"); ?>" method="get" enctype="multipart/form-data">
		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Category :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					foreach ($pw_tank_categories as $tank_category_acronym => $tank_category_name)
					{
						?>
						<div class="filter_icon">
							<img
								src="<?php echo TANK_CATEGORIES_DIR . $tank_category_acronym; ?>.png"
								alt="<?php echo ucfirst($tank_category_name); ?> icon"
								class="filter_icon_category"
							/>
							<br />
							<?php echo summary(ucfirst($tank_category_name), 18); ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<br />

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Origin :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					foreach ($pw_nations as $nation)
					{
						?>
						<div class="filter_icon">
							<img
								src="<?php echo NATIONAL_FLAGS_DIR . $nation; ?>.png"
								alt="<?php echo ucfirst($nation); ?> icon"
								class="filter_icon_category"
							/>
							<br />
							<?php echo summary(ucfirst($nation), 18); ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<br />

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Shell :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					foreach ($pw_ammo as $ammo_acronym => $ammo_name)
					{
						?>
						<div class="filter_icon">
							<img
								src="<?php echo SHELLS_DIR . strtolower($ammo_acronym) . '/' . $ammo_name.'_icon.png'; ?>"
								alt="<?php echo ucfirst($ammo_name); ?> icon"
								class="filter_icon_category"
							/>
							<br />
							<?php echo summary(ucfirst($ammo_name), 18); ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<br />

		<div class="row" class="filters">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				Talent :<br />
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					<?php
					foreach ($pw_talents as $talent)
					{
						?>
						<div class="filter_icon">
							<img
								src="<?php echo LIFESTYLE_SKILLS . strtolower($talent) .'.png'; ?>"
								alt="<?php echo ucfirst($talent); ?> icon"
								class="filter_icon_category"
							/>
							<br />
							<?php echo summary(ucfirst($talent), 18); ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<br /><br />

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				<button type="submit" class="btn btn-primary">Search</button>
			</div>
		</div>
	</form>
</section>