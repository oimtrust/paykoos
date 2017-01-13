<?php
	require_once 'app/config/session.php';
	require_once 'app/config/class.owner.php';

	$auth_owner	= new OWNER();

	$id_owner	= $_SESSION['user_session'];

	$stmt	= $auth_owner->runQuery("SELECT * FROM tbl_owner WHERE id_owner=:id_owner");
	$stmt->execute(array(":id_owner"=>$id_owner));

	$ownerRow=$stmt->fetch(PDO::FETCH_ASSOC);

	//Form For Edit
	if (isset($_GET['edit_idroom']) && !empty($_GET['edit_idroom'])) {
		$iroom 			= $_GET['edit_idroom'];
		$stmt_edit		= $auth_owner->runQuery("SELECT id_owner, room_name, id_class, status, photo FROM tbl_rooms WHERE id_room =:iroom");
		$stmt_edit->execute(array(':iroom'=>$iroom));
		$edit_row		= $stmt_edit->fetch(PDO::FETCH_ASSOC);
		//extract($edit_row);
	}
	else {
		$auth_owner->redirect('owner-house.php');
	}

	$opsClass  = '';
	$stmt = $auth_owner->runQuery("SELECT
										own.id_owner,
										clas.id_class,
										clas.class_name
									FROM
										tbl_owner AS own
										LEFT  JOIN tbl_class AS clas ON own.id_owner = clas.id_owner
									WHERE own.id_owner='$ownerRow[id_owner]'");
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		$opsClass .= "<option value='" . $row['id_class'] . "'>" . $row['class_name'] . "</option>";
	}


	//Updating Data of rooms
	if (isset($_POST['btn-save-room-update'])) {
		$owner 	= $_POST['id_owner'];
		$rname 	= $_POST['room_name'];
		$iclass = $_POST['id_class'];
		$status = $_POST['status'];

		$imgFile 	= $_FILES['photo']['name'];
		$tmpDir		= $_FILES['photo']['tmp_name'];
		$imgSize	= $_FILES['photo']['size'];

		if ($owner == "") {
			$error[]	= "Something wrong with user account. Please Restart Your App and login again!";
		}
		elseif ($rname == "") {
			$error[]	= "Provide Room Name!";
		}
		elseif ($iclass == "") {
			$error[]	= "Provide Class Room!";
		}
		elseif ($status == "") {
			$error[]	= "Provide Status!";
		}
		elseif ($imgFile == "") {
			$error[]	= "Provide Photo!";
		}
		elseif ($imgFile) {
			$upload_dir 	= 'photo_rooms/'; //Upload directory
			$imgExt 		= strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));//Get image extension
			$valid_ext		= array('jpg', 'jpeg', 'png', 'gif'); //Valid extension
			$photo 			= rand(1000,1000000).".".$imgExt;

			if (in_array($imgExt, $valid_ext)) {
				if ($imgSize < 5000000) {
					unlink($upload_dir.$edit_row['photo']);
					move_uploaded_file($tmpDir,$upload_dir.$photo);
				}
				else {
					$error[]	= "Sorry, your file is too large it should be less then 5MB!";
				}
			}
			else {
				$error[]	= "Sorry, only JPG, JPEG, PNG & GIF files are allowed!";
			}
		}
		else {
			// if no image selected the old image remain as it is.
			$photo = $edit_row['photo']; //old image from database
		}
		try {
			if ($auth_owner->updateRoom($owner, $rname, $iclass, $status, $photo, $iroom)) {
				$auth_owner->redirect('owner-house.php?saved');
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	//Showing views
	include 'app/view/header.php';
	include 'app/view/owner/menu-owner.php';
	include 'app/view/owner/houseroom-owner-edit.php';
	include 'app/view/footer.php';
 ?>