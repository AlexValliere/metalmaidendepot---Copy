<span class="anchor" id="tank_shells"></span>
<div class="row">
	<div class="col-lg-12 requirements_block">
		<h4 class="page-header">Shells <small>From game version <span class="profile_version" style="background-color: <?php echo to_color($view_tank->getAmmo_game_version()); ?>; border-color: <?php echo to_color($view_tank->getAmmo_game_version()); ?>;"><?php echo $view_tank->getAmmo_game_version(); ?></span></small></h4>
		<button type="button" id="setShell_legend_visibility" onClick="setShell_legend_visibility();">Legend of shell icons [ Click to expand ]</button>
		<div id="shell_legend" style="display: none;">
		<section>
			
			<div class="row">
				<div class="col-xs-12">Modifiers legend :</div>
				<br>
				<div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/modifiers/Ammo_Modifier_-_Turbo.png" alt="Increases targeting" title="Increases targeting"> Increases targeting</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/modifiers/Ammo_Modifier_-_Fin_Stabilized.png" alt="Increases targeting, reduces penetration" title="Increases targeting, reduces penetration"> Increases targeting, reduces penetration</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/modifiers/Ammo_Modifier_-_Skull.png" alt="Frangible : Increases damage against infantry, if no infantry left then crit rate increased" title="Frangible : Increases damage against infantry, if no infantry left then crit rate increased"> Frangible : Increases damage against infantry, if no infantry left then crit rate increased</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/modifiers/Ammo_Modifier_-_Incendiary.png" alt="Burning Agent : Shells have a chance to ignite targets without penetrating them." title="Burning Agent : Shells have a chance to ignite targets without penetrating them."> Burning Agent : Shells have a chance to ignite targets without penetrating them.</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/modifiers/Ammo_Modifier_-_Cross.png" alt="Increases targeting, reduces firepower" title="Increases targeting, reduces firepower"> Increases targeting, reduces firepower</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/modifiers/Ammo_Modifier_-_Shaped.png" alt="Shaped : Shells have a small chance to ignite targets without penetrating them." title="Shaped : Shells have a small chance to ignite targets without penetrating them."> Shaped : Shells have a small chance to ignite targets without penetrating them.</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/modifiers/Ammo_Modifier_-_Long_Range.png" alt="Long-Rod : Ignores more armor than regular APDS" title="Long-Rod : Ignores more armor than regular APDS"> Long-Rod : Ignores more armor than regular APDS</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/modifiers/Ammo_Modifier_-_Light.png" alt="Guerrilla : Small increase in crit chance and crit damage" title="Guerrilla : Small increase in crit chance and crit damage"> Guerrilla : Small increase in crit chance and crit damage</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/modifiers/Ammo_Modifier_-_Heavy.png" alt="Heavy : The closer the target, the greater the penetration" title="Heavy : The closer the target, the greater the penetration"> Heavy : The closer the target, the greater the penetration</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/modifiers/Ammo_Modifier_-_Ballistic_Cap.png" alt="Increases targeting" title="Increases targeting"> Increases targeting</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/modifiers/Ammo_Modifier_-_High_Explosive.png" alt="Greatly increases firepower, reduces penetration" title="Greatly increases firepower, reduces penetration"> Greatly increases firepower, reduces penetration</div>
			</div>

			<hr />

			<div class="row">
				<div class="col-xs-12">Properties legend :</div>
				<br>
				<div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Molten.png" alt="Molten : Increases burning effect from combustion" title="Molten : Increases burning effect from combustion"> Molten : Increases burning effect from combustion</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Multi-launch.png" alt="Multi-Launch : Chance to hit an additional target during Shelling" title="Multi-Launch : Chance to hit an additional target during Shelling"> Multi-Launch : Chance to hit an additional target during Shelling</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Multi-launch2.png" alt="Multi-Launch : Chance to hit 2 additional targets during Shelling" title="Multi-Launch : Chance to hit 2 additional targets during Shelling"> Multi-Launch : Chance to hit 2 additional targets during Shelling</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/High-explosive.png" alt="High Explosive : Target's armor is less effective" title="High Explosive : Target's armor is less effective"> High Explosive : Target's armor is less effective</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Tracer.png" alt="Tracer : Increases the target's chance to be targeted more often" title="Tracer : Increases the target's chance to be targeted more often"> Tracer : Increases the target's chance to be targeted more often</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Fragment.png" alt="Fragment : Chance to hit an additional target during Shelling" title="Fragment : Chance to hit an additional target during Shelling"> Fragment : Chance to hit an additional target during Shelling</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Shockwave.png" alt="Shockwave : Increases critical chance by decreasing critical damage" title="Shockwave : Increases critical chance by decreasing critical damage"> Shockwave : Increases critical chance by decreasing critical damage</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Extended-range.png" alt="Extended-Range : Has longer range than similar weapon" title="Extended-Range : Has longer range than similar weapon"> Extended-Range : Has longer range than similar weapon</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/EFP.png" alt="EFP : Affected by target's armor, low armor targets preferred" title="EFP : Affected by target's armor, low armor targets preferred"> EFP : Affected by target's armor, low armor targets preferred</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/MSC.png" alt="MSC : Target's armor is less effective" title="MSC : Target's armor is less effective"> MSC : Target's armor is less effective</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Tandem.png" alt="Tandem : Reduces ricochet chance against specialised armors" title="Tandem : Reduces ricochet chance against specialised armors"> Tandem : Reduces ricochet chance against specialised armors</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Spinning.png" alt="Spinning : Reduces ricochet chance against specialised armors" title="Spinning : Reduces ricochet chance against specialised armors"> Spinning : Reduces ricochet chance against specialised armors</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Burst.png" alt="Burst : Applies a debuff that reduces the target's armor" title="Burst : Applies a debuff that reduces the target's armor"> Burst : Applies a debuff that reduces the target's armor</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Discarding-Sabot.png" alt="Discarding Sabot : Penetrator rod ignores a portion of target's armor" title="Discarding Sabot : Penetrator rod ignores a portion of target's armor"> Discarding Sabot : Penetrator rod ignores a portion of target's armor</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Rod-cap.png" alt="Rod-Cap : Reduces ricochet chance against specialised armors" title="Rod-Cap : Reduces ricochet chance against specialised armors"> Rod-Cap : Reduces ricochet chance against specialised armors</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Hardened.png" alt="Hardened : Affected by target's armor, low armor targets preferred" title="Hardened : Affected by target's armor, low armor targets preferred"> Hardened : Affected by target's armor, low armor targets preferred</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Quickfire.png" alt="Quickfire : Quickfire clip increases damage by a certain percentage" title="Quickfire : Quickfire clip increases damage by a certain percentage"> Quickfire : Quickfire clip increases damage by a certain percentage</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Tempered.png" alt="Tempered : Target's armor is less effective" title="Tempered : Target's armor is less effective"> Tempered : Target's armor is less effective</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Capped.png" alt="Capped : Reduces ricochet chance against specialised armors" title="Capped : Reduces ricochet chance against specialised armors"> Capped : Reduces ricochet chance against specialised armors</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Composite-rigid.png" alt="Composite Rigid : The closer the target, the greater the firepower" title="Composite Rigid : The closer the target, the greater the firepower"> Composite Rigid : The closer the target, the greater the firepower</div><div class="col-lg-4 col-sm-6 col-xs-12"><img src="assets/images/shells/properties/Assault.png" alt="Assault : The closer the target, the greater the penetration" title="Assault : The closer the target, the greater the penetration"> Assault : The closer the target, the greater the penetration</div>
			</div>

			<hr />
		</section>
		<br />
		</div>

		<div>
		<?php
		foreach($view_tank->getAmmo() as $shell_category => $availabe)
		{
			if ($availabe)
			{
				$shells_list = $shellsManager->get_by_category($shell_category);

				if (!empty($view_tank->getShell_ids()))
				{
					// echo $pw_ammo_description[$shell_category];

					echo '<table class="table table-bordered table-width-auto" style="margin: auto; display: inline-block; margin: 0 10px 10px; vertical-align: text-top;">';
					echo '<tr>';
					echo '<th colspan="4">'.$pw_ammo_description[$shell_category].'</th>';
					echo '</tr>';
					echo '<tr>';
					echo '<th>Shell</th>';
					echo '<th>Attributes</th>';
					echo '<th>Range</th>';
					echo '<th>Properties & Modifiers</th>';
					echo '</tr>';

					foreach ($shells_list as $shell)
					{
						if (in_array($shell->getId(), $view_tank->getShell_ids()))
						{
							?>
							<tr>
								<td>
									<img src="<?php echo strtolower(SHELLS_DIR.$shell->getCategory()).'/tech_'.$shell->getTier().'/'.$shell->getName().'_icon.png'; ?>" alt="<?php echo $shell->getName(); ?>'s icon" style="max-height: 35px; display: inline-block;" />
									<?php echo $shell->getName(); ?>
									<br />
									Tier <?php echo $shell->getTier(); ?>
									<br />
									Level <?php echo $shell->getLevel(); ?>
								</td>
								<td>
									<table>
									<?php
									if ($shell->getFirepower() != NULL)
										echo '<tr><td><img src="'.TANK_ATTRIBUTES_DIR.'firepower.png" alt="Firepower icon" style="height: 2em;" /></td><td>' . $shell->getFirepower() . '</td></tr>';
									if ($shell->getPenetration() != NULL)
										echo '<tr><td><img src="'.TANK_ATTRIBUTES_DIR.'penetration.png" alt="Firepower icon" style="height: 2em;" /></td><td>' . $shell->getPenetration() . '</td></tr>';
									if ($shell->getTargeting() != NULL)
										echo '<tr><td><img src="'.TANK_ATTRIBUTES_DIR.'targeting.png" alt="Firepower icon" style="height: 2em;" /></td><td>' . $shell->getTargeting() . '</td></tr>';
									if ($shell->getEvasion() != NULL)
										echo '<tr><td><img src="'.TANK_ATTRIBUTES_DIR.'evasion.png" alt="Firepower icon" style="height: 2em;" /></td><td>' . $shell->getEvasion() . '</td></tr>';
									if ($shell->getStealth() != NULL)
										echo '<tr><td><img src="'.TANK_ATTRIBUTES_DIR.'stealth.png" alt="Firepower icon" style="height: 2em;" /></td><td>' . $shell->getStealth() . '</td></tr>';
									?>
									</table>
								</td>
								<td>
									<?php echo $shell_ids[$shell->getId()]["shell_range"]; ?>
								</td>
								<td>
									<?php
									foreach ($shell->getShell_properties_ids() as $shell_property_id)
									{
										$shell_property_id--;
										echo '<img src="'. SHELLS_DIR . 'properties/' . $shell_properties[$shell_property_id]["icon_file_name"] . '" alt="' . $shell_properties[$shell_property_id]["name"] . " : " . $shell_properties[$shell_property_id]["description"] . '" title="' . $shell_properties[$shell_property_id]["name"] . " : " . $shell_properties[$shell_property_id]["description"] . '" style="height: 2em;" /> ';
									}
									?>
									<?php
									foreach ($shell->getShell_modifiers_ids() as $shell_modifier_id)
									{
										$shell_modifier_id--;
										echo '<img src="'. SHELLS_DIR . 'modifiers/' . $shell_modifiers[$shell_modifier_id]["icon_file_name"] . '" alt="' . $shell_modifiers[$shell_modifier_id]["description"] . '" title="' . $shell_modifiers[$shell_modifier_id]["description"] . '" style="height: 2em;" /> ';
									}
									?>
								</td>
							</tr>
							<?php
						}
					}
					echo '</table>';
				}
			}
		}
		?>
		</div>
	</div>
</div>

<script type="text/javascript">
var shell_legend_is_visible = false;
function setShell_legend_visibility() {
	if (shell_legend_is_visible) {
		$button = $('button[id=setShell_legend_visibility]');
		$button.text("Legend of shell icons [ Click to expand ]");
		document.getElementById('shell_legend').style.display = 'none';
	} else {
		$button = $('button[id=setShell_legend_visibility]');
		$button.text("Legend of shell icons [ Click to hide ]");
		document.getElementById('shell_legend').style.display = 'block';
	}
	shell_legend_is_visible = !shell_legend_is_visible;
}
</script>