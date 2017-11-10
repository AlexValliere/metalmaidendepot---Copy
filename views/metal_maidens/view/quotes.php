<div class="table-responsive">
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
		"quote_choice_of_essential_equipment_1"		=> "Adding essential equipment #1",
		"quote_choice_of_essential_equipment_2"		=> "Adding essential equipment #2",
		"quote_choice_of_essential_equipment_3"		=> "Adding essential equipment #3",
		"quote_choice_of_essential_equipment_4"		=> "Adding essential equipment #4",
		"quote_when_updating_equipment_1"		=> "Adding equipment to a slot #1",
		"quote_when_updating_equipment_2"		=> "Adding equipment to a slot #2",
		"quote_when_updating_equipment_3"		=> "Adding equipment to a slot #3",
		"quote_unequip_all_gear"	=> "Unequip all gear",
		"quote_battle_victory_1"	=> "Battle victory #1",
		"quote_battle_victory_2"	=> "Battle victory #2",
		"quote_battle_victory_3"	=> "Battle victory #3",
		"quote_battle_loss"	=> "Battle loss",
		"quote_fate"			=> "Fate"
	);
	?>
	<p><strong>Quotes</strong></p>
	<table class="table table-condensed">
		<tr>
			<th>From</th>
			<th>Quote</th>
		</tr>
		<?php
			foreach ($quote_array as $quote_index => $quote)
			{
				?>
				<tr>
					<td><?php echo $quote; ?></td>
					<td><?php echo $view_tank->getQuote($quote_index); ?></td>
				</tr>
				<?php
			}
			?>
	</table>
</div>