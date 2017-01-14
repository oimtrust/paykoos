<?php 
	require_once 'app/config/session.php';
	require_once 'app/config/class.owner.php';
	require_once 'app/fpdf/class.pdf.php';

	$auth_owner	= new OWNER();

	$id_owner	= $_SESSION['user_session'];

	$stmt	= $auth_owner->runQuery("SELECT * FROM tbl_owner WHERE id_owner=:id_owner");
	$stmt->execute(array(":id_owner"=>$id_owner));

	$ownerRow=$stmt->fetch(PDO::FETCH_ASSOC);

	//for reporting
	$stmtReport	= $auth_owner->runQuery("SELECT
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
					WHERE owner.id_owner='$ownerRow[id_owner]'");
	$stmtReport->execute();
	
	$pdf 	= new PDF('L','mm',array(297,210));
	$pdf->AddPage();
	foreach ($stmtReport as $row) {
		$pdf->SetFont('Arial','',8);
		$pdf->Ln();
		foreach ($row as $column) {
			$pdf->Cell(23,10,$column,1);
		}
	}
	$pdf->Output();
 ?>