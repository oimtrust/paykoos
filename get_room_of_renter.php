<?php 
	require_once('dbconfig.php');

	$db 	= new Database();
	$conn	= $db->dbConnection();
	//Meload data dari room sebagai data combobox ketika memilih combobox renter
	if ($_POST['id_renter']) {
		$id_renter = $_POST['id_renter'];

		$query = $conn->prepare(
				"SELECT room.id_room, room.room_name FROM tbl_renter AS rent 
				LEFT JOIN tbl_rooms AS room ON rent.id_room = room.id_room WHERE
				rent.id_renter=:id_renter"
			);
		$query->execute();
		?>
		<option selected="selected">--Select Room--</option>
		<?php
		while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
			?>
			<option value="<?php echo $row['id_room']; ?>"><?php echo $row['room_name']; ?></option>
			<?php
		}
	}
 ?>