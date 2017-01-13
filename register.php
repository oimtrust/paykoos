<?php
	session_start();
	require_once 'app/config/class.owner.php';
	$owner	= new OWNER();

	if ($owner->is_loggedin()!="") {
		$owner->redirect('index-owner.php');
	}
	if (isset($_POST['btn-signup'])) {
		$uname		= strip_tags($_POST['username']);
		$upass		= strip_tags($_POST['password']);
		$umail		= strip_tags($_POST['email']);
		$ufname		= strip_tags($_POST['fullname']);
		$gender		= strip_tags($_POST['gender']);
		$phone		= strip_tags($_POST['phone']);
		$address	= strip_tags($_POST['address']);
		$role		= strip_tags($_POST['id_role']);

		if ($uname == "") {
			$error[]	= "Provide Username!";
		}
		elseif ($umail == "") {
			$error[]	= "Provide Email ID!";
		}
		elseif (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
			$error[]	= "Please enter valid email address!";
		}
		elseif ($upass == "") {
			$error[]	= "Provide Password!";
		}
		elseif ($phone == "") {
			$error[] 	= "Provide Phone";
		}
		elseif (strlen($upass) < 6) {
			$error[] 	= "Password must be atleast 6 characters";
		}
		elseif (strlen($phone) > 14) {
			$error[]	= "Phone not valid!";
		}
		else {
			try {
				$stmt = $owner->runQuery("SELECT username, email FROM tbl_owner WHERE username=:uname OR email=:umail");
				$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
				$row=$stmt->fetch(PDO::FETCH_ASSOC);

				if ($row['username'] == $uname) {
					$error[]  = "Sorry username already taken!";
				}
				elseif ($row['email'] == $umail) {
					$error[]  = "Sorry email id already taken!";
				}
				else {
					if ($owner->register($uname,$upass,$umail,$ufname,$gender,$phone,$address,$role)) {
						$owner->redirect('register.php?joined');
					}
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
	
	//Menampilkan Tampilan UI
	include 'app/view/header.php';
	include 'app/view/menu.php';
	include 'app/view/auth/register.php';
	include 'app/view/footer.php'; 
 ?>