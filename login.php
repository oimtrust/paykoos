<?php
	session_start();
	require_once 'app/config/class.owner.php';
	$login = new OWNER();

	if ($login->is_loggedin()!="") {
		$login->redirect('owner-index.php');
	}

	if (isset($_POST['btn-login'])) {
		$uname	= strip_tags($_POST['username']);
		$umail	= strip_tags($_POST['username']);
		$upass	= strip_tags($_POST['password']);

		if ($login->doLogin($uname,$umail,$upass)) {
			$login->redirect('owner-index.php');
		} else {
			$error	= "Wrong Details !";
		}
	}

	include 'app/view/header.php';
	include 'app/view/menu.php';
	include 'app/view/auth/login.php';
	include 'app/view/footer.php'; 
 ?>