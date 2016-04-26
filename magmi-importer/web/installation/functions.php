<?php 
/*
	File: 	functions.php 
	Version: 1.0

*/
function show_progress( $step ) {
?>
	<div class="grid_2 progress">
		
		<!--This is the side menu and we are at stage <?php //echo $step; ?>.-->
		
		<div class="stage-1 <?php ( $step == 1 ? print ' stage_on' : '') ?>">
			
		</div>
		
		<div class="stage-2 <?php ( $step == 2 ? print ' stage_on' : '') ?>">
			
		</div>
		
		<div class="stage-3 <?php ( $step == 3 ? print ' stage_on' : '') ?>">
			
		</div>
		
		<div class="stage-4 <?php ( $step == 4 ? print ' stage_on' : '') ?>">
			
		</div>
		
		<div class="stage-help">
			<h3>Help?!</h3>
			<p>See the <a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/" target="_blank">full guide here</a>.</p>
		</div>
	
	</div><!-- /progress -->

	<div class="grid_9 actions">
		<div class="step-content">
<?php 
}
/*
	check_installed_file_exists()
	Returns true if installed.txt is present
*/
function check_installed_file_exists( $step=null ) {

	// added to get past step 4 redirecting
	if( $step == 4 )
		return false;

	// get current directory 
	$full_dir 	=  dirname(__FILE__);	// /httpdocs/magmi-importer/web/installation
	$temp 		= explode('/', $full_dir);
	array_pop($temp);
	$web_dir	= implode('/', $temp );	// /httpdocs/magmi-importer/web/
	
	if( file_exists( $web_dir . "/installed.txt" ) )
		return true;
	
	// Else
	return false;

}
