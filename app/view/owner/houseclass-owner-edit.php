<!--Page Content -->
<div class="container">
	<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">House
                </h1>
                <ol class="breadcrumb">
                    <li><a href="owner-index.php">Home</a>
                    </li>
                    <li><a href="owner-house.php" title="">House</a></li>
                    <li class="active">Edit Class</li>
                </ol>
            </div>
        </div>
    <!-- end page heading -->

    <!-- Detail Content Renter -->
    <div class="row">
    	<div class="col-lg-12">
            <h2 class="page-header">Edit Your Class Room</h2>
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
                ?>
            </div>
        </div>
        
        <div class="row">
        	<div class="col-lg-12">
            <form method="post" role="form" action="" name="classFormEdit">
	        	<div class="col-md-4">
                    <div>
                        <input type="hidden" name="id_owner" value="<?php echo $id_owner; ?>">
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nama Kelas:</label>
                            <input type="text" name="class_name" class="form-control" value="<?php echo $edit_row['class_name']; ?>">
                            <p class="help-block">Ex. Medium</p>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Harga:</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="number" name="price" class="form-control" required value="<?php echo $edit_row['price']; ?>">
                            </div> 
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <button type="submit" name="btn-save-classroom-update" class="btn btn-info form-control">Save</button>
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