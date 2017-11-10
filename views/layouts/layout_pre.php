<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php if (isset($route_title) && !empty($route_title)) echo $route_title . " - "; echo PROJECT_NAME; ?>, a Panzer Waltz database</title>

		<meta name="description" content="A database about metal maidens from the mobile game Panzer Waltz" />
		<meta name="keywords" content="metal maiden, tank, database, panzer waltz, mobile game" />

		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="<?php echo ASSETS_DIR . "stylesheets/ie10-viewport-bug-workaround.css"; ?>" rel="stylesheet">
		<link href="<?php echo ASSETS_DIR . "stylesheets/dashboard.css"; ?>" rel="stylesheet">

		<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet">

		<link rel="stylesheet" href="<?php echo ASSETS_DIR . "stylesheets/application.css"; ?>">
		<?php if (isset($routes[$route]) && get_route_css() != NULL) echo '<link rel="stylesheet" href="' . get_route_css() . '">'; ?>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body onload="sampleApp1()">
		<?php include_once(ASSETS_DIR . "javascripts/analyticstracking.php"); ?>
		<?php include(VIEWS_DIR . "layouts/header.php"); ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-md-12 main">
				<!-- <div class="alert alert-info" role="alert">
				New tanks have been added (see changelog). Old tanks will have their stats updated soon.</div> -->
				<?php include(VIEWS_DIR . "layouts/breadcrumbs.php"); ?>