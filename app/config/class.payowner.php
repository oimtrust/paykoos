<?php 
	require_once('dbconfig.php');

	require_once 'app/config/class.owner.php';
	
	$auth_owner	= new OWNER();

	$id_owner	= $_SESSION['user_session'];

	$stmt	= $auth_owner->runQuery("SELECT * FROM tbl_owner WHERE id_owner=:id_owner");
	$stmt->execute(array(":id_owner"=>$id_owner));

	$ownerRow=$stmt->fetch(PDO::FETCH_ASSOC);

	//For showing data for table
	$db 	= new Database();
	$conn	= $db->dbConnection();
	//$conn->prepare($sql);

	$start 			= 0;
	$page_counter	= 0;
	$per_page		= 5;
	$next			= $page_counter + 1;
	$previous		= $page_counter - 1;

	if (isset($_GET['start'])) {
		$start			= $_GET['start'];
		$page_counter	= $_GET['start'];
		$start			= $start * $per_page;
		$next			= $page_counter + 1;
		$previous		= $page_counter - 1;
	}

	$sql 	= "SELECT
						pay.id_payment,
						renter.fullname,
						room.room_name,
						pay.date_trans,
						pay.total_month,
						pay.payment,
						pay.total
					FROM
						tbl_payment AS pay
						LEFT JOIN tbl_renter AS renter ON pay.id_renter = renter.id_renter
						LEFT JOIN tbl_rooms AS room ON pay.id_room = room.id_room
						LEFT JOIN tbl_owner AS owner ON room.id_owner = owner.id_owner
					WHERE owner.id_owner='$ownerRow[id_owner]' LIMIT $start, $per_page";
    $query	= $conn->prepare($sql);
    $query->execute();

    //placeholder variable to store result
    $result	= null;

    if ($query->rowCount() == 0) {
    	
    }
    else {
    	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    		// store each row in result variable
    		$result[] = $row['fullname']." ". $row['gender']." ". $row['father']." ". $row['mother']." ". $row['phone']." ". $row['address'];
    	}
    }

    // query to get total number of rows in messages table
    $count_query = "SELECT
						pay.id_payment,
						renter.fullname,
						room.room_name,
						pay.date_trans,
						pay.total_month,
						pay.payment,
						pay.total
					FROM
						tbl_payment AS pay
						LEFT JOIN tbl_renter AS renter ON pay.id_renter = renter.id_renter
						LEFT JOIN tbl_rooms AS room ON pay.id_room = room.id_room
						LEFT JOIN tbl_owner AS owner ON room.id_owner = owner.id_owner
					WHERE owner.id_owner='$ownerRow[id_owner]'";
	$query = $conn->prepare($count_query);

	$query->execute();
	$count = $num_rows = $query->rowCount();

	$paginations	= ceil($count / $per_page);
 ?>