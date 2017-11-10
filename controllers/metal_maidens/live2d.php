<?php
$metalMaidensManager = new MetalMaidensManager($dbhandler);

if (isset($_GET['tank']))
{
	$view_tank = $metalMaidensManager->get_by_tank_slug($_GET['tank']);
	?>
<script language="javascript">
	document.title = "<?php echo $view_tank->getTank(); ?>".concat(" [Live2D] - ").concat(document.title)
</script>
	<?php
}

$live2d_location = strtolower($view_tank->getLive2d_name());
$live2d_location_tmp = explode("_", $view_tank->getLive2d_name());
if (count($live2d_location_tmp) > 2)
{
	$live2d_location = implode("_", [$live2d_location_tmp[0], $live2d_location_tmp[1]]);
}
$live2d_modelname = strtolower($view_tank->getLive2d_name());
$live2d_expressions = ["anger", "engage", "normal", "happy", "hit", "proud", "sad", "shy", "silent", "smile", "special"];
// $live2d_motions = ["idle", "action_off", "ready_attack", "action_on", "attack", "fly_attack", "fly_move", "engine", "fly_attack2"];
$live2d_motions = ["idle", "attack", "ready_attack", "action_on", "action_off"];
?>