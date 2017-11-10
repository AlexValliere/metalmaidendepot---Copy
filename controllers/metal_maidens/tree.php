<?php
$metalMaidensManager = new MetalMaidensManager($dbhandler);

if (isset($_GET['tank']))
{
	$view_tank = $metalMaidensManager->get_by_tank_slug($_GET['tank']);
	$view_tank_tree = new MetalMaidenTree($dbhandler, $view_tank);
	$view_tank_tree->createTree();
	?>
<script language="javascript">
	document.title = "<?php echo $view_tank->getTank(); ?>".concat(" [Tree] - ").concat(document.title)
</script>
	<?php
}
?>
