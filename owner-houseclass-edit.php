<?php 
	//error_reporting( ~E_NOTICE );
	require_once 'app/config/session.php';
	require_once 'app/config/class.owner.php';

	$auth_owner	= new OWNER();

	$id_owner	= $_SESSION['user_session'];

	$stmt	= $auth_owner->runQuery("SELECT * FROM tbl_owner WHERE id_owner=:id_owner");
	$stmt->execute(array(":id_owner"=>$id_owner));

	$ownerRow=$stmt->fetch(PDO::FETCH_ASSOC);

	//Form for edit
	if (isset($_GET['id_class']) && !empty($_GET['id_class'])) {
		$id_class 	= $_GET['id_class'];
		$stmt_edit	= $auth_owner->runQuery("SELECT id_owner, class_name, price FROM tbl_class WHERE id_class =:id_class");
		$stmt_edit->execute(array(":id_class"=>$id_class));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
	}
	else {
		$auth_owner->redirect('owner-house.php');
	}

	//For save edit data classrom
	if (isset($_POST['btn-save-classroom-update'])) {
		$owner = $_POST['id_owner'];
		$cname = $_POST['class_name'];
		$price = $_POST['price'];

		if ($cname == "") {
			$error[] = "Provide Class Name";
		}
		elseif ($price == "") {
			$error[] = "Provide Price";
		}
		else {
			try {
				if ($auth_owner->updateClass($owner, $cname, $price, $id_class)) {
					$auth_owner->redirect('owner-house.php?saved');
					
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	//Showing views
	include 'app/view/header.php';
	include 'app/view/owner/menu-owner.php';
	include 'app/view/owner/houseclass-owner-edit.php';
	include 'app/view/footer.php';
 ?>