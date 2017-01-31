<?php
	error_reporting( ~E_NOTICE );
	require_once 'app/config/session.php';
	require_once 'app/config/class.owner.php';
	require_once 'app/config/class.phclassowner.php';
	require_once 'app/config/class.phroomowner.php';

	$auth_owner	= new OWNER();

	$id_owner	= $_SESSION['user_session'];

	$stmt	= $auth_owner->runQuery("SELECT * FROM tbl_owner WHERE id_owner=:id_owner");
	$stmt->execute(array(":id_owner"=>$id_owner));

	$ownerRow=$stmt->fetch(PDO::FETCH_ASSOC);

	//for choosing the class by combobox
	$ops  = '';
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
		$ops .= "<option value='" . $row['id_class'] . "'>" . $row['class_name'] . "</option>";
	}

	//for delete data classrom
	if (isset($_GET['delete_idclass'])) {
		$stmt_delete = $auth_owner->runQuery("DELETE FROM tbl_class WHERE id_class=:id_class");
		$stmt_delete->bindParam(':id_class', $_GET['delete_idclass']);
		$stmt_delete->execute();

		$auth_owner->redirect('owner-house.php?deleted');
	}

	//to store data classroom
	if (isset($_POST['btn-save-classroom'])) {
		$owner 	= strip_tags($_POST['id_owner']);
		$cname 	= strip_tags($_POST['class_name']);
		$price 	= strip_tags($_POST['price']);

		if ($cname == "") {
			$error[]	= "Provide Class Name !";
		}
		elseif ($price == "") {
			$error[]	= "Provide Price !";
		}
		else {
			try {
				$stmt = $auth_owner->runQuery("SELECT class_name FROM tbl_class WHERE class_name=:cname");
				$stmt->execute(array(':cname'=>$cname));
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
					if ($auth_owner->saveClass($owner,$cname,$price)) {
						$auth_owner->redirect('owner-house.php?saved');
					}
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	//for delete data room
	if (isset($_GET['delete_idroom'])) {
		$stmt_delete = $auth_owner->runQuery("DELETE FROM tbl_rooms WHERE id_room=:iroom");
		$stmt_delete->bindParam(':iroom', $_GET['delete_idroom']);
		$stmt_delete->execute();

		$auth_owner->redirect('owner-house.php?deleted');
	}

	//to store data rooms
	if (isset($_POST['btn-save-rooms'])) {
		$owner 	= strip_tags($_POST['id_owner']);
		$rname 	= strip_tags($_POST['room_name']);
		$iclass = strip_tags($_POST['id_class']);
		$status	= strip_tags($_POST['status']);

		$imgFile 	= $_FILES['photo']['name'];
		$tmpDir		= $_FILES['photo']['tmp_name'];
		$imgSize	= $_FILES['photo']['size'];

		if ($rname == "") {
			$error[] = "Provide Room Name!";
		}
		elseif ($iclass == "") {
			$error[] = "Provide type of room!";
		}
		elseif ($status == "") {
			$error[] = "Provide status!";
		}
		elseif ($imgFile == "") {
			$error[] = "Provide photo!";
		}
		else{
			$upload_dir = 'photo_rooms/'; // upload directory
			$imgExt		= strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); //get image extension

			//valid image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

			//rename uploading image
			$photo = rand(1000,1000000).".".$imgExt;

			//allow valid image file formats
			if (in_array($imgExt, $valid_extensions)) {
				//Check file size '5MB'
				if ($imgSize < 5000000) {
					move_uploaded_file($tmpDir,$upload_dir.$photo);
				}
				else {
					$error[] = "Sorry, your file is too large!";
				}
			}
			else{
				$error[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed!";
			}
				try {
					$stmt = $auth_owner->runQuery("SELECT room_name FROM tbl_rooms WHERE room_name=:rname");
					$stmt->execute(array(':rname'=>$rname));
					$row = $stmt->fetch(PDO::FETCH_ASSOC);

					if ($row['room_name'] == $rname) {
						$error[] = "Sorry Room Name already taken!";
					}
					else {
						if ($auth_owner->saveRoom($owner,$rname,$iclass,$status,$photo)) {
							$auth_owner->redirect('owner-house.php?saved');
						}
					}
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
		}
	}

	//Showing views
	include 'app/view/header.php';
	include 'app/view/owner/menu-owner.php';
	include 'app/view/owner/house-owner.php';
	include 'app/view/footer.php';
 ?>