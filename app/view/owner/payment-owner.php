<!-- Page Content -->
<div class="container">
	<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Payment
                </h1>
                <ol class="breadcrumb">
                    <li><a href="owner-index.php">Home</a>
                    </li>
                    <li class="active">Payment</li>
                </ol>
            </div>
        </div>
    <!-- end page heading -->

    <!-- Detail Content Renter -->
    <div class="row">
    	<div class="col-lg-12">
            <h2 class="page-header">Your Transaction</h2>
        </div>
        
        <div class="row">
        	<div class="col-lg-12">
	        	<div class="col-md-4">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-info" name="btn-addrenter" onclick="location.href='owner-payment-add.php'">Add Payment</button>
                        <button type="submit" class="btn btn-warning" name="btn-report" onclick="location.href='owner-payment-report.php'">Print Report</button>
                    </div>	            	
	            </div>
	        </div>
        </div>

        <div class="col-lg-12">
            <h2 class="breadcrumb"></h2>
        </div>

        <div class="col-lg-12">
        	<div class="table-responsive">
        		<table id="data" class="table table-striped table-bordered table-hover">
        			<thead>
        				<tr>
        					<th>No.</th>
        					<th>Nama Penyewa</th>
        					<th>Nama Ruang</th>
        					<th>Tanggal Transaksi</th>
        					<th>Total Bulan</th>
        					<th>Dibayar</th>
        					<th>Total</th>
        				</tr>
        			</thead>
        			<tbody>
        				<?php 
                            $i = 1; ?>
                            <tr>
                                <?php 
                                    for ($j=0; $j < count($result); $j++) { 
                                        echo "<td>".$i++."</td>" ;
                                        echo $result[$j] ."</tr>";
                                    }
                                    $i++;
                                 ?>
                            </tr>
        			</tbody>
        		</table>
        	</div>
            <nav aria-label="...">
                <ul class="pagination pagination-lg">
                    <?php 
                        if ($page_counter == 0) {
                            echo "<li><a href=?start='0' class='active'>0</a></li>";
                            for ($k=1; $k < $paginations; $k++) { 
                                echo "<li><a href=?start=$k>".$k."</a></li>";
                            }
                        }
                        else {
                            echo "<li><a href=?start=$previous>Previous</a></li>";
                            for ($k=0; $k < $paginations; $k++) { 
                                if ($k == $page_counter) {
                                    echo "<li><a href=?start=$k class='active'>".$k."</a></li>";
                                }
                                else {
                                    echo "<li><a href=?start=$k>".$k."</a></li>";
                                }
                            }
                            if ($k != $page_counter + 1) {
                                echo "<li><a href=?start=$next>Next</a></li>";
                            }

                        }
                     ?>
                </ul>
            </nav>
        </div>
    </div>
    <!-- End Detail Content Renter -->
</div>
<!-- End Page Content -->