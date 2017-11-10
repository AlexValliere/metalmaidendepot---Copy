<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<div class="row" style="text-align: center;">
			<h4 class="page-header">Index of available sheets :</h4>
			<?php
			foreach ($sheets_index as $sheet_index)
			{
				?>
				<a href="<?php echo link_to_route(str_replace("tanks", "tank_sheet", $sheet_index)); ?>" style="color: #ffffff; text-decoration: none;">
					<div style="display: inline-block; border: 1px solid #ffffff; margin: 10px; padding: 20px;">
						<img
							src="<?php echo ASSETS_DIR . "images/resources/" . $sheet_index . "_index.png"; ?>"
							alt="<?php echo $sheet_index . " icon"; ?>"
							style="max-width: 150px;"
						/>
						<br />
						<p><?php echo ucfirst($sheet_index); ?></p>
					</div>
				</a>
				<?php
			}
			?>
		</div>
	</div>
</div>