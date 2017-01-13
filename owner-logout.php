<?php 
	require_once('app/config/session.php');
	require_once('app/config/class.owner.php');

	$owner_logout	= new OWNER();

	if ($owner_logout->is_loggedin()!="") {
		$owner_logout->redirect('owner-index.php');
	}
	if (isset($_GET['logout']) && $_GET['logout']=="true") {
		$owner_logout->doLogout();
		$owner_logout->redirect('login.php');
	}
 ?>