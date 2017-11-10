<form class="form-horizontal" action="index.php?route=reddit_flairs" method="post">
	<input type="hidden" name="generate" value="true">
	<input type="submit" value="Generate flairs" />
</form>
<?php
date_default_timezone_set('UTC');

$metalMaidensManager = new MetalMaidensManager($dbhandler);
$tanks = $metalMaidensManager->get_all();

usort($tanks, 'cmp_root_head_id_asc');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST' && $_POST["generate"] == "true")
{
	$zip = new ZipArchive();
	$zip_path = ASSETS_DIR . "images/reddit_flairs/output/" . "flairs_1.10.1.5_" . date('YF') . ".zip";

	if ($zip->open($zip_path, ZipArchive::CREATE)!==TRUE) {
	 	exit("Impossible d'ouvrir le fichier <$zip_path>\n");
	 }

	echo "Zip file below generated on " . date('l jS \of F Y h:i:s A') . " with game's version : 1.10.1.5<br />";
	echo "<a href=" . $zip_path . ">Download flairs by clicking this link</a><br /><br />";

	$last_id = 0;
	$number_of_flairs = 0;

	foreach ($tanks as $tank)
	{
		if ($tank->getRoot_head_id() != 0 && $tank->getRoot_head_id() != $last_id)
		{
			?>
			<img
				<?php if ($tank->getRoot_head_id() < 10) { ?>
				src="<?php echo TANKS_DIR . "rectangle/root-head_rectangle-0" . $tank->getRoot_head_id(); ?>.png";
				<?php } else { ?>
				src="<?php echo TANKS_DIR . "rectangle/root-head_rectangle-" . $tank->getRoot_head_id(); ?>.png";
				<?php } ?>
				alt="<?php echo $tank->getTank(); ?> flair"
				style="display: inline-block;"
			/>
			<?php
			$filename = $tank->getTank();
			$filename = str_replace("/", "-", $filename);
			$filename = str_replace(".", "-", $filename);
			$filename = str_replace("_", "-", $filename);
			$filename = str_replace(" ", "-", $filename);
			$filename = str_replace("ü", "u", $filename);
			$filename = str_replace("(", "-", $filename);
			$filename = str_replace(")", "-", $filename);
			$filename = str_replace("---", "-", $filename);
			$filename = str_replace("--", "-", $filename);
			$filename = rtrim($filename, "-");

			if ($tank->getRoot_head_id() < 10)
				$filepath = TANKS_DIR . "rectangle/root-head_rectangle-0" . $tank->getRoot_head_id() . ".png";
			else
				$filepath = TANKS_DIR . "rectangle/root-head_rectangle-" . $tank->getRoot_head_id() . ".png";
			$newfilepath = ASSETS_DIR . "images/reddit_flairs/" . $filename . ".png";
			
			echo $tank->getRoot_head_id() . " : " . $filename;

			if (!copy($filepath, $newfilepath)) { echo "failed to copy"; }
			$zip->addFile($newfilepath);

			echo "<br />";
		}
		$last_id = $tank->getRoot_head_id();
	}

	$additional_files_array = array(
		"197" => "Coming-Soon",
		"215" => "Male-Commander",
		"229" => "Female-Commander"
	);

	foreach ($additional_files_array as $key => $value) {
		$filepath = TANKS_DIR . "rectangle/root-head_rectangle-" . $key . ".png";
		$newfilepath = ASSETS_DIR . "images/reddit_flairs/" . $value . ".png";

		?>
		<img
			src="<?php echo TANKS_DIR . "rectangle/root-head_rectangle-" . $key; ?>.png";
			alt="<?php echo $value; ?> flair"
			style="display: inline-block;"
		/>
		<?php
		echo $key . " : " . $value . "<br />";

		if (!copy($filepath, $newfilepath)) { echo "failed to copy"; }
		$zip->addFile($newfilepath);
	}

	$zip->close();
}
?>