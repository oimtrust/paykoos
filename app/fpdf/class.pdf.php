<?php 
	require 'fpdf.php';

	/**
	* PDF Class
	*/
	class PDF extends FPDF
	{
		
		function Header()
		{
			$this->SetFont('Arial', 'B', 15);

			//move to the right
			$this->Cell(117);

			//Title
			$this->Cell(30,10,'Laporan Keuangan Kos',0,'C');

			//Line break
			$this->Ln(20);
		}

		

		function Footer()
		{
			// Position at 1.5 cm from bottom
		    $this->SetY(-15);
		    // Arial italic 8
		    $this->SetFont('Arial','I',8);
		    // Page number
		    $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}
 ?>