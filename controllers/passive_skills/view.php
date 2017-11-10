<?php
$passiveSkillsManager = new PassiveSkillsManager( $dbhandler );
$passiveSkill = $passiveSkillsManager->get($_GET["id"]);
?>