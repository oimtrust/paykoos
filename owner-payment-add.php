<?php
	require_once 'app/config/session.php';
	require_once 'app/config/class.owner.php';
	
	$auth_owner	= new OWNER();

	$id_owner	= $_SESSION['user_session'];

	$stmt	= $auth_owner->runQuery("SELECT * FROM tbl_owner WHERE id_owner=:id_owner");
	$stmt->execute(array(":id_owner"=>$id_owner));

	$ownerRow=$stmt->fetch(PDO::FETCH_ASSOC);

	//for choosing the class by combobox
	$id_class = '';
	$stmt = $auth_owner->runQuery(
			"SELECT
	cls.id_class,
	cls.class_name,
	cls.price
FROM
	tbl_owner AS own
	LEFT JOIN tbl_class AS cls ON cls.id_owner = own.id_owner
WHERE
	own.id_owner='$ownerRow[id_owner]'"
		);
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$id_class .= "<option value='".$row['id_class']."'>".$row['class_name']."</option>";
		//$iclass_price .= $row['price'];
	}

	//for saving data payment
	if (isset($_POST['btn-save-addPayment'])) {
		$iroom 		= strip_tags($_POST['id_room']);
		$irenter 	= strip_tags($_POST['id_renter']);
		$date_t		= strip_tags($_POST['date_trans']);
		$tmonth		= strip_tags($_POST['total_month']);
		$pay 		= strip_tags($_POST['payment']);
		$total 		= strip_tags($_POST['total']);

		if ($iroom == "") {
			$error[]	= "Provide Room Name";
		}
		elseif ($irenter == "") {
			$error[]	= "Provide Renter Name";
		}
		elseif ($date_t == "") {
			$error[]	= "Provide Date";
		}
		elseif ($tmonth == "") {
			$error[]	= "Provide Total Month";
		}
		elseif ($pay == "") {
			$error[]	= "Provide Payment";
		}
		else {
			try {
				if ($auth_owner->savePayment($iroom,$irenter,$date_t,$tmonth,$pay,$total)) {
					$auth_owner->redirect('owner-payment-add.php?saved');
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

		
	//Menampilkan view
	include 'app/view/header.php';
	include 'app/view/owner/menu-owner.php';
	include 'app/view/owner/payment-owner-add.php';
	include 'app/view/footer.php';
 ?>