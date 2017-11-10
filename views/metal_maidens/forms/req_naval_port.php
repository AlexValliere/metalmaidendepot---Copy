<fieldset>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
			<legend>Naval port</legend>
		</div>
	</div>

	<div class="form-group">
		<label for="naval_port" class="col-sm-3 col-sm-offset-1 col-lg-2 col-lg-offset-3 control-label">Level :</label>
		<div class="col-sm-6 col-lg-2">
			<select name="naval_port" id="naval_port" multiple class="form-control">
				<?php
				for ($i = 0; $i <= 8; $i++)
				{
					echo '<option value="' . $i . '" '; 
					if (isset($tank) && $tank->getNaval_port() == $i)
						echo 'selected="selected"';

					echo '>';

					if ($i == 0)
						echo 'Not available at naval port';
					else
						echo $i;

					echo '</option>';
				}
				?>
			</select>
		</div>
	</div>
</fieldset>