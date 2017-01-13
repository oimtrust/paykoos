<!-- page content -->
<div class="container">
	<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">House
                </h1>
                <ol class="breadcrumb">
                    <li><a href="owner-index.php">Home</a>
                    </li>
                    <li class="active">House</li>
                </ol>
            </div>
        </div>
    <!-- end page heading -->

    <!-- Service Tabs -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Add Your Koos</h2>
            </div>
            <div class="col-lg-12">

                <ul id="myTab" class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#class-room" data-toggle="tab"><i class="fa fa-signal"></i> Class Room</a>
                    </li>
                    <li class=""><a href="#rooms" data-toggle="tab"><i class="fa fa-home"></i>Rooms</a>
                    </li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="class-room">
                        <h4>Add your class room</h4>
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
                                elseif (isset($_GET['deleted'])) {
                                    ?>
                                    <div class="alert alert-warning">
                                        Successfully delete data
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <form method="post" accept-charset="utf-8">
                                    <div>
                                        <input type="hidden" name="id_owner" value="<?php echo $ownerRow['id_owner']; ?>">
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Nama Kelas:</label>
                                            <input type="text" name="class_name" class="form-control">
                                            <p class="help-block">Ex. Medium</p>
                                        </div>
                                    </div>

                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <label>Harga:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type="number" name="price" class="form-control" required>
                                                </div> 
                                            </div>
                                        </div>

                                        <div class="control-group form-group">
                                            <div class="controls">
                                                <button type="submit" name="btn-save-classroom" class="btn btn-info form-control">Save</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8 navbar-right">
                            <div class="form-group">
                                <form method="post" accept-charset="utf-8">
                                    <div class="table-responsive">
                                        <table id="dataClass" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Kelas</th>
                                                    <th>Harga</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $no_class = 1;
                                                    ?>
                                                    <tr class="<?php if($no_class % 2 == 0){echo "odd";} else {echo "even";} ?>">
                                                        <?php 
                                                            for ($i=0; $i < count($resultClass); $i++) { 
                                                                echo "<td>" . $no_class++ . "</td>";
                                                                echo $resultClass[$i]."</tr>";
                                                            }
                                                            //$no_class++;
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
                                                    for ($j=1; $j < $paginations_class; $j++) { 
                                                        echo "<li><a href=?start=$j>".$j."</a></li>";
                                                    }
                                                }
                                                else {
                                                    echo "<li><a href=?start=$previous>Previous</a></li>";
                                                    for ($j=0; $j < $paginations_class; $j++) { 
                                                        if ($j == $page_counter) {
                                                            echo "<li><a href=?start=$j class='active'>".$j."</a></li>";
                                                        }
                                                        else {
                                                            echo "<li><a href=?start=$j>".$j."</a></li>";
                                                        }
                                                    }
                                                    if ($j != $page_counter + 1) {
                                                        echo "<li><a href=?start=$next>Next</a></li>";
                                                    }
                                                }
                                             ?>
                                        </ul>
                                    </nav>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="rooms">
                        <h4>Add your rooms</h4>
                        <div class="col-md-4">
                            <div class="form-group">
                                <form method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <input type="hidden" name="id_owner" value="<?php echo $ownerRow['id_owner'] ?>">
                                        </div>
                                    </div>

                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Nama Kamar:</label>
                                            <input type="text" name="room_name" class="form-control" required>
                                            <p class="help-block">Ex. Kamar 1</p>
                                        </div>
                                    </div>

                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Jenis Kelas:</label>
                                            <select name="id_class" class="form-control">
                                                <option selected="selected">--Select Class--</option>
                                                <?php echo $ops; ?>
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
                                            <input type="file" name="photo" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="control-group form-group">
                                            <div class="controls">
                                                <button type="submit" name="btn-save-rooms" class="btn btn-info form-control">Save</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div> <!-- End Col-md-4 -->
                        <div class="col-md-8 navbar-right">
                            <div class="form-group">
                                <form method="post" accept-charset="utf-8">
                                    <div class="table-responsive">
                                        <table id="dataRoom" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Kamar</th>
                                                    <th>Status</th>
                                                    <th>Foto</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $no_room = 1;
                                                    ?>
                                                    <tr class="<?php if($no_room % 2 == 0){echo "odd";} else {echo "even";} ?>">
                                                        <?php 
                                                            for ($i=0; $i < count($resultRoom); $i++) { 
                                                                echo "<td>".$no_room++."</td>";
                                                                echo $resultRoom[$i]."</tr>";
                                                            }
                                                            $no_room++;
                                                         ?>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav aria-label="...">
                                        <ul class="pagination pagination-lg">
                                            <?php 
                                                if ($page_counter == 0) {
                                                    echo "<li><a href=?start_room='0' class='active'>0</a></li>";
                                                    for ($j=1; $j < $paginations_room; $j++) { 
                                                        echo "<li><a href=?start_room=$j>".$j."</a></li>";
                                                    }
                                                }
                                                else {
                                                    echo "<li><a href=?start_room=$previous>Previous</a></li>";
                                                    for ($j=0; $j < $paginations_room; $j++) { 
                                                        if ($j == $page_counter) {
                                                            echo "<li><a href=?start_room=$j class='active'>".$j."</a></li>";
                                                        }
                                                        else {
                                                            echo "<li><a href=?start_room=$j>".$j."</a></li>";
                                                        }
                                                    }
                                                    if ($j != $page_counter + 1) {
                                                        echo "<li><a href=?start_room=$next>Next</a></li>";
                                                    }
                                                }
                                             ?>
                                        </ul>
                                    </nav>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Service Tabs -->
</div>
<!-- end page content -->