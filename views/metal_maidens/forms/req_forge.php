<fieldset>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
			<legend>Forge</legend>
		</div>
	</div>

	<div class="form-group">
		<label for="forge" class="col-sm-3 col-sm-offset-1 col-lg-2 col-lg-offset-3 control-label">Availibility :</label>
		<div class="col-sm-6 col-lg-2">
			<label class="radio-inline" for="true"><input type="radio" name="forge" value="1" id="true"
			<?php if (isset($tank) && $tank->getForge() == 1) echo 'checked="checked"'; ?>
			/> Yes</label>
			<label class="radio-inline" for="false"><input type="radio" name="forge" value="0" id="false"
			<?php if (!isset($tank) || (isset($tank) && $tank->getForge() == 0)) echo 'checked="checked"'; ?>
			/> No</label>
		</div>
	</div>
</fieldset>