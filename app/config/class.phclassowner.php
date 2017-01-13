<?php 
	require_once('dbconfig.php');
	
	//for showing data for table
	$db 	= new Database();
	$conn 	= $db->dbConnection();

	//get id owner from user session
	$id_owner = $_SESSION['user_session'];
	$sql = "SELECT * FROM tbl_owner WHERE id_owner=:id_owner";
	$query = $conn->prepare($sql);
	$query->execute(array(":id_owner"=>$id_owner));
	$ownerRow = $query->fetch(PDO::FETCH_ASSOC);

	$start 			= 0;
	$page_counter	= 0;
	$per_page		= 5;
	$next 			= $page_counter + 1;
	$previous		= $page_counter - 1;

	if (isset($_GET['start'])) {
		$start 			= $_GET['start'];
		$page_counter	= $_GET['start'];
		$start			= $start * $per_page;
		$next 			= $page_counter + 1;
		$previous		= $page_counter - 1;
	}

	$sql = "SELECT
				cla.id_class,
				own.id_owner,
				cla.class_name,
				cla.price
			FROM tbl_owner AS own
				LEFT JOIN tbl_class AS cla ON cla.id_owner = own.id_owner
			WHERE own.id_owner='$ownerRow[id_owner]' LIMIT $start, $per_page";
	$query = $conn->prepare($sql);
	$query->execute();

	//placeholder variable to store result
	$resultClass = null;

	if ($query->rowCount() == 0) {
	}
	else {
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			//store each row in resultClass variable
			$resultClass[] = "<td>".$row['class_name']."</td><td>".$row['price']."</td><td>
                                                                    <a class='btn btn-info' href='owner-houseclass-edit.php?id_class=".$row['id_class']."' title='Click For Edit'><span class='glyphicon glyphicon-edit'></span> Edit</a>
                                                                    <a class='btn btn-danger' href='?delete_idclass=".$row['id_class']."' title='Click For Delete'><span class='glyphicon glyphicon-remove-circle'></span> Delete</a>
                                                                </td>";
		}
	}

	//query to get total number of rows in messages table
	$count_query = "SELECT
						cla.id_class,
						own.id_owner,
						cla.class_name,
						cla.price
					FROM tbl_owner AS own
						LEFT JOIN tbl_class AS cla ON cla.id_owner = own.id_owner
					WHERE own.id_owner='$ownerRow[id_owner]'";

	$query = $conn->prepare($count_query);
	$query->execute();
	
	$count = $num_rows = $query->rowCount();
	$paginations_class = ceil($count / $per_page);
 ?>