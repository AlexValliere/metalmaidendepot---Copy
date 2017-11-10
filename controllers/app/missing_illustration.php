<?php
$metalMaidensManager = new MetalMaidensManager($dbhandler);
$metal_maidens_array = $metalMaidensManager->get_all();
$metal_maidens_missing_illustration = [];

foreach ($metal_maidens_array as $metal_maiden)
{
	$filename  = TANKS_DIR . "full/" . $metal_maiden->getImagename();
	$filename .= ".png";

	$filename2  = TANKS_DIR . "full/live2d/" . $metal_maiden->getImagename();
	$filename2 .= ".png";

	if ( !(file_exists(utf8_decode($filename))) && !(file_exists(urldecode($filename))) && !(file_exists(utf8_decode($filename2))) && !(file_exists(urldecode($filename2))) )
	{
		$metal_maidens_missing_illustration[] = $metal_maiden;
	}
}
?>