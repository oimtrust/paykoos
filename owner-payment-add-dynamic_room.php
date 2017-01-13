<?php 
	require_once 'app/config/class.owner.php';

	$auth_owner	= new OWNER();

	if ($_POST['id']) {
		$iclass = $_POST['id'];
		$stmt	= $auth_owner->runQuery("SELECT * FROM tbl_rooms WHERE id_room=:id");
		$stmt->execute(array(':id' => $iclass));
		$dataRuang	= [];

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$ruang = [];
			$ruang['id_room']	= $row['id_room'];
			$ruang['room_name']	= $row['room_name'];

			$dataRuang[]	= $ruang;
		}

		
		$stmt				= $auth_owner->runQuery("SELECT cls.price FROM tbl_class AS cls WHERE id_class=:id");
		$stmt->execute(array(':id' => $iclass));
		
		$getHargaKelas		= [];

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$getHargaKelas = $row['price'];

		$returnData = [
			'price'		=> $getHargaKelas,
			'room_name'	=> $dataRuang
		];
		echo json_encode($returnData);
	}

	/**
	* Old data
	*/
	/**
	// if ($_POST['id']) {
	// 	$iclass = $_POST['id'];
	// 	$stmt = $auth_owner->runQuery("SELECT * FROM tbl_rooms WHERE id_room=:id");
	// 	$stmt->execute(array(':id' => $iclass));
	 	?>
	 	<!--
	 	<option selected="selected">--Select Room--</option>
	 	-->
	 	<?php
	// 	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	 		?>
			<!--
	 		<option value="<?php echo $row['id_room']; ?>"><?php echo $row['room_name']; ?></option>
			-->
	 		<?php
	// 	}
	// }

	*/

 ?>