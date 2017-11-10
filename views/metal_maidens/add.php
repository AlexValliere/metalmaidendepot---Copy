<section class="edit_metal_maiden">
<?php
if ($method != 'POST')
{
	?>
	<form class="form-horizontal" action="<?php echo link_to_route("create_metal_maiden"); ?>" method="post" enctype="multipart/form-data">
		<?php
		require_once("forms/profile.php");
		require_once("forms/statistics.php");
		require_once("forms/lifestyle.php");
		require_once("forms/equipment.php");
		require_once("forms/quote.php");
		?>
		
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<button type="submit" class="btn btn-primary">Create Metal Maiden</button>
			</div>
		</div>
	</form>
	<?php
}
else
{

}
?>
</section>