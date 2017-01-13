<?php
	require_once 'app/config/class.owner.php';

	$auth_owner	= new OWNER();

	if ($_POST['id_room']) {
		$id_room = $_POST['id_room'];
		$stmt = $auth_owner->runQuery("SELECT * FROM tbl_renter WHERE id_room=:id_room");
		$stmt->execute(array(':id_room' => $id_room));
		?>
		<option selected="selected">--Select Renter--</option><?php
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
			<option value="<?php echo $row['id_renter']; ?>"><?php echo $row['fullname']; ?></option>
			<?php
		}
	}
 ?>