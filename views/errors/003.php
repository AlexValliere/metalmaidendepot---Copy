You are not allowed to see this page.<br />
Required roles are:<br />
<?php
foreach (explode(',', $route_firewall) as $role)
	echo "- " . $role . "<br />";
?>
<br />
Your roles are:<br />
<?php
if ($current_user != NULL)
{
	foreach ($current_user->getRoles() as $role)
		echo "- " . $role . "<br />";
}
?>