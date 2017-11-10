<?php
$results = NULL;

if (isset($_GET["query"]) && !empty($_GET["query"]))
{
	$metalMaidensManager = new MetalMaidensManager($dbhandler);

	$search = strtolower($_GET["query"]);
	$search = remove_accents($search);

	$search = str_replace("mk-3", "mk-iii", $search);
	$search = str_replace("mk-2", "mk-ii", $search);
	$search = str_replace("mk-1", "mk-i", $search);
	$search = str_replace("mk.3", "mk.iii", $search);
	$search = str_replace("mk.2", "mk.ii", $search);
	$search = str_replace("mk.1", "mk.i", $search);

	$search = str_replace("mk-8", "mk-viii", $search);
	$search = str_replace("mk-7", "mk-vii", $search);
	$search = str_replace("mk-6", "mk-vi", $search);
	$search = str_replace("mk.8", "mk.viii", $search);
	$search = str_replace("mk.7", "mk.vii", $search);
	$search = str_replace("mk.6", "mk.vi", $search);


	$search = str_replace("mk-4", "mk-iv", $search);
	$search = str_replace("mk-9", "mk-ix", $search);
	$search = str_replace("mk.4", "mk.iv", $search);
	$search = str_replace("mk.9", "mk.ix", $search);


	$search = str_replace("mk-5", "mk-v", $search);
	$search = str_replace("mk-10", "mk-x", $search);
	$search = str_replace("mk.5", "mk.v", $search);
	$search = str_replace("mk.10", "mk.x", $search);


	$search = str_replace("jagdpanzer 4", "jagdpanzer iv", $search);
	$search = str_replace("panzer 3", "panzer iii", $search);
	$search = str_replace("panzer 4", "panzer iv", $search);
	$search = str_replace("sturmgeschutz", "sturmgeschütz", $search);
	$search = str_replace("geschutzwagen", "geschützwagen", $search);

	// Search for a tank name from the search query
	$results = $metalMaidensManager->get_like_tank_slug(post_slug($search));

	// If no tank names are found, search for special keywords (nations and tank categories)
	if ($results == NULL)
	{
		// Explode user's search query and search for a nation or tank category keyword
		$search_table = explode(" ", $search);

		foreach ($search_table as $key)
		{
			if (array_key_exists($key, $pw_tank_categories) || in_array($key, $pw_nations))
				$keys[] = $key;
		}

		// If a keyword have been found in the search query
		if (isset($keys) && !empty($keys))
		{
			$keys = array_unique($keys);

			foreach ($keys as $key)
			{
				if (array_key_exists($key, $pw_tank_categories))
					$tank_list[$key] = $metalMaidensManager->get_category($key);
				if (in_array($key, $pw_nations))
					$tank_list[$key] = $metalMaidensManager->get_nation($key);
			}

			if (isset($tank_list) && !empty($tank_list))
			{
				foreach ($tank_list as $key => $value)
				{
					foreach ($value as $tank)
						$results[] = $tank;
				}
				if (isset($results) && !empty($results))
					$results = array_unique($results);
			}
		}
	}

	// If still no result
	if ($results == NULL)
	{
		$results = $metalMaidensManager->get_like_name($search);
	}

	if ( $results )
	{
		// Remove hidden metal maidens
		for ( $i = 0; $i < count( $results ); $i++ )
		{
			if ( $results[ $i ]->getHidden() == TRUE )
			{
				unset( $results[ $i ] );
			}
		}

		// Normalize integer keys
		$results = array_values( $results );
	}
}
?>