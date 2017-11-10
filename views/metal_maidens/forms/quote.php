<?php
	$quote_array = array(
		"quote_intro"			=> "Intro",
		"quote_main_screen_1"	=> "Main screen #1",
		"quote_main_screen_2"	=> "Main screen #2",
		"quote_main_screen_3"	=> "Main screen #3",
		"quote_main_screen_4"	=> "Main screen #4",
		"quote_main_screen_5"	=> "Main screen #5",
		"quote_main_screen_6"	=> "Main screen #6",
		"quote_upgrading"		=> "On upgrade",
		"quote_pre_attack_1"	=> "Pre-attack #1",
		"quote_pre_attack_2"	=> "Pre-attack #2",
		"quote_pre_attack_3"	=> "Pre-attack #3",
		"quote_on_attack_1"		=> "On attack #1",
		"quote_on_attack_2"		=> "On attack #2",
		"quote_on_attack_3"		=> "On attack #3",
		"quote_on_attack_4"		=> "On attack #4",
		"quote_on_attack_5"		=> "On attack #5",
		"quote_on_attack_6"		=> "On attack #6",
		"quote_on_attack_7"		=> "On attack #7",
		"quote_getting_hit"		=> "Getting hit",
		"quote_upon_destruction"	=> "Upon destruction",
		"quote_added_to_squad"	=> "Assignation to a squad",
		"quote_choice_of_essential_equipment_1"	=> "Adding essential equipment #1",
		"quote_choice_of_essential_equipment_2"	=> "Adding essential equipment #2",
		"quote_choice_of_essential_equipment_3"	=> "Adding essential equipment #3",
		"quote_choice_of_essential_equipment_4"	=> "Adding essential equipment #4",
		"quote_when_updating_equipment_1"		=> "Changing equipment #1",
		"quote_when_updating_equipment_2"		=> "Changing equipment #2",
		"quote_when_updating_equipment_3"		=> "Changing equipment #3",
		"quote_unequip_all_gear"	=> "Unequip all gear",
		"quote_battle_victory_1"	=> "Battle victory #1",
		"quote_battle_victory_2"	=> "Battle victory #2",
		"quote_battle_victory_3"	=> "Battle victory #3",
		"quote_battle_loss"	=> "Battle loss",
		"quote_fate"			=> "Fate"
	);
?>
<fieldset>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3 col-lg-6 col-lg-offset-3">
			<legend>Quotes</legend>
		</div>
	</div>

	<div class="col-sm-10 col-sm-offset-2 col-lg-6 col-lg-offset-3">
		<p>Type null to set a quote to <span style="color: Crimson;">No quote</span></p>
	</div>

	<?php
	foreach ($quote_array as $quote_index => $quote_name)
	{
		?>
		<div class="form-group">
			<label for="<?php echo $quote_index; ?>" class="col-sm-2 col-sm-offset-1 col-lg-2 col-lg-offset-2 control-label"><?php echo $quote_name; ?> :</label>
			<div class="col-sm-6 col-lg-5">
				<textarea class="form-control" name="<?php echo $quote_index; ?>" id="<?php echo $quote_index; ?>" rows="3"><?php if (isset($tank)) echo $tank->getQuote($quote_index); ?></textarea>
			</div>
		</div>
		<?php
	}
	?>

</fieldset>