<?php 
if(!defined('valid_php')) {
   die('Direct access not permitted');
}

/*
	User login details
*/
$userinfo = array(
	 'username' => 'magmifabelio',
	 'password' => 'magmi#123'
);
$ue_magmi_theme_version	= "1.1";
//print_r($_SESSION);
/*
$userinfo = array(
	 'username' => '% admin_name %',
	 'password' => '% admin_password %'
);
*/
$error_message = "";
/*
	Used to redirect an user with a non-installed version to the installer script
	
*/

if ( 	$userinfo['username'] == "%"."admin_name"."%" || 
		$userinfo['password'] == "%"."admin_password"."%"	
		) {
	
	$full_dir 	=  dirname(__FILE__);	// /httpdocs/magmi-importer/web/installation
	
	if( file_exists( $full_dir . "/installation/installed.txt" ) )
		unlink( $full_dir . "/installation/installed.txt" );
	
	header('Location: installation/index.php');
	exit;
}

// And also to catch someone using the default user name/password as well
if ( 	isset( $_POST['username'] ) &&
		isset( $_POST['password'] ) &&
		( trim( $_POST['username'] ) == "%"."admin_name"."%" || trim( $_POST['password'] ) == "%"."admin_password"."%" )
	) {
	// Now that was naughty, not even going to humour it with a message
	exit;
}
/*
	Logout
	http://stackoverflow.com/questions/1381205/easy-login-script-without-database
*/
if( isset( $_GET['logout'] ) && $_GET['logout'] == 1 ) {
    unset( $_SESSION['username'] );
    unset( $_SESSION['password'] );
    unset( $_SESSION['last_runned_profile'] );
	//session_destroy();
	//echo "hji!";
    //header('Location:  ' . 'magmi.php');
    header('Location:  ' . $_SERVER['PHP_SELF']);
}

/*
	login script
*/
if( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {

	// we have a login request
	
	if( $userinfo['username'] == $_POST['username'] && $userinfo['password'] == $_POST['password']) {
        $_SESSION['username'] = $userinfo['username'];
		//echo "howdy!";
	} else {
		$error_message = '<div class="messages"><span><span style="font-weight:bold; color:#C31F2A;">Oh Snap!</span> Your login details are incorrect.</span></div>';
		do_login_page( $error_message );
		exit;
	}

} else if( isset( $_SESSION['username'] ) && trim( $_SESSION['username'] ) != "" ) {
		
} else {
	do_login_page( $error_message );
	exit;
}
/*
if( 
	( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) ||
	(  )
	
) {
    if( $userinfo['username'] == $_POST['username'] && $userinfo['password'] == $_POST['password']) {
        $_SESSION['username'] = $_POST['username'];
		
		
    } else {
	
	
        //Invalid Login
		$error_message = '<div class="messages"><span><span style="font-weight:bold; color:#C31F2A;">Oh Snap!</span> Your login details are incorrect.</span></div>';
		//echo "hi here 2!";
		
		
		//exit;
    }
} else {
	do_login_page( $error_message );
	exit;
}
*/
/*	
	login function
*/
function do_login_page( $error_message=null ) {

	echo '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
			"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<title>Login</title>
			<link rel="stylesheet" href="css/magmi.css"></link>
			<link rel="shortcut icon" href="favicon.ico" />
		</head>
		<body id="login-page">
			<div class="wrapper">
				<div class="magmi-page">
					<div class="magmi-content" style="min-height:320px;">
		';
						/*
						if( isset( $_SESSION['username'] ) && $_SESSION['username'] ) {
						echo '
							<p>You are logged in as <?=$_SESSION['username']?></p>
							<p><a href="?logout=1">Logout</a></p>';
						}
						*/
						echo '
						<div class="login-content">
						<div class="login-form">
						';
						echo $error_message;
						echo '
							<form name="login" action="" method="post" id="loginForm">
								<input type="text" class="username" name="username" placeholder="Username" value="" /><br />
								<input type="password" class="password" name="password" placeholder="Password" value="" /><br />
								<input type="submit" name="submit" class="form-button" value="Submit" />
							</form>
							<p class="forget-pass"><a href="http://understandinge.com/guides/magmi/magmi-installation-wizard-help-page/#login_problems" target="_blank">Need help? / Forgot Password</a></p>
						</div>
						</div>
					</div>
				</div>
			</div>
		</body>
	</html>';
}