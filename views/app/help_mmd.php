<section>
	<h3 class="page-header">Help Metal Maiden Depot (MMD) to complete its database</h3>

	<p>All Metal Maiden Depot data are extracted manually by hand directly in-game and today, MMD need your help to complete its database. If you want to contribute to MMD database, you can help me by sending screenshots of missing or invalid data to me on reddit (username AlexDeLaValliere), or on the #wiki channel on the Panzer Waltz discord server, or by sending an email to alex@metalmaidendepot.ovh</p>

	<br />

	<h3 class="page-header">Missing shells data for gold Metal Maidens</h3>
	<?php
	$missing_shells = FALSE;

	foreach ($gold_metal_maidens_array as $metal_maiden_element)
	{
		if ( empty($metal_maiden_element->getShell_ids()) )
		{
			if ( !$missing_shells )
			{
				?>
	<p>I'm looking for screenshots of every shells available (tier 1 to tier 3) for all the missing metal maidens below :</p>
	<strong style="color: orangered;">Missing tank below :</strong>
	<ul>
				<?php
			}
			?>
			<li>
				<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $metal_maiden_element->getTank_slug(); ?>">
					<img
						src="<?php echo TANKS_DIR . "portrait/" . $metal_maiden_element->getImagename(); ?>.png"
						alt="<?php echo $metal_maiden_element->getTank(); ?> portrait"
						style="max-height: 50px;"
					/>
					<?php
					if ( $metal_maiden_element->getHidden() )
					{
						echo '<span style="color: #c71585;">[ Hidden ]</span> ';
					}
					?>
					<?php echo $metal_maiden_element->getTank(); ?>
				</a>
			</li>
			<?php
			$missing_shells = TRUE;
		}
	}
	?>
	<?php
	if ( $missing_shells )
	{
		?>
	</ul>
	<p>Example of screenshots I'm looking for with Covenanter Cruiser Tank :</p>
	<ul>
		<li><a href="<?php echo ASSETS_DIR . 'images/uploads/shells_screenshot_example_part01.jpg'; ?>">Screenshot of Covenanter Cruiser Tank shells part 01</a></li>
		<li><a href="<?php echo ASSETS_DIR . 'images/uploads/shells_screenshot_example_part02.jpg'; ?>">Screenshot of Covenanter Cruiser Tank shells part 02</a></li>
		<li><a href="<?php echo ASSETS_DIR . 'images/uploads/shells_screenshot_example_part03.jpg'; ?>">Screenshot of Covenanter Cruiser Tank shells part 03</a></li>
	</ul>
	<strong>Sometime an other stat than the range is shown, you can display the range by changing the filter property. If the range is missing from the screenshot you take, don't forget to add a little note with the range of the shell.</strong>
		<?php
	}
	else
	{
		echo '<p style="color: yellowgreen;">Thanks to the help of the community, all the gold metal maidens have theirs shells referenced, congratulations !</p>';
	}
	?>

	<br />
	<br />

	<h3 class="page-header">Missing armors data for gold Metal Maidens</h3>
	<?php
	$missing_armors = FALSE;

	foreach ($gold_metal_maidens_array as $metal_maiden_element)
	{
		if ( empty($metal_maiden_element->getArmor_ids()) )
		{
			if ( !$missing_armors )
			{
				?>
	<p>I'm looking for screenshots of every armors available (tier 1 to tier 3) for all the missing metal maidens below :</p>
	<strong style="color: orangered;">Missing tank below :</strong>
	<ul>
				<?php
			}
			?>
				<li>
					<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $metal_maiden_element->getTank_slug(); ?>">
						<img
							src="<?php echo TANKS_DIR . "portrait/" . $metal_maiden_element->getImagename(); ?>.png"
							alt="<?php echo $metal_maiden_element->getTank(); ?> portrait"
							style="max-height: 50px;"
						/>
						<?php
						if ( $metal_maiden_element->getHidden() )
						{
							echo '<span style="color: #c71585;">[ Hidden ]</span> ';
						}
						?>
						<?php echo $metal_maiden_element->getTank(); ?>
					</a>
				</li>
			<?php
			$missing_armors = TRUE;
		}
	}
	?>
	<?php
	if ( $missing_armors )
	{
		echo '</ul>';
	}
	else
	{
		echo '<p style="color: yellowgreen;">Thanks to the help of the community, all the gold metal maidens have theirs armors referenced, congratulations !</p>';
	}
	?>

	<br />
	<br />

	<h3 class="page-header">Missing chassis data for gold Metal Maidens</h3>
	<?php
	$missing_chassis = FALSE;

	foreach ($gold_metal_maidens_array as $metal_maiden_element)
	{
		if ( empty($metal_maiden_element->getChassis_ids()) )
		{
			if ( !$missing_chassis )
			{
				?>
	<p>I'm looking for screenshots of every chassis available (tier 1 to tier 3) for all the missing metal maidens below :</p>
	<strong style="color: orangered;">Missing tank below :</strong>
	<ul>
				<?php
			}
			?>
			<li>
				<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $metal_maiden_element->getTank_slug(); ?>">
					<img
						src="<?php echo TANKS_DIR . "portrait/" . $metal_maiden_element->getImagename(); ?>.png"
						alt="<?php echo $metal_maiden_element->getTank(); ?> portrait"
						style="max-height: 50px;"
					/>
					<?php
					if ( $metal_maiden_element->getHidden() )
					{
						echo '<span style="color: #c71585;">[ Hidden ]</span> ';
					}
					?>
					<?php echo $metal_maiden_element->getTank(); ?>
				</a>
			</li>
			<?php
			$missing_chassis = TRUE;
		}
	}
	?>
	<?php
	if ( $missing_armors )
	{
		echo "</ul>";
	}
	else
	{
		echo '<p style="color: yellowgreen;">Thanks to the help of the community, all the gold metal maidens have theirs armors referenced, congratulations !</p>';
	}
	?>

	<br />
	<br />

	<h3 class="page-header">Missing shells data for 3 stars purple and blue Metal Maidens</h3>
	<p>I'm looking for screenshots of every shells available (tier 1 to tier 3) <strong style="color: orangered;">for all excepted the following metal maidens :</strong></p>
	<div class="alert alert-danger" role="alert">Warning : Below is a list of already referenced data for metal maidens instead of a list of missing data (as the list would be a bit too big)</div>
	<ul>
		<li>38(t) Light Tank</li>
		<li>Alecto Mk-II</li>
		<li>ASU-57 Airborne Tank Destroyer</li>
		<li>AT2 Anti-tank SPG</li>
		<li>Bison SPG</li>
		<li>BTR-40</li>
		<li>BTR-50</li>
		<li>Churchill Mk-III</li>
		<li>Churchill Mk-IV</li>
		<li>Cromwell Mk-III</li>
		<li>Cromwell Mk-IV</li>
		<li>Crusader Mk-I</li>
		<li>Crusader Mk-II</li>
		<li>Ferdinand Prototype</li>
		<li>Grille H</li>
		<li>Grille M</li>
		<li>Hummel SPG</li>
		<li>Jagdpanzer IV Prototype</li>
		<li>M3 Scout Car</li>
		<li>M5 Stuart</li>
		<li>M10 Wolverine</li>
		<li>M18 Hellcat</li>
		<li>M6A1 Heavy Tank</li>
		<li>M7B1 Priest</li>
		<li>M40 SPG</li>
		<li>M41 Bulldog</li>
		<li>Marder II</li>
		<li>Marder II (Type 132)</li>
		<li>Matilda</li>
		<li>Panther Ausf. A</li>
		<li>Panther Prototype</li>
		<li>Renault FT-17</li>
		<li>Sd.Kfz.251/9</li>
		<li>Sherman Mk-II</li>
		<li>Sherman Mk-IV</li>
		<li>sIG-33</li>
		<li>SU-76I</li>
		<li>T-26</li>
		<li>T-34/85</li>
		<li>T-40 Light Tank</li>
		<li>T34E1 Calliope</li>
		<li>Tetrarch Light Tank</li>
		<li>Tiger (Early Henschel)</li>
		<li>Tiger (Porsche)</li>
		<li>Tiger II (Porsche)</li>
	</ul>

	<h3 class="page-header">Missing armors data for 3 stars purple and blue Metal Maidens</h3>
	<p>I'm looking for screenshots of every armors available (tier 1 to tier 3) <strong style="color: orangered;">for all excepted the following metal maidens :</strong></p>
	<div class="alert alert-danger" role="alert">Warning : Below is a list of already referenced data for metal maidens instead of a list of missing data (as the list would be a bit too big)</div>
	<ul>
		<li>38(t) Light Tank</li>
		<li>Alecto Mk-II</li>
		<li>ASU-57 Airborne Tank Destroyer</li>
		<li>AT2 Anti-tank SPG</li>
		<li>Bison SPG</li>
		<li>BTR-40</li>
		<li>BTR-50</li>
		<li>Churchill Mk-IV</li>
		<li>Cromwell Mk-III</li>
		<li>Cromwell Mk-IV</li>
		<li>Crusader Mk-II</li>
		<li>Ferdinand Prototype</li>
		<li>Grille H</li>
		<li>Hummel SPG</li>
		<li>Jagdpanzer IV Prototype</li>
		<li>M3 Scout Car</li>
		<li>M5 Stuart</li>
		<li>M6A1 Heavy Tank</li>
		<li>M10 Wolverine</li>
		<li>M18 Hellcat</li>
		<li>M40 SPG</li>
		<li>M41 Bulldog</li>
		<li>Marder II</li>
		<li>Marder II (Type 132)</li>
		<li>Matilda</li>
		<li>Panther Ausf. A</li>
		<li>Panther Prototype</li>
		<li>Renault FT-17</li>
		<li>Sd.Kfz.251/9</li>
		<li>Sherman Mk-II</li>
		<li>SU-14 SPG</li>
		<li>T-26</li>
		<li>T-34/85</li>
		<li>T-40 Light Tank</li>
		<li>Tetrarch Light Tank</li>
		<li>Tiger (Early Henschel)</li>
		<li>Tiger (Porsche)</li>
		<li>Tiger II (Porsche)</li>
	</ul>

	<h3 class="page-header">Missing chassis data for 3 stars purple and blue Metal Maidens</h3>
	<p>I'm looking for screenshots of every chassis available (tier 1 to tier 3) <strong style="color: orangered;">for all excepted the following metal maidens :</strong></p>
	<div class="alert alert-danger" role="alert">Warning : Below is a list of already referenced data for metal maidens instead of a list of missing data (as the list would be a bit too big)</div>
	<ul>
		<li>38(t) Light Tank</li>
		<li>Alecto Mk-II</li>
		<li>ASU-57 Airborne Tank Destroyer</li>
		<li>AT2 Anti-tank SPG</li>
		<li>Bison SPG</li>
		<li>BTR-40</li>
		<li>BTR-50</li>
		<li>Churchill Mk-IV</li>
		<li>Cromwell Mk-III</li>
		<li>Cromwell Mk-IV</li>
		<li>Crusader Mk-II</li>
		<li>Ferdinand Prototype</li>
		<li>Grille H</li>
		<li>Hummel SPG</li>
		<li>Jagdpanzer IV Prototype</li>
		<li>M3 Scout Car</li>
		<li>M5 Stuart</li>
		<li>M6A1 Heavy Tank</li>
		<li>M10 Wolverine</li>
		<li>M18 Hellcat</li>
		<li>M40 SPG</li>
		<li>M41 Bulldog</li>
		<li>Marder II</li>
		<li>Marder II (Type 132)</li>
		<li>Matilda</li>
		<li>Panther Ausf. A</li>
		<li>Panther Prototype</li>
		<li>Renault FT-17</li>
		<li>Sd.Kfz.251/9</li>
		<li>Sherman Mk-II</li>
		<li>SU-14 SPG</li>
		<li>T-26</li>
		<li>T-34/85</li>
		<li>T-40 Light Tank</li>
		<li>Tetrarch Light Tank</li>
		<li>Tiger (Early Henschel)</li>
		<li>Tiger (Porsche)</li>
		<li>Tiger II (Porsche)</li>
	</ul>

	<!--<br />
	<br />

	<h3 class="page-header">Referenced data for non fated purple and blue Metal Maidens</h3>
	<ul>
		<li>SU-85</li>
	</ul>-->
</section>