<h2 class="page-header">Edit a chassis</h2>

<form class="form-horizontal" action="<?php echo link_to_route("edit_chassis") . "&amp;chassis_id=" . $chassis->getId(); ?>" method="post" enctype="multipart/form-data">
	<?php
	include_once("forms/form.php");
	?>

	<input type="hidden" name="edit_chassis" value="<?php echo $chassis->getId(); ?>" />

	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<button type="submit" class="btn btn-primary">Update the chassis</button>
		</div>
	</div>
</form>