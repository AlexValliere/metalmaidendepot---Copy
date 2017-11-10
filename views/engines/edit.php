<h2 class="page-header">Edit an engine</h2>

<form class="form-horizontal" action="<?php echo link_to_route("edit_engine") . "&amp;engine_id=" . $engine->getId(); ?>" method="post" enctype="multipart/form-data">
	<?php
	include_once("forms/form.php");
	?>

	<input type="hidden" name="edit_engine" value="<?php echo $engine->getId(); ?>" />

	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<button type="submit" class="btn btn-primary">Update the engine</button>
		</div>
	</div>
</form>