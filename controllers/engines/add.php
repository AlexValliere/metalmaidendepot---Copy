<?php
$method = $_SERVER['REQUEST_METHOD'];
$enginesManager = new EnginesManager($dbhandler);

if ($method == 'POST')
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

	$engine = new Engine(
		array(
			'name' => $name,
			'tier' => $tier,
			'level' => $level,
			'detection' => $detection,
			'durability' => $durability,
			'evasion' => $evasion,
			'stealth' => $stealth,
			'targeting' => $targeting,
			'c_proof' => $c_proof,
			'd_proof' => $d_proof,
			'h_proof' => $h_proof,
			's_proof' => $s_proof,
			'w_proof' => $w_proof,
			'silent' => $silent
		)
	);

	$enginesManager->add($engine);

	redirection(link_to_route("engines"), 250);
}
?>