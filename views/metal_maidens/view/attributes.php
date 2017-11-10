<div class="col-lg-8">
	<p><strong>Statistics :</strong> [ <span class="attribute_lvl60">Value at level 60</span> ] [ <a href="<?php echo link_to_route("statistics") . "&amp;category=" . $view_tank->getCategory(); ?>"><span class="attribute_rank">Rank in <?php echo strtoupper($view_tank->getCategory()); ?> category</span></a> <small><span class="attribute_delta_median">&Delta;</span> &plusmn; delta median</small> ]</p>
	<?php
	foreach ($pw_tank_attributes as $attribute)
	{
		?>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div class="table-responsive">
				<table class="table table-bordered attribute">
					<tr>
						<td><?php echo number_format($view_tank->getAttribute($attribute), 0, ',', ' '); ?><?php if (in_array($attribute . "_lvl60", $pw_tank_attributes_lvl60)) echo "<br /><span class='attribute_lvl60'>" . $view_tank->getAttribute($attribute . "_lvl60") . "</span>"; ?></td>
						<td>
							<img src="<?php echo TANK_ATTRIBUTES_DIR . $attribute . ".png"; ?>" alt="" . ucfirst($attribute) . " icon" />
						</td>
						<td>
							<?php echo ucfirst($attribute); ?>
							<br />
							<span class="attribute_rank"><?php echo $metalMaidensManager->get_attribute_rank_for_id_in_category($view_tank->getId(), $view_tank->getCategory(), $attribute)["rank"]; ?></span> <small><span class="attribute_delta_median">&Delta;</span> <?php echo sprintf("%+d", $metalMaidensManager->get_attribute_rank_for_id_in_category($view_tank->getId(), $view_tank->getCategory(), $attribute)["delta_median"]); ?></small>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php
	}
	foreach ($pw_tank_hidden_attributes as $attribute)
	{
		?>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div class="table-responsive">
				<table class="table table-bordered attribute">
					<tr>
						<td class="hidden_stat"><?php echo $view_tank->getAttribute($attribute); ?></td>
						<td colspan="2"><?php echo str_replace("Crit", "Critical", str_replace("resist", "resistance", str_replace("_", " ", ucfirst($attribute)))); ?></td>
					</tr>
				</table>
			</div>
		</div>
		<?php
	}
	?>
</div>