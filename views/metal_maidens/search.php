<?php
if ($results == NULL)
{
	?>
<div class="alert alert-danger" role="alert">
	<strong>Oh oh...</strong> We cannot find any results for your query '<?php echo htmlentities($_GET["query"]); ?>'.
	<br />
	<p>
		- You can type the beginning name of a tank. Example: "crom" to get all the tanks starting by "Crom" like the Cromwell serie.<br />
		- You can also search tanks by nations and categories. Example : "atg spg bavaria" to get all the tanks that belongs to the Bavaria nation and to the ATG and SPG categories.
	</p>
</div>
	<?php
}
else
{
	?>
<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<p>Search results : <span style="color: orangered"><?php echo count($results); ?></span> tanks found</p>
		<div class="row">
	<?php
	foreach ($results as $result)
	{
		?>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<table class="table table-responsive table-bordered">
				<tr>
					<td style="width: 80px">
						<a href="index.php?route=metal_maiden&amp;tank=<?php echo $result->getTank_slug(); ?>">
							<img
								src="<?php echo TANKS_DIR . "portrait/" . $result->getImagename(); ?>.png"
								alt="<?php echo $result->getTank(); ?> portrait"
								class="portrait <?php echo $result->getRarity(); ?>_border"
								style="height: 50px;"
							/>
						</a>
					</td>
					<td style="vertical-align: middle;">
						<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $result->getTank_slug(); ?>" class="<?php echo $result->getRarity(); ?>_rarity_text">
							<?php echo $result->getTank(); ?>
						</a>
					</td>
				</tr>
				</table>
			</div>
		<?php
	}
	?>
		</div>
	</div>
</div>
	<?php
}
?>