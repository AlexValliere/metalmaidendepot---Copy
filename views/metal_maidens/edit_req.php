<section class="edit_metal_maiden">
<?php
if (isset($tank) && $method != 'POST')
{
	?>
	<form class="form-horizontal" action="<?php echo link_to_route("edit_metal_maiden_requirements"); ?>" method="post" enctype="multipart/form-data">
		<?php
		require_once("forms/req_forge.php");
		require_once("forms/req_naval_port.php");
		require_once("forms/req_refactor.php");
		require_once("forms/req_drop.php");
		require_once("forms/req_other.php");
		?>
		<input type="hidden" name="edit_tank" value="<?php echo $tank->getTank_slug(); ?>" />
		
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<button type="submit" class="btn btn-primary">Update Metal Maiden requirements</button>
			</div>
		</div>
	</form>
	<?php
}
?>
</section>