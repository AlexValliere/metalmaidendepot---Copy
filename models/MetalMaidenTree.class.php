<?php
class MetalMaidenTree
{
	private $_dbhandler;
	private $_parent;
	private $_metal_maiden;
	private $_children;
	private $_requirement;
	private $_branch;

	public function __construct( $dbhandler, MetalMaiden $metal_maiden ) {
		$this->setDbhandler( $dbhandler );
		$this->_parent = NULL;
		$this->_metal_maiden = $metal_maiden;
		$this->_children = array();
		$this->_requirement = NULL;
		$this->_branch = array();
		$this->_branch[] = $metal_maiden;
	}

	public function getBranch()										{ return $this->_branch; }
	public function getChildren()									{ return $this->_children; }
	public function getDbhandler()									{ return $this->_dbhandler; }
	public function getMetal_maiden()								{ return $this->_metal_maiden; }
	public function getParent()										{ return $this->_parent; }
	public function getRequirement()								{ return $this->_requirement; }

	public function setBranch( $branch )							{ $this->_branch = $branch; }
	public function setChildren( $children )						{ $this->_children = $children; }
	public function setDbhandler( PDO $dbhandler )					{ $this->_dbhandler = $dbhandler; }
	public function setMetal_madein( MetalMaiden $metal_maiden )	{ $this->_metal_maiden = $metal_maiden; }
	public function setParent( MetalMaiden $parent )				{ $this->_parent = $parent; }
	public function setRequirement( $requirement )					{ $this->_requirement = $requirement; }

	public function addToBranch( MetalMaiden $metal_maiden ) {
		$this->_branch[] = $metal_maiden;
	}

	public function addChild( MetalMaidenTree $child ) {
		$child->setParent( $this->_metal_maiden );
		$this->_children[] = $child;
	}

	public function createTree() {
		$metalMaidensManager = new MetalMaidensManager($this->GetDbhandler());
		$search_array = ["method_1", "method_2", "method_3", "develop", "research"];

		foreach ($search_array as $search_item)
		{
			if ($this->_metal_maiden->getRequirements($search_item) != NULL)
			{
				for ($i = 1; $i <= 3; $i++)
				{
					if ($this->getRequirement() == NULL)
						$this->setRequirement($this->_metal_maiden->getRequirements($search_item));

					if ($this->_metal_maiden->getRequirements($search_item)["tank_" . $i] != NULL)
					{
						$tank = $metalMaidensManager->get($this->_metal_maiden->getRequirements($search_item)["tank_" . $i]);

						if ($tank != NULL)
						{
							$child = new MetalMaidenTree($this->GetDbhandler(), $tank);
							$child->setBranch($this->_branch);
							$child->addToBranch($tank);

							if (!in_array($tank, $this->_branch))
							{
								$child->createTree();
								$this->addChild($child);
							}
						}
					}
				}

				break;
			}
		}
	}

	public function printTree() {
		static $node_id = 0;

		++$node_id;

		if ($node_id == 1)
			echo '<div class="row-fluid">';

		?>
		<div class="col-xs-offset-<?php if ($node_id == 1) echo "0"; else echo "1"; ?>" data-node-id="<?php echo $node_id; ?>">
			<table class="metal_maiden_tree_requirement">
				<tr>
					<th class="tank_portrait">
						<img
							src="<?php echo TANKS_DIR . 'portrait/' . $this->getMetal_maiden()->getImagename(); ?>.png"
							alt="<?php echo $this->getMetal_maiden()->getTank() . "'s portrait"; ?>"
							style="max-height: <?php if ($node_id == 1) echo "100px"; else echo "80px"; ?>;"
							data-node-id="<?php echo $node_id; ?>"
							data-node-rarity="<?php echo $this->getMetal_maiden()->getRarity(); ?>"
						/>
						<br />
						<p>
							<a class="<?php echo $this->getMetal_maiden()->getRarity(); ?>_rarity_text" href="<?php echo link_to_route("metal_maiden") . "&amp;tank=". $this->getMetal_maiden()->getTank_slug(); ?>"><?php echo $this->getMetal_maiden()->getTank(); ?></a>
							<br />
							<?php
							if ($this->_children != NULL)
								echo '<span data-node-id="'.$node_id.'" data-node-rarity="'.$this->getMetal_maiden()->getRarity().'">[ - ]</span>';
							?>
						</p>
					</th>
					<td class="metal_maiden_tree_requirement_subtable <?php if ($this->getRequirement() != NULL) echo $this->getMetal_maiden()->getRarity() . "_rarity"; ?>">
						<?php
						if ($this->getRequirement()["dogtag"])
						{
							echo '<div class="row">';
							echo '<div class="col-sm-7 col-xs-12">';
							echo 'Dogtag';
							echo '</div>';
							echo '<div class="clearfix visible-sm-block"></div>';
							echo '<div class="col-sm-5 col-xs-12">';
							echo $this->getRequirement()["dogtag"];
							echo '</div>';
							echo '</div>';
						}

						if (isset($this->getRequirement()["voucher"]) && $this->getRequirement()["voucher"])
						{
							echo '<div class="row">';
							echo '<div class="col-sm-7 col-xs-12">';
							echo 'Dogtag';
							echo '</div>';
							echo '<div class="clearfix visible-sm-block"></div>';
							echo '<div class="col-sm-5 col-xs-12">';
							echo $this->getRequirement()["voucher"];
							echo '</div>';
							echo '</div>';
						}

						if ($this->getRequirement()["blueprint_quantity"])
						{
							echo '<div class="row">';
							echo '<div class="col-sm-7 col-xs-12">';
							echo 'Blueprint';
							// echo ' <img src="'.PW_RESOURCES_DIR.$this->getRequirement()["blueprint"].".png".'" alt="Resource icon" style="display: inline-block; max-height: 40px" />';
							echo '</div>';
							echo '<div class="clearfix visible-sm-block"></div>';
							echo '<div class="col-sm-5 col-xs-12">';
							echo "N" . preg_replace("/[^0-9]/", "", $this->getRequirement()["blueprint"]) . " x " . $this->getRequirement()["blueprint_quantity"];
							echo '</div>';
							echo '</div>';
						}

						if ($this->getRequirement()["resource_quantity"])
						{
							echo '<div class="row">';
							echo '<div class="col-sm-7 col-xs-12">';
							echo ucfirst(str_replace("_", " ", $this->getRequirement()["resource"]));
							echo ' <img src="'.PW_RESOURCES_DIR.$this->getRequirement()["resource"].".png".'" alt="Resource icon" style="display: inline-block; max-height: 45px; max-width: 50px;" />';
							echo '</div>';
							echo '<div class="clearfix visible-sm-block"></div>';
							echo '<div class="col-sm-5 col-xs-12">';
							echo $this->getRequirement()["resource_quantity"];
							echo '</div>';
							echo '</div>';
						}

						if ($this->getRequirement()["equipment_quantity"] != 0)
						{
							echo '<div class="row">';
							echo '<div class="col-sm-7 col-xs-12">';
							$equipment = explode("_", $this->getRequirement()["equipment"]);
							$slot = array_shift($equipment);
							$equipment = implode("_", $equipment);

							echo ucfirst(str_replace("_", " ", $equipment));
							echo ' <img src="'.TANK_EQUIPMENTS_DIR . "slot_items/" . $equipment . ".png".'" alt="Equipment icon" style="display: inline-block; max-height: 38px; max-width: 50px;" />';
							echo ' <img src="'.TANK_EQUIPMENTS_DIR . "slots/" . $slot . ".png".'" alt="Equipment location icon" style="display: inline-block; max-height: 30px; max-width: 50px;" /> ';
							echo '</div>';
							echo '<div class="clearfix visible-sm-block"></div>';
							echo '<div class="col-sm-5 col-xs-12">';
							echo strtoupper($slot) . " S" . $this->getRequirement()["equipment_rank"] . " x " . $this->getRequirement()["equipment_quantity"];
							echo '</div>';
							echo '</div>';
						}

						if ($this->getRequirement()["silver"] != 0)
						{
							echo '<div class="row">';
							echo '<div class="col-sm-7 col-xs-12">';
							echo 'Silver';
							echo '</div>';
							echo '<div class="clearfix visible-sm-block"></div>';
							echo '<div class="col-sm-5 col-xs-12">';
							echo number_format($this->getRequirement()["silver"], '0', ',', '.');
							echo '</div>';
							echo '</div>';
						}
						?>
					</td>	
				</tr>
			</table>
			<?php
			foreach ($this->_children as $child)
			{
				echo '<div class="row-fluid">';
				$child->printTree();
				echo '</div>';
			}
			?>
		</div>
		<?php

		if ($node_id == 1)
			echo '</div>';
	}

	public function printTree3( $indentation = 0 )
	{
		static $node_id = 0;
		$node_id++;

		if ($indentation == 0)
			echo '<div class="row-fluid">';

		?>
		<div class="col-xs-offset-<?php if ($indentation == 0) echo "0"; else echo "1"; ?>" style="border-left: 0px solid white;" data-node-id="<?php echo $node_id; ?>">
			<table class="metal_maiden_tree_requirement">
			<tr>
				<th class="tank_portrait">
					<img
						src="<?php echo TANKS_DIR . 'portrait/' . $this->getMetal_maiden()->getImagename(); ?>.png"
						alt=""
						style="max-height: <?php if ($indentation == 0) echo "100px"; else echo "80px"; ?>;"
						data-node-id="<?php echo $node_id; ?>"
						data-node-rarity="<?php echo $this->getMetal_maiden()->getRarity(); ?>"
					/>
					<br />
					<p>
						<a class="<?php echo $this->getMetal_maiden()->getRarity(); ?>_rarity_text" href="<?php echo link_to_route("metal_maiden") . "&amp;tank=". $this->getMetal_maiden()->getTank_slug(); ?>"><?php echo $this->getMetal_maiden()->getTank(); ?></a>
						<br />
						<span data-node-id="<?php echo $node_id; ?>" data-node-rarity="<?php echo $this->getMetal_maiden()->getRarity(); ?>">[ - ]</span>
					</p>
				</th>
				<td>
					<table class="table-width-auto metal_maiden_tree_requirement_subtable <?php echo $this->getMetal_maiden()->getRarity(); ?>_rarity">
		<?php
		if ($this->getRequirement()["resource_quantity"] != 0)
		{
			?>
			<tr>
				<th>
					<img
						src="<?php echo PW_RESOURCES_DIR . $this->getRequirement()["resource"] . ".png"; ?>"
						alt="Resource image"
						style="display: inline-block; max-height: 40px;"
					/>
				</th>
				<td>
					x <?php echo $this->getRequirement()["resource_quantity"]; ?>
				</td>
			</tr>
			<?php
		}

		if ($this->getRequirement()["blueprint_quantity"] != 0)
		{
			?>
			<tr>
				<th>
					<img
						src="<?php echo PW_RESOURCES_DIR . $this->getRequirement()["blueprint"] . ".png"; ?>"
						alt="Resource image"
						style="display: inline-block; max-height: 35px;"
					/>
				</th>
				<td>
					N<?php echo preg_replace("/[^0-9]/", "", $this->getRequirement()["blueprint"]); ?>
					x <?php echo $this->getRequirement()["blueprint_quantity"]; ?>
				</td>
			</tr>
			<?php
		}

		if ($this->getRequirement()["equipment_quantity"] != 0)
		{
			$equipment = explode("_", $this->getRequirement()["equipment"]);
			$slot = array_shift($equipment);
			$equipment = implode("_", $equipment);
			?>
			<tr>
				<th>
					<img
						src="<?php echo TANK_EQUIPMENTS_DIR . "slots/" . $slot . ".png"; ?>"
						alt="Resource image"
						style="display: inline-block; max-height: 25px;"
					/>
					<img
						src="<?php echo TANK_EQUIPMENTS_DIR . "slot_items/" . $equipment . ".png"; ?>"
						alt="Resource image"
						style="display: inline-block; max-height: 30px;"
					/>
				</th>
				<td>
					<?php echo "S" . $this->getRequirement()["equipment_rank"]; ?>
					x <?php echo $this->getRequirement()["equipment_quantity"]; ?>
				</td>
			</tr>
			<?php
		}
		
		if ($this->getRequirement()["silver"] != 0)
		{
			?>
			<tr>
				<th>
					<img
						src="<?php echo PW_RESOURCES_DIR . "silver.png"; ?>"
						alt="Resource image"
						style="display: inline-block; max-height: 30px;"
					/>
				</th>
				<td>
					x <?php echo number_format($this->getRequirement()["silver"], 0, ',', ' '); ?>
				</td>
			</tr>
			<?php
		}
		?>
					</table>
				</td>
			</tr>
		</table>
		<?php

/*		if ($this->getMetal_maiden()->getRarity() != "blue")
		{*/
			foreach ($this->_children as $child)
			{
				echo '<div class="row-fluid">';
				$child->printTree($indentation + 1);
				echo '</div>';
			}
/*		}*/

		echo '</div>';

		if ($indentation == 0)
			echo '</div>';
	}

	public function printTree2( $root_level = 0 ) {
		echo '<div class="col-lg-12" style="text-align: center; border-top: 1px solid white; padding-top: 25px;">';
		// echo $this->getMetal_maiden() . " requires :";
		echo '<div class="row">';

		if ($this->getRequirement()["dogtag"] != 0)
			echo "<p>Dogtag: " . $this->getRequirement()["dogtag"] . "</p>";
		if ($this->getRequirement()["resource_quantity"] != 0)
			echo "<p>" . $this->getRequirement()["resource"] . " x " . $this->getRequirement()["resource_quantity"] . "</p>";
		if ($this->getRequirement()["blueprint_quantity"] != 0)
			echo "<p>" . $this->getRequirement()["blueprint"] . " x " . $this->getRequirement()["blueprint_quantity"] . "</p>";
		if ($this->getRequirement()["equipment_quantity"] != 0)
		{
			$equipment = explode("_", $this->getRequirement()["equipment"]);
			$slot = array_shift($equipment);
			$equipment = implode("_", $equipment);

			echo "<p> S" . $this->getRequirement()["equipment_rank"] . " " .  $slot . " " . $equipment . " x " . $this->getRequirement()["equipment_quantity"] . "</p>";
		}
		if ($this->getRequirement()["silver"] != 0)
			echo "<p>Silver x " . $this->getRequirement()["silver"] . "</p>";

		foreach ($this->_children as $child)
		{
			if ($root_level < 2)
				echo '<div class="col-lg-4" style="text-align: center;">';
			else
				echo '<div class="col-lg-12" style="text-align: center;">';

			echo '<img src="' .TANKS_DIR . 'portrait/' . $child->getMetal_maiden()->getImagename() . '.png" class="img-responsive" style="margin: auto;';
			
			if ($root_level == 1)		echo "width: 100px;";
			else if ($root_level > 1)	echo "width: 80px;";
			echo '" />';

			echo '<p class="' . $child->getMetal_maiden()->getRarity() . '_rarity_text">' . $child->getMetal_maiden()->getTank() . '</p>';

			if ($child->getMetal_maiden()->getRarity() == "gold")
				$child->printTree( $root_level + 1 );

			echo '</div>';
		}
		echo '</div></div>';
	}
}
?>