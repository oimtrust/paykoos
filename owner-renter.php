<?php
	require_once 'app/config/session.php';
	require_once 'app/config/class.owner.php';
	require_once 'app/config/class.prentowner.php';
	
	$auth_owner	= new OWNER();

	$id_owner	= $_SESSION['user_session'];

	$stmt	= $auth_owner->runQuery("SELECT * FROM tbl_owner WHERE id_owner=:id_owner");
	$stmt->execute(array(":id_owner"=>$id_owner));

	$ownerRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
	//Menampilkan view
	include 'app/view/header.php';
	include 'app/view/owner/menu-owner.php';
	include 'app/view/owner/renter-owner.php';
	include 'app/view/footer.php';
 ?>