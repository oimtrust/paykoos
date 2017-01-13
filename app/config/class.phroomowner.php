<?php 
	require_once 'dbconfig.php';

	//for showing data for table
	$db 	= new Database();
	$conn 	= $db->dbConnection();

	//get id owner from user session
	$id_owner = $_SESSION['user_session'];
	$sql = "SELECT * FROM tbl_owner WHERE id_owner=:id_owner";
	$query = $conn->prepare($sql);
	$query->execute(array(":id_owner"=>$id_owner));
	$ownerRow = $query->fetch(PDO::FETCH_ASSOC);

	$start_room 	= 0;
	$page_counter 	= 0;
	$per_page		= 3;
	$next 			= $page_counter + 1;
	$previous		= $page_counter - 1;

	if (isset($_GET['start_room'])) {
		$start_room 	= $_GET['start_room'];
		$page_counter	= $_GET['start_room'];
		$start_room		= $start_room * $per_page;
		$next 			= $page_counter + 1;
		$previous 		= $page_counter - 1;
	}

	$sql	= "SELECT
					room.id_room,
					own.id_owner,
					room.room_name,
					room.`status`,
					room.photo
				FROM
					tbl_owner AS own
					LEFT JOIN tbl_rooms AS room ON room.id_owner = own.id_owner
				WHERE
					own.id_owner = '$ownerRow[id_owner]' LIMIT $start_room, $per_page";
	$query = $conn->prepare($sql);
	$query->execute();

	$resultRoom = null;

	if ($query->rowCount() == 0) {
		
	}
	else {
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$resultRoom[]	= "<td>".$row['room_name']."</td><td>".$row['status']."</td><td><img src='photo_rooms/".$row['photo']."' class='img-rounded' width='200px' height='115px'></td><td>
                                                                    <a class='btn btn-info' href='owner-houseroom-edit.php?edit_idroom=".$row['id_room']."' title='Click For Edit'><span class='glyphicon glyphicon-edit'></span> Edit</a>
                                                                    <a class='btn btn-danger' href='?delete_idroom=".$row['id_room']."' title='Click For Delete'><span class='glyphicon glyphicon-remove-circle'></span> Delete</a>
                                                                </td>";
		}
	}

	$count_query = "SELECT
						room.id_room,
						own.id_owner,
						room.room_name,
						room.`status`,
						room.photo
					FROM
						tbl_owner AS own
						LEFT JOIN tbl_rooms AS room ON room.id_owner = own.id_owner
					WHERE
						own.id_owner = '$ownerRow[id_owner]'";
				
	$query = $conn->prepare($count_query);
	$query->execute();
	$count = $num_rows = $query->rowCount();

	$paginations_room = ceil($count / $per_page);
 ?>