<?php
$method = $_SERVER['REQUEST_METHOD'];
$armorsManager = new ArmorsManager($dbhandler);

if (isset($_GET['armor_id']))
	$armor = $armorsManager->get($_GET['armor_id']);

if ($method == 'POST' && isset($_POST["edit_armor"]))
{
	$armor = $armorsManager->get($_POST['edit_armor']);

	if (isset($armor) && $armor != FALSE)
	{
		$name = $_POST["armor_name"];
		$category = $_POST["armor_category"];
		$tier = $_POST["armor_tier"];
		$level = $_POST["armor_level"];
		$armor_value = $_POST["armor_armor"];
		$durability = $_POST["armor_durability"];
		$evasion = $_POST["armor_evasion"];
		$stealth = $_POST["armor_stealth"];
		$targeting = $_POST["armor_targeting"];
		$cast = isset($_POST["armor_cast"]) ? 1 : 0;
		$composite = isset($_POST["armor_composite"]) ? 1 : 0;
		$hardened = isset($_POST["armor_hardened"]) ? 1 : 0;
		$riveted = isset($_POST["armor_riveted"]) ? 1 : 0;
		$spaced = isset($_POST["armor_spaced"]) ? 1 : 0;
		$tempered = isset($_POST["armor_tempered"]) ? 1 : 0;
		$wedge = isset($_POST["armor_wedge"]) ? 1 : 0;
		$welded = isset($_POST["armor_welded"]) ? 1 : 0;

		$armor->setName( $name );
		$armor->setCategory( $category );
		$armor->setTier( $tier );
		$armor->setLevel( $level );
		$armor->setArmor( $armor_value );
		$armor->setDurability( $durability );
		$armor->setEvasion( $evasion );
		$armor->setStealth( $stealth );
		$armor->setTargeting( $targeting );
		$armor->setCast( $cast );
		$armor->setComposite( $composite );
		$armor->setHardened( $hardened );
		$armor->setRiveted( $riveted );
		$armor->setSpaced( $spaced );
		$armor->setTempered( $tempered );
		$armor->setWedge( $wedge );
		$armor->setWelded( $welded );

		$armorsManager->update($armor);

		if (VERBOSE)
			echo var_dump($armor);

		redirection(link_to_route("armors"), 250);
	}
}
?>