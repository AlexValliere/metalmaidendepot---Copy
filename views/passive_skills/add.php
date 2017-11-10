<h2 class="page-header">Create a new passive skill</h2>

<form class="form-horizontal" action="<?php echo link_to_route("new_passive_skill"); ?>" method="post" enctype="multipart/form-data">
	<?php
	include_once("forms/form.php");
	?>

	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<button type="submit" class="btn btn-primary">Create the new passive skill</button>
		</div>
	</div>
</form>