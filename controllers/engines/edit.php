<?php
$method = $_SERVER['REQUEST_METHOD'];
$enginesManager = new EnginesManager($dbhandler);

if (isset($_GET['engine_id']))
	$engine = $enginesManager->get($_GET['engine_id']);

if ($method == 'POST' && isset($_POST["edit_engine"]))
{
	$engine = $enginesManager->get($_POST['edit_engine']);

	if (isset($engine) && $engine != FALSE)
	{
		$name = $_POST["engine_name"];
		$tier = $_POST["engine_tier"];
		$level = $_POST["engine_level"];
		$detection = $_POST["engine_detection"];
		$durability = $_POST["engine_durability"];
		$evasion = $_POST["engine_evasion"];
		$stealth = $_POST["engine_stealth"];
		$targeting = $_POST["engine_targeting"];
		$c_proof = isset($_POST["engine_c_proof"]) ? 1 : 0;
		$d_proof = isset($_POST["engine_d_proof"]) ? 1 : 0;
		$h_proof = isset($_POST["engine_h_proof"]) ? 1 : 0;
		$s_proof = isset($_POST["engine_s_proof"]) ? 1 : 0;
		$w_proof = isset($_POST["engine_w_proof"]) ? 1 : 0;
		$silent = isset($_POST["engine_silent"]) ? 1 : 0;

		$engine->setName( $name );
		$engine->setTier( $tier );
		$engine->setLevel( $level );
		$engine->setDetection( $detection );
		$engine->setDurability( $durability );
		$engine->setEvasion( $evasion );
		$engine->setStealth( $stealth );
		$engine->setTargeting( $targeting );
		$engine->setC_proof( $c_proof );
		$engine->setD_proof( $d_proof );
		$engine->setH_proof( $h_proof );
		$engine->setS_proof( $s_proof );
		$engine->setW_proof( $w_proof );
		$engine->setSilent( $silent );

		$enginesManager->update($engine);

		if (VERBOSE)
			echo var_dump($engine);

		redirection(link_to_route("engines"), 250);
	}
}
?>