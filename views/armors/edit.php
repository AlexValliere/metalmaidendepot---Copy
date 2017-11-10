<h2 class="page-header">Edit an armor</h2>

<form class="form-horizontal" action="<?php echo link_to_route("edit_armor") . "&amp;armor_id=" . $armor->getId(); ?>" method="post" enctype="multipart/form-data">
	<?php
	include_once("forms/form.php");
	?>

	<input type="hidden" name="edit_armor" value="<?php echo $armor->getId(); ?>" />

	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<button type="submit" class="btn btn-primary">Update the armor</button>
		</div>
	</div>
</form>