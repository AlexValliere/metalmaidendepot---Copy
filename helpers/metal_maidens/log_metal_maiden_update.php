<?php
function metal_maiden_diff( MetalMaiden $metalMaidenRef, MetalMaiden $metalMaidenTarget)
{
	$diff = NULL;

	$check_array_1 = ["name", "tank", "category", "rarity"];

	foreach ($check_array_1 as $check_value)
	{
		if ( $metalMaidenRef->{'get' . ucfirst($check_value)}() != $metalMaidenTarget->{'get' . ucfirst($check_value)}() )
		{
			$diff[] = ["category" => $check_value, "action" => "updated", "object_id" => NULL, "old_value" => $metalMaidenRef->{'get' . ucfirst($check_value)}(), "new_value" => $metalMaidenTarget->{'get' . ucfirst($check_value)}()];
		}
	}

	return $diff;
}

function log_metal_maiden_update( MetalMaiden $metalMaiden, $category, $action, $object_id, $oldValue, $newValue, User $user )
{
	if ( $user )
	{
		if ( $metalMaiden )
		{
			if ($category && $action && $newValue)
			{
				$query = 'INSERT INTO `update_logs`
						SET metal_maiden_id = :metal_maiden_id,
						category = :category,
						action = :action,
						old_value = :old_value,
						new_value = :new_value';

				if ($object_id)
				{
					$query .= ", object_id = :object_id";
				}

				$query = $this->_dbhandler->prepare($query);

				$query->bindValue(':metal_maiden_id', $metalMaiden->getId(), PDO::PARAM_INT);
				$query->bindValue(':category', $category, PDO::PARAM_STR);
				$query->bindValue(':action', $action, PDO::PARAM_STR);
				$query->bindValue(':old_value', $old_value, PDO::PARAM_STR);
				$query->bindValue(':new_value', $new_value, PDO::PARAM_STR);
				$query->bindValue(':user', $user->getId(), PDO::PARAM_INT);

				if ($object_id)
				{
					$query->bindValue(':object_id', $object_id, PDO::PARAM_INT);
				}

				$query->execute() or die(print_r($query->errorInfo(), true));
			}
			return (0);
		}
		else
		{
			return (-2);
		}
	}

	else
	{
		return (-1);
	}
}
?>