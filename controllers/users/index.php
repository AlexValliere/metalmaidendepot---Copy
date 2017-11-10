<?php
$usersManager = new UsersManager($dbhandler);
$users = $usersManager->get_all();
?>