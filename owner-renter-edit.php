<?php
	require_once 'app/config/session.php';
	require_once 'app/config/class.owner.php';
	
	$auth_owner	= new OWNER();

	$id_owner	= $_SESSION['user_session'];

	$stmt	= $auth_owner->runQuery("SELECT * FROM tbl_owner WHERE id_owner=:id_owner");
	$stmt->execute(array(":id_owner"=>$id_owner));

	$ownerRow=$stmt->fetch(PDO::FETCH_ASSOC);

	//for editing form. get data from table
	if (isset($_GET['edit_idrenter']) && !empty($_GET['edit_idrenter'])) {
		$irenter 	= $_GET['edit_idrenter'];
		$stmt_edit	= $auth_owner->runQuery("SELECT * FROM tbl_renter WHERE id_renter =:irenter");
		$stmt_edit->execute(array('irenter'=>$irenter));
		$edit_row	= $stmt_edit->fetch(PDO::FETCH_ASSOC);
	}
	else {
		$auth_owner->redirect('owner-renter.php');
	}

	//Selectbox 
	$ops  = '';
	$stmt = $auth_owner->runQuery("SELECT
										room.id_room,
										room.room_name
									FROM
										tbl_owner AS own
										LEFT JOIN tbl_rooms AS room ON own.id_owner = room.id_owner
									WHERE
										own.id_owner='$ownerRow[id_owner]'");
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		$ops .= "<option value='" . $row['id_room'] . "'>" . $row['room_name'] . "</option>";
	}

	if (isset($_POST['btn-update-renter'])) {
		$fname 		= $_POST['fullname'];
		$gender		= $_POST['gender'];
		$father		= $_POST['father'];
		$mother		= $_POST['mother'];
		$phone 		= $_POST['phone'];
		$address	= $_POST['address'];
		$irole 		= $_POST['id_role'];
		$iowner		= $_POST['id_owner'];
		$iroom 		= $_POST['id_room'];

		if ($fname == "") {
			$error[]	= "Provide Fullname!";
		}
		elseif ($gender == "") {
			$error[]	= "Provide Gender!";
		}
		elseif ($father == "") {
			$error[]	= "Provide Father!";
		}
		elseif ($mother == "") {
			$error 		= "Provide Mother!";
		}
		elseif ($phone == "") {
			$error[]	= "Provide Phone!";
		}
		elseif (strlen($phone) > 14) {
			$error[]	= "Sorry, Phone not valid!";
		}
		elseif ($address == "") {
			$error[]	= "Provide Address";
		}
		elseif ($iroom == "") {
			$error[]	= "Provide Room Name!";
		}
		else {
			try {
				if ($auth_owner->updateRenter($fname, $gender, $father, $mother, $phone, $address, $irole, $iowner, $iroom, $irenter)) {
					$auth_owner->redirect('owner-renter.php');
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	//Menampilkan view
	include 'app/view/header.php';
	include 'app/view/owner/menu-owner.php';
	include 'app/view/owner/renter-owner-edit.php';
	include 'app/view/footer.php';
 ?>