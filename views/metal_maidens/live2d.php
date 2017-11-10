<h1 class="page-header"><?php echo $view_tank->getTank(); ?> <small><?php echo $view_tank->getName(); ?></small></h1>
<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">See profile</button></a>
<a href="<?php echo link_to_route("metal_maiden_tree") . "&amp;tank=" . $view_tank->getTank_slug(); ?>"><button type="button">See R&amp;D tree</button></a>


	<?php
	if ($view_tank->getLive2d() == "0")
	{
		?>
		<div class="alert alert-warning" role="alert">
			No live2D available for this tank !
		</div>
		<?php
	}
	else if ($view_tank->getLive2d() == "1" && empty($live2d_modelname))
	{
		?>
		<div class="alert alert-warning" role="alert">
			There is a live2D for this tank but it's currently unavailable on Metal Maiden Depot, sorry !
		</div>
		<?php
	}
	else
	{
		?>
		<div class="alert alert-warning" role="alert">
			This page requires WebGL to work. (Go <a href="https://developer.mozilla.org/en-US/docs/Learn/WebGL/By_example/Detect_WebGL">here</a> and click on 'Press here to detect WebGLRenderingContext' button to check if your broswer can use WebGL)<br />
			This page may also be slow to load and you may have to scroll a bit down to see the live2D tank.<br />
			This page works great on Internet Explorer > 9, Microsoft Edge, Google Chrome (PC &amp; Smartphone versions) and some others broswers.<br />
			This page partially works on Firefox (You cannot zoom in/out).<br />
			This page does not work on Opera.<br />
		</div>

		<div class="alert alert-info" role="alert">
			Mousewheel to zoom in/out.<br />
			Left click to interact.<br />
			Use the area outside the blue box to scroll on this page if you are using your mousewheel (using the mousewheel in the blue box will only zoom in/out the Live2D render).
		</div>

		<div class="row">
			<p style="display: none;">
				<button id="btnChange" class="active"></button>
			</p>

			<p>Expressions :</p>
			<?php
			foreach ($live2d_expressions as $expression)
			{
				?>
				<button id="btnExpression<?php echo ucfirst($expression); ?>"><?php echo ucfirst($expression); ?></button>
				<?php
			}
			?>

			<p>Motions : This is currently a work in progress, when the attack motion is loaded, you will have to reload this page if you want to get the original idle motion/pose. (Try to clear the browser cache if the attack motion doesn't work)</p>
			<?php
			foreach ($live2d_motions as $motion)
			{
				?>
				<button id="btnMotion-<?php echo $motion; ?>"><?php echo str_replace('_', ' ', ucfirst($motion)); ?></button>
				<?php
			}
			?>

			<style>
			canvas {

			}
			</style>

			<div>
				<canvas id="glcanvas" width="1200px" height="1600px" 
					style="	border: 1px solid #337ab7;
							max-width: 1200px;
							width: 90%;
							height: auto;"
				>
				</canvas>
			</div>

			<div id="myconsole" style="color:#000">---- Log ----</div>

			<!-- Live2D Library -->
			<script src="lib/live2d.min.js"></script>
			<!-- Live2D Framework -->
			<script src="framework/Live2DFramework.js"></script>
			<!-- Live2D User scripts -->
			<script src="<?php echo ASSETS_DIR; ?>javascripts/live2d/utils/MatrixStack.js"></script>
			<script src="<?php echo ASSETS_DIR; ?>javascripts/live2d/utils/ModelSettingJson.js"></script>
			<script src="<?php echo ASSETS_DIR; ?>javascripts/live2d/PlatformManager.js"></script>
			<?php include(ASSETS_DIR . "javascripts/live2d/LAppDefine.php"); ?>
			<script src="<?php echo ASSETS_DIR; ?>javascripts/live2d/LAppModel.js"></script>
			<?php include(ASSETS_DIR . "javascripts/live2d/LAppLive2DManager.php"); ?>
			<script src="<?php echo ASSETS_DIR; ?>javascripts/live2d/SampleApp1.js"></script>
		</div>
	<?php
	}
	?>
