<?php
$metalMaidensManager = new MetalMaidensManager($dbhandler);
$tanks_indexed = $metalMaidensManager->count();
$hidden_tanks_indexed = $metalMaidensManager->count( TRUE ) - $tanks_indexed;
?>