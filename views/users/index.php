<section class="users">
	<div class="table-responsive">
		<table class="table table-bordered table-condensed">
			<tr>
				<th>Id</th>
				<th>Username</th>
				<th>Username canonical</th>
				<th>Email</th>
				<th>Roles</th>
				<th>Enabled</th>
				<th>Locked</th>
				<th>Registred on</th>
				<th>Actions</th>
			</tr>
			<?php
			foreach ($users as $user)
			{
				echo "<tr>";

				echo "<td>";
				echo $user->getId();
				echo "</td>";

				echo "<td>";
				echo $user->getUsername();
				echo "</td>";

				echo "<td>";
				echo $user->getUsername_canonical();
				echo "</td>";

				echo "<td>";
				echo $user->getEmail();
				echo "</td>";

				echo "<td>";
				echo implode(",", $user->getRoles());
				echo "</td>";

				echo "<td>";
				echo $user->getEnabled();
				echo "</td>";

				echo "<td>";
				echo $user->getLocked();
				echo "</td>";

				echo "<td>";
				echo $user->getRegistred_on();
				echo "</td>";

				echo "<td>";
				echo '<a href="' . link_to_route("edit_user") . '&amp;id=' . $user->getId() . '">';
				echo '<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>';
				echo "</a>";
				echo "</td>";

				echo "</tr>";
			}
			?>
		</table>
	</div>
</section>