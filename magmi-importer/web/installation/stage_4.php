<?php 
/*
	File: 	stage_4.php 
	Version: 1.0

*/

function step_4(){
?>
	<div class="actions-bg-left">
	<div class="actions-bg-right">
	<div class="actions-bg-top">
	<div class="actions-bg-bottom">
	<div class="actions-top-left">
	<div class="actions-top-right">
	<div class="actions-bottom-left">
	<div class="actions-bottom-right">
	<div class="step_content" style="min-height:208px;">
		<h1>Congratulations!</h1>
		<p class="step-finish">Magmi has been installed &amp; configured</p>
		<p><span class="login-label">You can now</span><a class="login-here" href="../magmi.php">login here</a> </p>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	
<?php 
	session_destroy();
}