<?php
	require_once 'app/config/session.php';
	require_once 'app/config/class.owner.php';
	
	$auth_owner	= new OWNER();

	$id_owner	= $_SESSION['user_session'];

	$stmt	= $auth_owner->runQuery("SELECT * FROM tbl_owner WHERE id_owner=:id_owner");
	$stmt->execute(array(":id_owner"=>$id_owner));

	$ownerRow=$stmt->fetch(PDO::FETCH_ASSOC);

	//for choosing the room by combobox
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

	if (isset($_POST['btn-save-addrenter'])) {
		$fname	 = strip_tags($_POST['fullname']);
		$gender	 = strip_tags($_POST['gender']);
		$father	 = strip_tags($_POST['father']);
		$mother	 = strip_tags($_POST['mother']);
		$phone	 = strip_tags($_POST['phone']);
		$address = strip_tags($_POST['address']);
		$irole	 = strip_tags($_POST['id_role']);
		$iowner	 = strip_tags($_POST['id_owner']);
		$iroom	 = strip_tags($_POST['id_room']);

		if ($fname == "") {
			$error[]	= "Provide Fullname";
		}
		elseif ($gender == "") {
			$error[]	= "Provide Gender";
		}
		elseif ($father == "") {
			$error[]	= "Provide Father";
		}
		elseif ($mother == "") {
			$error[]	= "Provide Mother";
		}
		elseif ($phone == "") {
			$error[]	= "Provide Phone";
		}
		elseif (strlen($phone) > 14) {
			$error[]	= "Sorry, phone not valid!";
		}
		elseif ($address == "") {
			$error[]	= "Provide Address";
		}
		else {
			try {
				if ($auth_owner->saveRenter($fname,$gender,$father,$mother,$phone,$address,$irole,$iowner,$iroom)) {
					$auth_owner->redirect('owner-renter-add.php?saved');
				}
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
	}
	
	//Menampilkan view
	include 'app/view/header.php';
	include 'app/view/owner/menu-owner.php';
	include 'app/view/owner/renter-owner-add.php';
	include 'app/view/footer.php';
 ?>