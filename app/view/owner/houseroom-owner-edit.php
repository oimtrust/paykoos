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
                    <li class="active">Edit Room</li>
                </ol>
            </div>
        </div>
    <!-- end page heading -->

    <!-- Detail Content Renter -->
    <div class="row">
    	<div class="col-lg-12">
            <h2 class="page-header">Edit Your Room</h2>
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
            <form method="post" role="form" action="" name="roomFormEdit" enctype="multipart/form-data">
	        	<div class="col-md-4">
                    <div>
                        <input type="hidden" name="id_owner" value="<?php  echo $id_owner; ?>">
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nama Kamar:</label>
                            <input type="text" name="room_name" class="form-control" value="<?php echo $edit_row['room_name']; ?>">
                            <p class="help-block">Ex. Kamar 01</p>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Jenis Kelas:</label>
                            <select name="id_class" class="form-control">
                                <option selected="selected">--Pilih Kelas--</option>
                                <?php echo $opsClass; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Status:</label>
                            <select name="status" class="form-control">
                                <option value="">--Pilih Status--</option>
                                <option value="Kosong">Kosong</option>
                                <option value="Penuh">Penuh</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Foto:</label>
                            <p><img src="photo_rooms/<?php echo $edit_row['photo']; ?>" class="img-rounded" width="200px" height="115px"></p>
                            <input type="file" name="photo" class="form-control input-group" accept="image/*">
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <button type="submit" name="btn-save-room-update" class="btn btn-info form-control">Save</button>
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