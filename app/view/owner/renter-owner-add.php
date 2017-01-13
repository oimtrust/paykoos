<!-- Page Content -->
<div class="container">
	<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Renter
                </h1>
                <ol class="breadcrumb">
                    <li><a href="owner-index.php">Home</a>
                    </li>
                    <li><a href="owner-renter.php" title="">Renter</a></li>
                    <li class="active">Add Renter</li>
                </ol>
            </div>
        </div>
    <!-- end page heading -->

    <!-- Detail Content Renter -->
    <div class="row">
    	<div class="col-lg-12">
            <h2 class="page-header">Add Your Renter</h2>
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
            <form method="post">
	        	<div class="col-md-4">
	            	<div class="control-group form-group">
                        <div class="controls">
                            <label>Nama Lengkap:</label>
                            <input type="text" name="fullname" class="form-control" required>
                            <p class="help-block">Ex. Fathur Rohim</p>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Jenis Kelamin</label>
                            <select name="gender" class="form-control">
                                <option value="">--Pilih Gender--</option>
                                <option value="Pria">Pria</option>}
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Ayah</label>
                            <input type="text" name="father" class="form-control" required>
                            <p class="help-block">Ex. Raja Pamungkas</p>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Ibu</label>
                            <input type="text" name="mother" class="form-control" required>
                            <p class="help-block">Ex. Ratu Bidadari</p>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Telepon</label>
                            <input type="number" name="phone" class="form-control" required>
                            <p class="help-block">Ex. 08133304****</p>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Alamat</label>
                            <textarea name="address" class="form-control" rows="3"></textarea>
                            <p class="help-block">Ex. Jl. Situbondo</p>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <input type="hidden" name="id_role" class="form-control" value="3">
                            <input type="hidden" name="id_owner" class="form-control" value="<?php echo $ownerRow['id_owner']; ?>">
                            <label>Ruang dipesan:</label>
                            <select name="id_room" class="form-control">
                                <option selected="selected">--Select Room--</option>
                                <?php echo $ops; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <button type="submit" name="btn-save-addrenter" class="btn btn-info form-control">Save</button>
                        </div>
                    </div>
	            </div>
            </form>
	        </div>
        </div>
    </div>
    <!-- End Detail Content Renter -->
</div>
<!-- End Page Content -->