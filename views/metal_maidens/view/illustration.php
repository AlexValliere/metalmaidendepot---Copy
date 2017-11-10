<?php
$filename = TANKS_DIR . "full/" . $view_tank->getImagename() . ".png";
$live2d_filename = TANKS_DIR . "full/live2d/" . $view_tank->getImagename() . ".png";

if ( !( file_exists(utf8_decode($filename)) || file_exists(urldecode($filename)) ) && ( file_exists(utf8_decode($live2d_filename)) || file_exists(urldecode($live2d_filename)) ) )
	echo '<div class="col-lg-10 col-lg-offset-1" style="background-color: #000000;">';
else
	echo '<div class="col-lg-10 col-lg-offset-1">';
?>

<h4>Illustration :</h4>

<?php
if ( file_exists(utf8_decode($filename)) || file_exists(urldecode($filename)) )
{
	if ( !file_exists(utf8_decode($filename)) )
		$filename = urldecode($filename);
	echo '<img src="' . $filename . '" alt="' . $view_tank->getTank() . ' official artwork" class="img-responsive" />';
	echo '<p style="padding-top: 15px;">Official artwork</p>';
}

else if ( file_exists(utf8_decode($live2d_filename)) || file_exists(urldecode($live2d_filename)) )
{
	if ( !file_exists(utf8_decode($live2d_filename)) )
		$live2d_filename = urldecode($live2d_filename);
	echo '<img src="' . $live2d_filename . '" alt="' . $view_tank->getTank() . ' illustration captured from her Live2D" class="img-responsive" />';
	echo '<p style="padding-top: 15px;">Illustration captured from her Live2D</p>';
}
?>

</div>