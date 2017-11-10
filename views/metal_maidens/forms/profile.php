<fieldset>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<legend>Profile</legend>
		</div>
	</div>
	<div class="form-group">
		<label for="tank" class="col-sm-2 col-sm-offset-3 control-label">Tank :</label>
		<div class="col-sm-3 col-lg-2">
			<input type="text" name="tank" id="tank" placeholder="Ex : Churchill Mk-I" maxlength="50" class="form-control"
			<?php if (isset($tank)) echo 'value="' . $tank->getTank() . '"'; ?>
			/>
		</div>
	</div>

	<div class="form-group">
		<label for="name" class="col-sm-2 col-sm-offset-3 control-label">Name :</label>
		<div class="col-sm-3 col-lg-2">
			<input type="text" name="name" id="name" placeholder="Ex : Camilla Beck" class="form-control"
			<?php if (isset($tank)) echo 'value="' . $tank->getName() . '"'; ?>
			/>
		</div>
	</div>

	<div class="form-group">
		<label for="hidden" class="col-sm-2 col-sm-offset-3 control-label">Is hidden ?</label>
		<div class="col-sm-3 col-lg-2">
			<label class="radio-inline" for="isHidden"><input type="radio" name="hidden" value="1" id="isHidden"
			<?php if (isset($tank) && $tank->getHidden() == "1") echo 'checked="checked"'; ?>
			/> Yes</label><br />
			<label class="radio-inline" for="isNotHidden"><input type="radio" name="hidden" value="0" id="isNotHidden"
			<?php if (!isset($tank) || (isset($tank) && $tank->getHidden() == "0")) echo 'checked="checked"'; ?>
			/> No</label>
		</div>
	</div>

	<div class="form-group">
		<label for="profile_game_version" class="col-sm-2 col-sm-offset-3 control-label">Profile from game version ?</label>
		<div class="col-sm-3 col-lg-2">
			<select name="profile_game_version" id="profile_game_version" class="form-control">
				<?php
				$game_versions_array = array_merge([""], array_reverse($pw_game_versions));
				$last_game_version = (isset($game_versions_array) && count($game_versions_array) > 1) ? $game_versions_array[1] : [""];

				foreach ( $game_versions_array as $pw_game_version ) {
					echo '<option value="'.$pw_game_version.'" ';

					if (isset($tank) && ($tank->getProfile_game_version() == $pw_game_version))
						echo 'selected="selected"';

					if ($pw_game_version == $last_game_version && !isset($tank))
						echo 'selected="selected"';

					echo '>'.$pw_game_version.'</option>';
				}
				?>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="root_head_id" class="col-sm-2 col-sm-offset-3 control-label">Root head id :</label>
		<div class="col-sm-3 col-lg-2">
			<input type="number" name="root_head_id" id="root_head_id" min="0" max="9999" step="1" class="form-control"
			value="<?php if (isset($tank)) echo $tank->getRoot_head_id(); else echo "0"; ?>"
			/>
		</div>
	</div>

	<div class="form-group">
		<label for="category" class="col-sm-2 col-sm-offset-3 control-label">Category :</label>
		<div class="col-sm-3 col-lg-2">
			<select name="category" id="category" multiple class="form-control">
				<option value="atg"
				<?php if (isset($tank) && $tank->getCategory() == "atg") echo 'selected="selected"'; ?>
				>AnTi-Gun</option>
				<option value="ht"
				<?php if (isset($tank) && $tank->getCategory() == "ht") echo 'selected="selected"'; ?>
				>Heavy Tank</option>
				<option value="lav"
				<?php if (isset($tank) && $tank->getCategory() == "lav") echo 'selected="selected"'; ?>
				>Light Armored Vehicle</option>
				<option value="lt"
				<?php if (isset($tank) && $tank->getCategory() == "lt") echo 'selected="selected"'; ?>
				>Light Tank</option>
				<option value="mt"
				<?php if (isset($tank) && $tank->getCategory() == "mt") echo 'selected="selected"'; ?>
				>Medium Tank</option>
				<option value="spg"
				<?php if (isset($tank) && $tank->getCategory() == "spg") echo 'selected="selected"'; ?>
				>Self Propelled Gun</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="nation" class="col-sm-2 col-sm-offset-3 control-label">Nation :</label>
		<div class="col-sm-3 col-lg-2">
			<select name="nation" id="nation" multiple class="form-control">

				<?php
				foreach ($pw_nations as $pw_nation)
				{
					?>
					<option value="<?php echo $pw_nation; ?>"
					<?php if (isset($tank) && $tank->getNation() == $pw_nation) echo 'selected="selected"'; ?>
					><?php echo ucfirst($pw_nation); ?></option>
					<?php
				}
				?>
				<!--<option value="bavaria"
				<?php if (isset($tank) && $tank->getNation() == "bavaria") echo 'selected="selected"'; ?>
				>Bavaria</option>
				<option value="britannia"
				<?php if (isset($tank) && $tank->getNation() == "britannia") echo 'selected="selected"'; ?>
				>Britannia</option>
				<option value="freedonia"
				<?php if (isset($tank) && $tank->getNation() == "freedonia") echo 'selected="selected"'; ?>
				>Freedonia</option>
				<option value="gallia"
				<?php if (isset($tank) && $tank->getNation() == "gallia") echo 'selected="selected"'; ?>
				>Gallia</option>
				<option value="nippon"
				<?php if (isset($tank) && $tank->getNation() == "nippon") echo 'selected="selected"'; ?>
				>Nippon</option>
				<option value="rossiya"
				<?php if (isset($tank) && $tank->getNation() == "rossiya") echo 'selected="selected"'; ?>
				>Rossiya</option>
				<option value="national_flag-08"
				<?php if (isset($tank) && $tank->getNation() == "national_flag-08") echo 'selected="selected"'; ?>
				>national_flag-08</option>
				<option value="sweden"
				<?php if (isset($tank) && $tank->getNation() == "sweden") echo 'selected="selected"'; ?>
				>Sweden</option>
				<option value="china"
				<?php if (isset($tank) && $tank->getNation() == "china") echo 'selected="selected"'; ?>
				>China</option>
				<option value="italian"
				<?php if (isset($tank) && $tank->getNation() == "italian") echo 'selected="selected"'; ?>
				>Italian</option>
				<option value="national_flag-12"
				<?php if (isset($tank) && $tank->getNation() == "national_flag-12") echo 'selected="selected"'; ?>
				>national_flag-12</option>-->
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="rarity" class="col-sm-2 col-sm-offset-3 control-label">Rarity :</label>
		<div class="col-sm-3 col-lg-2">
			<select name="rarity" id="rarity" multiple class="form-control">
				<option value="blue"
				<?php if (isset($tank) && $tank->getRarity() == "blue") echo 'selected="selected"'; ?>
				>Blue</option>
				<option value="purple"
				<?php if (isset($tank) && $tank->getRarity() == "purple") echo 'selected="selected"'; ?>
				>Purple</option>
				<option value="gold"
				<?php if (isset($tank) && $tank->getRarity() == "gold") echo 'selected="selected"'; ?>
				>Gold</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="character_voice" class="col-sm-2 col-sm-offset-3 control-label">Character voice :</label>
		<div class="col-sm-3 col-lg-2">
			<input type="text" name="character_voice" id="character_voice" placeholder="Ex : Megumi Han" class="form-control"
			<?php if (isset($tank)) echo 'value="' . $tank->getCharacter_voice() . '"'; ?>
			/>
		</div>
	</div>

	<div class="form-group">
		<label for="live2d" class="col-sm-2 col-sm-offset-3 control-label">Live2D availibility :</label>
		<div class="col-sm-3 col-lg-2">
			<label class="radio-inline" for="null"><input type="radio" name="live2d" value="null" id="null"
			<?php if (isset($tank) && $tank->getLive2d() == NULL) echo 'checked="checked"'; elseif (!isset($tank)) echo 'checked="checked"'; ?>
			/> (empty)</label><br />
			<label class="radio-inline" for="live2available"><input type="radio" name="live2d" value="1" id="live2available"
			<?php if (isset($tank) && $tank->getLive2d() == "1") echo 'checked="checked"'; ?>
			/> Available</label><br />
			<label class="radio-inline" for="live2notavailable"><input type="radio" name="live2d" value="0" id="live2notavailable"
			<?php if (isset($tank) && $tank->getLive2d() == "0") echo 'checked="checked"'; ?>
			/> Not available</label>
		</div>
	</div>

	<div class="form-group">
		<label for="live2d_name" class="col-sm-2 col-sm-offset-3 control-label">Live2D name :</label>
		<div class="col-sm-3 col-lg-2">
			<input type="text" name="live2d_name" id="live2d_name" placeholder="Ex : 4D_A" class="form-control"
			<?php if (isset($tank)) echo 'value="' . $tank->getLive2d_name() . '"'; ?>
			/>
		</div>
	</div>
</fieldset>