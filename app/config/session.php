<?php 
	session_start();

	require_once 'class.owner.php';
	$session = new OWNER();

	if (!$session->is_loggedin()) {
		$session->redirect('login.php');
	}
 ?>