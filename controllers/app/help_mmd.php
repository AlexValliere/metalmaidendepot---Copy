<?php
$metalMaidensManager = new MetalMaidensManager($dbhandler);
$metal_maidens_array = $metalMaidensManager->get_all();

$gold_metal_maidens_array = $metalMaidensManager->get_rarity("gold");
$purple_metal_maidens_array = $metalMaidensManager->get_rarity("purple");
?>