<!--Page Content -->
<div class="container">
	<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Payment
                </h1>
                <ol class="breadcrumb">
                    <li><a href="owner-index.php">Home</a>
                    </li>
                    <li><a href="owner-payment.php" title="">Payment</a></li>
                    <li class="active">Add Payment</li>
                </ol>
            </div>
        </div>
    <!-- end page heading -->

    <!-- Detail Content Renter -->
    <div class="row">
    	<div class="col-lg-12">
            <h2 class="page-header">Add Your Payment</h2>
            <div class="form-group">
                <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            ?>
                            <div class="alert alert-danger alert-dismissable">
                                <?php echo $error; ?>
                            </div>
                <?php 
                        }
                    }
                    elseif (isset($_GET['saved'])) {
                    ?>
                        <div class="alert alert-info alert-dismissable">
                            Successfully saved data
                        </div>
                <?php 
                    }
                ?>
            </div>
        </div>
        
        <div class="row">
        	<div class="col-lg-12">
            <form method="post" role="form" action="" name="paymentForm">
	        	<div class="col-md-4">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nama Kelas:</label>
                            <select name="id_class" id="id_class" class="form-control">
                                <option selected="selected">--Select Class--</option>
                                <?php echo $id_class; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Harga:</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="number" name="price" id="prices" class="form-control"   onkeyup="sum();" required readonly="readonly">
                            </div>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nama Kamar:</label>
                            <select id="id_room" name="id_room" class="form-control">
                                <option selected="selected">--Select Room--</option>
                            </select>
                        </div>
                    </div>

	            	<div class="control-group form-group">
                        <div class="controls">
                            <label>Nama Lengkap:</label>
                            <select id="id_renter" name="id_renter" class="form-control">
                                <option selected="selected">--Select Renter--</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Tanggal Transaksi</label>
                            <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="input_date" data-link-format="yyyy-mm-dd">
                                <input class="form-control" size="16" type="text" name="date_trans" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <input type="hidden" id="input_date" value=""/>                            
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Total Bulan:</label>
                            <input type="number" name="total_month" id="total_month" class="form-control" onkeyup="sum();" required>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Jumlah Dibayar:</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="number" name="payment" id="payment" class="form-control"   onkeyup="sum();" required>
                            </div> 
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Total:</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" name="total" id="total" class="form-control"   readonly="readonly" required>
                            </div>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <button type="submit" name="btn-save-addPayment" class="btn btn-info form-control">Save</button>
                        </div>
                    </div>

	            </div>
            </form>
	        </div>
        </div>
    </div>
    <!-- End Detail Content Renter -->
</div>
<!-- End Page Content