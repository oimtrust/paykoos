<?php 
	require_once('dbconfig.php');

	require_once 'class.owner.php';
	
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
	renter.id_renter,
	renter.fullname,
	renter.gender,
	renter.father,
	renter.mother,
	renter.phone,
	renter.address,
	owner.id_owner,
	room.room_name
FROM
	tbl_renter AS renter LEFT JOIN tbl_owner as owner ON renter.id_owner = owner.id_owner
	LEFT JOIN tbl_rooms AS room ON renter.id_room = room.id_room
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
    		$result[] = "<td>".$row['fullname']."</td> <td>".$row['gender']."</td><td> ". $row['father']."</td><td>". $row['mother']."</td><td>". $row['phone']."</td><td>". $row['address'] ."</td><td>". $row['room_name']."</td><td>
                                                                    <a class='btn btn-info' href='owner-renter-edit.php?edit_idrenter=".$row['id_renter']."' title='Click For Edit'><span class='glyphicon glyphicon-edit'></span> Edit</a>
                                                                    <a class='btn btn-danger' href='?delete_idrenter=".$row['id_renter']."' title='Click For Delete'><span class='glyphicon glyphicon-remove-circle'></span> Delete</a>
                                                                </td>";
    	}
    }

    // query to get total number of rows in messages table
    $count_query = "SELECT
    renter.id_renter,
	renter.fullname,
	renter.gender,
	renter.father,
	renter.mother,
	renter.phone,
	renter.address,
	owner.id_owner,
	room.room_name
FROM
	tbl_renter AS renter LEFT JOIN tbl_owner as owner ON renter.id_owner = owner.id_owner
	LEFT JOIN tbl_rooms AS room ON renter.id_room = room.id_room
WHERE owner.id_owner='$ownerRow[id_owner]'";
	$query = $conn->prepare($count_query);

	$query->execute();
	$count = $num_rows = $query->rowCount();

	$paginations	= ceil($count / $per_page);
 ?>