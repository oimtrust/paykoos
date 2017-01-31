<?php 
	require_once 'app/config/session.php';
	require_once 'app/config/class.owner.php';
	//require_once 'app/config/dbconfig.php';
	$auth_owner	= new OWNER();
	$id_owner	= $_SESSION['user_session'];

	$stmt	= $auth_owner->runQuery("SELECT * FROM tbl_owner WHERE id_owner=:id_owner");
	$stmt->execute(array(":id_owner"=>$id_owner));

	$ownerRow=$stmt->fetch(PDO::FETCH_ASSOC);

// sesuai kan root file mPDF anda
$nama_dokumen='paykoos-report-' . $ownerRow['fullname']; //Beri nama file PDF hasil.
define('_MPDF_PATH','app/mpdf60/'); //sesuaikan dengan root folder anda
include(_MPDF_PATH . "mpdf.php"); //includekan ke file mpdf
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
//Beginning Buffer to save PHP variables and HTML tags
ob_start();
/*include 'app/config/dbconfig.php';*/
$stmt	= $auth_owner->runQuery("SELECT
						pay.id_payment,
						renter.fullname,
						renter.gender,
						renter.mother,
						renter.phone,
						renter.father,
						renter.address,
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

$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<html>
<head>
<title>Laporan Pembayaran PAY-KOOS</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#CCCCCC">
<h1 align="center" class="style3" >Laporan Pembayaran PAY-KOOS </h1>

<table width="100%" border="1">
  <tr>
    <td align="center">Nama Penyewa</td>
    <td align="center">Nama Ruang</td>
    <td align="center">Tanggal Trans.</td>
    <td align="center">Total Bulan</td>
    <td align="center">Total Bayar</td>
  </tr>
  <tr>
    <td align="center"><?php  echo $row['fullname']; ?></td>
    <td align="center"><?php  echo $row['room_name']; ?></td>
    <td align="center"><?php  echo $row['date_trans']; ?></td>
    <td align="center"><?php  echo $row['total_month']; ?></td>
    <td align="center"><?php  echo $row['payment']; ?></td>
  </tr>
</table>
<br>

</body>
</html>
<?php
	}
	
	//Batas file sampe sini
	$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
	ob_end_clean();
	$stylesheet = file_get_contents('asset/css/bootstrap.min.css');
	//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
	$mpdf->WriteHTML($stylesheet,1);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;
?>